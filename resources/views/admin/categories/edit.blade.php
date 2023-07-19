@extends('layouts.back')


@section('content')
    <h1>Atualizar Categoria</h1>
    <form action="{{route('admin.categories.update', ['category' => $category->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group mb-2">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description">Descrição:</label>
            <input type="text" name="description" class="form-control" value="{{$category->description}}">
        </div>
        
        <div>
            <button type="submit" class="btn btn-lg btn-success my-2">Atualizar</button>
        </div>
    </form>
@endsection