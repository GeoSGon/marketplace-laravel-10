@extends('layouts.back')

@section('content')
    <h1>Atualizar Produto</h1>

    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        
        <div class="form-group mb-2">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description">Descrição:</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="body">Conteúdo:</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>
            @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="price">Preço:</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form group mb-2">
            <label for="categories">Categorias:</label>
            <select name="categories[]" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                        @if($product->categories->contains($category)) selected 
                        @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="images[]">Imagens:</label>
            <input type="file" name="images[]" class="form-control @error ('images.*') is-invalid @enderror" multiple>
            
            @error ('images.*') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-success my-2">Atualizar</button>
        </div>
    </form>

    <hr>

    <div class="row">
        @foreach($product->images as $image)
            <div class="col-4 text-center">
                <img src="{{asset('storage/' . $image->image)}}" alt="" class="img-fluid">

                <form action="{{route('admin.image.remove', ['id' => $image->image])}}" method="post">
                    @csrf 
                    <input type="hidden" name="imageId" value="{{$image->image}}">

                    <button type="submit" class="btn btn-lg btn-danger mt-2 mb-4">Remover</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','})
    </script>
@endsection