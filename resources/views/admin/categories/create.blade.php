@extends('layouts.back')


@section('content')
    <h1>Criar Categoria</h1>

    <form action="{{route('admin.categories.store')}}" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description">Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success my-2">Criar</button>
        </div>
    </form>
@endsection