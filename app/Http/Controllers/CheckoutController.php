<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Notification;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class CheckoutController extends Controller
{
    public function index()
    {
        Try {
            session()->forget('pagseguro_session_code');

            if(!auth()->check()) {
                return redirect()->route('login');
            }
    
            if(!session()->has('cart')) return redirect()->route('home');
    
            $this->makePagSeguroSession();
    
            $total = 0;
    
            $cartItems = array_map(function($line){
                return $line['amount'] * $line['price'];
            }, session()->get('cart'));
    
            $cartItemsTotal = array_sum($cartItems);
    
            session()->get('pagseguro_session_code');
    
            return view('checkout', compact('cartItemsTotal'));

        } catch (\Exception) {
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');
        }
    }

    public function process(Request $request)
    {
        Try {
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            $reference = Uuid::uuid4();

            $creditCardPayment = new CreditCard($cartItems, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();

            $userOder = [
                'reference' => $reference,
                'pagseguro_code' => $this->$result->getCode(),
                'pagseguro_status' => $this->$result->getStatus(),
                'items' => serialize($cartItems),
            ];

            $userOder = $user->orders->create($userOder);

            $userOder->stores()->sync($stores);

            $store = (new Store())->notifyStoreOwners($stores);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data' => [
                    'status' => true,
                    'message' => 'Pedido realizado com sucesso!',
                    'order' => $reference
                ]
            ]);
        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? 
                       $e->getMessage() : 
                       'Erro ao processar pedido!';
            return response()->json([
                'data' => [
                    'status' => false,
                    'message' => $message
                ]
            ], 401);
        }
    }

    public function notification()
    {
        Try {
            $notification = new Notification();
            $transaction = $notification->getTransaction();

            $reference = base64_decode($transaction->getReference()); 

            $userOrder = UserOrder::whereReference($reference);
            $userOrder->update([
                'pagseguro_status' => $transaction->getStatus()
            ]);

            if ($transaction->getStatus() == 1) {
                // Status 1: Aguardando pagamento
                $userOrder->sendConfirmationEmail();

            } elseif ($transaction->getStatus() == 2) {
                // Status 2: Em análise
                $userOrder->showPaymentAnalysisMessage();

            } elseif ($transaction->getStatus() == 3) {
                // Status 3: Pago
                $userOrder->markAsPaid(); 

            } elseif ($transaction->getStatus() == 7) {
                // Status 7: Cancelado
                $userOrder->cancel();
            
            // implementar outros status
            } else {
                Log::error('Status de pagamento desconhecido: ' . $transaction->getStatus());
            }
            
            return response()->json([], 204);

        } catch (\Exception $e) {
            $message = env('APP_DEBUG') ? simplexml_load_string($e->getMessage()) : 'Erro ao processar pedido!';
            return response()->json(['error' => $message], 500);
        }
    }

    public function thanks()
    {
        return view('thanks');
    }

    public function makePagSeguroSession()
    {
        if(!session()->has('pagseguro_session_code')) {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
        }

        session()->put('pagseguro_session_code', $sessionCode->getResult()); 
    }
}
