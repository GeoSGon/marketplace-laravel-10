@extends('layouts.back')

@section('content')
     @if(!$store)
        <a href="{{route('admin.stores.create')}}" class="btn btn-success mb-4">Criar Loja</a>
    @else
    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>Loja</th>
            <th>Total de Produtos</th>
            <th>Ações</th>
        </thead>
        <tbody> 
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>{{$store->products->count()}}</td>
                <td width="10%">
                    <div class="btn-group" role="group">
                        <a href="{{route('admin.stores.edit', ['store' => $store->id])}}" class="btn btn-sm btn-primary me-2">Editar</a>
                        <form action="{{route('admin.stores.destroy', ['store' => $store->id])}}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                        </form>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    @endif
@endsection
