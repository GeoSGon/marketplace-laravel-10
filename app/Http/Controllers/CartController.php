<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->has('cart') ? 
                                session()->get('cart') : 
                                [];

        return view('cart', compact('cartItems'));

    }

    public function add(Request $request)
    {
        $productData = $request->get('product');

        $product = Product::whereSlug($productData['slug']);

        if(!$product->count() || $productData['amount'] <= 0) return redirect()->route('home');

        $product = array_merge($productData, $product->first(['id', 'name', 'price', 'store_id'])->toArray());

        if(session()->has('cart')) {
            $products = is_array(session()->get('cart')) ? 
                                 session()->get('cart') : 
                                 [];

            $productsSlugs = array_column($products, 'slug');

            if(in_array($product['slug'], $productsSlugs)) {
                $this->productIncrement($product['slug'], $product['amount'], $products);

                session()->put('cart', $products);

            } else {
                session()->push('cart', $product);
            }

        } else {
            $products[] =$product;

            session()->put('cart', $products);
        }

        flash('Produto adicionado no carrinho!')->success();
        return redirect()->route('product.single', ['slug' =>$product['slug']]);
    }

    public function remove($slug)
    {
        if(!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $products = array_filter($products, function($line) use($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Compra cancelada com sucesso!')->success();
        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($line) use($slug, $amount) {
            if($slug == $line['slug']) {
                $line['amount'] += $amount;
            }
            return $line;
        }, $products);

        return $products;
    }
}
