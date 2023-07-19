@extends('layouts.back')

@section('content')
    <a href="{{route('admin.products.create')}}" class="btn btn-success mb-4">Criar Produto</a>
     
    <table class="table table-hover">
        <thead>
            <th>#</th>
            <th>Name</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @foreach($products as $product) 
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{number_format($product->price, 2, ',', '.')}}</td>
                    <td>{{$product->store->name}}</td>
                    <td width="10%">
                        <div class="btn-group" role="group">
                            <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-sm btn-primary me-2">Editar</a>
                            <form action="{{route('admin.products.destroy', ['product' => $product->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{$products->links('pagination::bootstrap-5')}}
@endsection