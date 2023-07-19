@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('storage/' . $store->logo)}}" alt="Logo da loja {{$store->name}}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/300X100.png?text=logo" alt="Loja sem logo..." class="img-fluid">
            @endif
        </div>
        <div class="col-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}} | {{$store->mobile_phone}}</span>
            </p>
        </div>
        
        <div class="col-12">
            <hr>
            <h3 style="margin-bottom: 2rem">Produtos desta loja</h3>
        </div>
        @forelse($store->products as $key => $product)
            <div class="col-md-4 mb-4">
                <div class="card border rounded" style="width: 18rem; margin-bottom: 20px;">
                    <div class="card-body">
                        @if($product->images->count())
                            <img class="card-img-top" src="{{asset('storage/' . $product->images->first()->image)}}" alt="">
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
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum produto encontrado para esta loja!</h3>
            </div>
        @endforelse
    </div>
@endsection