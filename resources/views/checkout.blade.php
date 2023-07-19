@extends('layouts.front')

@section('stylesheets')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

@section('content')
<div class="container">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-8 msg"></div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <h2>Detalhes do Pagamento</h2>
    </div>
    <hr>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-8 form-group">
                <label for="card_name">Nome no Cartão <span class="brand"></span></label>
                <input type="text" class="form-control mb-4" name="card_name">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 form-group">
                <label for="card_number">Número do Cartão <span class="brand"></span></label>
                <input type="text" class="form-control mb-4" name="card_number">
                <input type="hidden" name="card_brand">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label for="card_month">Mês de Expiração</label>
                <input type="text" class="form-control mb-4" name="card_month">
            </div>

            <div class="col-md-4 form-group">
                <label for="card_year">Ano de Expiração</label>
                <input type="text" class="form-control mb-4" name="card_year">
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 form-group">
                <label for="card_cvv">Código de Segurança</label>
                <input type="text" class="form-control mb-4" name="card_cvv">
            </div>
        </div>

        <div class="col-md-12 form-group installments"></div>

        <button class="btn btn-lg btn-success mt-4 processCheckout">Efetuar Pagamento</button>
</div>
</form>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script>
    const sessionId = "{{session()->get('pagseguro_session_code')}}";
    const urlThanks = "{{route('checkout.thanks')}}";
    const urlProcess = "{{route('checkout.process')}}";
    const amountTransaction = '{{$cartItemsTotal}}';

    PagSeguroDirectPayment.setSessionId(sessionId);
</script>

<script src="{{asset('js/pagseguro_functions.js')}}"></script>
<script src="{{asset('js/pagseguro_events.js')}}"></script>
@endsection