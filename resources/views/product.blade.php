@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-4">
            @if ($product->images->count())
                <img src="{{ asset('storage/' . $product->thumb)}}" class="img-fluid thumb" alt="">
                    @foreach($product->images as $image)
                        <div class="col-3">
                            <img src="{{asset('storage/' . $image->image)}}" class="img-thumbnail img-fluid img-small" alt="">
                        </div>
                    @endforeach
            @else
                <img src="{{asset('assets/img/no-image.jpg')}}" class="rounded float-start" alt="">
            @endif
        </div> 
        <div class="col-4">
            <div class="col-md-12">
                <h2>{{$product->name}}</h2>

                <p>
                    {{$product->description}}
                </p>

                <h3>
                    R$ {{number_format($product->price, '2', ',', '.')}}
                </h3>

                <span>
                    Loja: {{$product->store->name}}
                </span> 
            </div>

            <div style="margin-top: 1rem;">
                <div class="product-add col-md-12">
                    <hr>

                    <form action="{{route('cart.add')}}" method="post">
                        @csrf
                        <input type="hidden" name="product[name]" value="{{$product->name}}">
                        <input type="hidden" name="product[price]" value="{{$product->price}}">
                        <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                        <div class="form-group">
                            <label class="mb-2">Quantidade:</label>
                            <input type="number" name="product[amount]" id="amount" class="form-control" style="width: 4rem" value="1">
                        </div>
                        <button class="btn btn-lg btn-danger mt-4" >Comprar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
       <div class="col-12">
            <hr>
            {{$product->body}}
       </div>
    </div>
@endsection

@section('scripts')
    <script>
        let thumb = document.querySelector('img.thumb');
        let imgSmall = document.querySelector('img.img-small');

        imgSmall.forEach((e) => e.addEventListener('click', () => thumb.src = e.src));
    </script>
@endsection