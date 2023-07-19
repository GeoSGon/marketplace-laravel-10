@extends('layouts.front')

@section('content')
    <h2 class="alert alert-success">
        Obrigado, seu pedido foi confirmado e está sendo processado.
    </h2>
    <h3>
        Codigo do pedido: {{request()->get('order')}}.
    </h3>
@endsection