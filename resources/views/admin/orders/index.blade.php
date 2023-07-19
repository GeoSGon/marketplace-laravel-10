@extends('layouts.back')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pedidos recebidos</h2>
            <hr>
        </div>
    </div>

    <div class="col-12">
        <div class="accordion" id="accordionExample">
        @forelse($orders as $key => $order)
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                    Pedido nº: {{$order->reference}}
                </button>
                </h2>
                <div id="collapseOne{{$key}}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            @php $items = unserialize($orders->items); @endphp
                            @foreach(filterItemsByStoreId($items, auth()->user()->store->id) as $item)
                                <li>{{$item['name']}} | R$ {{number_format($item['price'] * $item['amount'], 2, ',', '.')}}
                                    <br>
                                    Quantidade: {{$item['amount']}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-warning">Nenhum pedido recebido!</div>
            @endforelse
        </div>  
        
        <div class="col-12">
            <hr>
            {{$orders->links('pagination::bootstrap-5')}}
        </div>
    </div>
@endsection