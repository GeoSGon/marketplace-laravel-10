@extends('layouts.back')


@section('content')
    <a href="{{route('admin.categories.create')}}" class="btn btn-success mb-4">Criar Categoria</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td width="10%">
                        <div class="btn-group" role="group">
                            <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary me-2">Editar</a>
                            <form action="{{route('admin.categories.destroy', ['category' => $category->id])}}" method="post">
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

    {{$categories->links('pagination::bootstrap-5')}}
@endsection