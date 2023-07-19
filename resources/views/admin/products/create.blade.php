@extends('layouts.back')

@section('content')
    <h1>Criar Produto</h1>

    <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-2">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description">Descrição:</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="body">Conteúdo:</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{old('body')}}</textarea>

            @error('body')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="price">Preço:</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">

            @error('price')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form group mb-2">
            <label for="categories">Categorias:</label>
            <select name="categories[]" id="" class="form-control" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
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
            <button type="submit" class="btn btn-success my-2">Criar</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ','})
    </script>
@endsection
