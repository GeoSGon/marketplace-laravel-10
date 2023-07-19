@extends('layouts.back')

@section('content')

    <h1>Atualizar Loja</h1>

    <form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        
        <div class="form-group mb-2">
            <label for="name">Nome:</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="description">Descrição:</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$store->description}}">

            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="phone">Telefone:</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$store->phone}}">
            
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="mobile_phone">Celular:</label>
            <input type="text" name="mobile_phone" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
            
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <p>
                <img src="{{asset('storage/' . $store->logo)}}" alt="">
            </p>
            <label for="logo">Logo:</label>
            <input type="file" name="logo" class="form-control @error ('logo') is-invalid @enderror">
            
            @error ('logo') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        
        <div>
            <button type="submit" class="btn btn-success my-2">Atualizar</button>
        </div>
    </form>
@endsection
