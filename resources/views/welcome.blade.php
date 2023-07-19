@extends('layouts.front')

@section('content')
    <div class="row">
    @foreach($products as $key => $product)
        <div class="col-md-4 mb-4">
            <div class="card border rounded" style="width: 18rem; margin-bottom: 20px;">
                <div class="card-body">
                    @if($product->images->count())
                        <img class="card-img-top" src="{{asset('storage/' . $product->thumb)}}" alt="">
                    @else
                        <img class="card-img-top" src="{{asset('assets/img/no-image.jpg')}}" alt="">
                    @endif
                </div>

                <div class="card-body">
                    <h2 class="card-title">{{$product->name}}</h2>

                    <p class="card-text">
                        {{$product->description}}
                    </p>

                    <h3>
                        R$ {{number_format($product->price, '2', ',', '.')}}
                    </h3>

                    <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">Ver Produto</a>
                </div>
            </div>
        </div>
        @if(($key + 1) % 3 == 0) <div class="row"></div> @endif
    @endforeach
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h2>Lojas em Destaque</h2>
            <hr>
        </div>
        @foreach($stores as $store)
            <div class="col-4 mb-4">
                @if($store->logo)
                    <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
                @else
                    <img src="https://via.placeholder.com/300X100.png?text=logo" alt="Loja sem logo..." class="img-fluid">
                @endif

                <h3 class="mt-2">{{$store->name}}</h3>
                
                <p>{{$store->description}}</p>

                <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-sm btn-success">Ver Loja</a>
            </div>
        @endforeach
    </div>
@endsection