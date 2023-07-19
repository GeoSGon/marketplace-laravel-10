@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Carrinho de Compras</h2>
            <hr>
        </div>
        <div class="col-12">
            @if($cartItems)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Subtotal</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php $total = 0; @endphp

                        @foreach($cartItems as $item)
                            @if(is_array($item))
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td>R$ {{number_format($item['price'], 2, ',', '.')}}</td>
                                <td>{{$item['amount']}}</td>

                                @php
                                    $subtotal = $item['price'] * $item['amount'];
                                    $total += $subtotal;
                                @endphp

                                <td>R$ {{number_format($subtotal, 2, ',', '.')}}</td>
                                <td>
                                    <a href="{{route('cart.remove', ['slug' => $item['slug']])}}" class="btn btn-sm btn-danger">Remover</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach

                        <tr>
                            <td colspan="3">Total:</td>
                            <td colspan="2">R$ {{number_format($total, 2, ',', '.')}}</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="col-md-12">
                    <a href="{{route('checkout.index')}}" class="btn btn-lg btn-success float-start">Concluir Compra</a>
                    <a href="{{route('cart.cancel')}}" class="btn btn-lg btn-danger float-end">Cancelar Compra</a>
                </div>
            @else
                <div class="alert alert-warning">Carrinho vazio...</div>
            @endif
        </div>
    </div>
@endsection
