@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{$category->name}}</h2>
            <hr>
        </div>
        @forelse($category->products as $key => $product)
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
                <div class="alert alert-warning">Nenhum produto encontrado para esta categoria!</div>
            </div>
        @endforelse
    </div>
@endsection