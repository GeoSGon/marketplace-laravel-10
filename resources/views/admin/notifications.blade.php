@extends('layouts.back')

@section('content')
    <a id="mark-all" href="{{route('admin.notifications.read.all')}}" class="btn btn-success mb-4">Marcar todas como lidas</a>
     
    <table class="table table-hover">
        <thead>
            <th>Notificação</th>
            <th>Criado em</th>
            <th>Ações</th>
        </thead>
        <tbody>
            @forelse($unreadNotifications as $uN) 
                <tr>
                    <td>{{$uN->data['message']}}</td>
                    <td>{{$uN->created_at->locale('pt')->diffForHumans()}}</td>
                    <td width="10%">
                        <div class="btn-group" role="group">
                            <a href="{{route('admin.notifications.read', ['notification' => $n->id])}}" class="btn btn-sm btn-primary me-2">Marcar como lida</a>
                        </div>
                    </td>
                </tr>
            @empty
            <tr>
                <td colspan="3">
                    <div class="alert alert-warning">Nenhuma notificação encontrada!</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <script>
    let markAllBtn = document.getElementById('mark-all');

    markAllBtn.addEventListener('click', function() {
        markAllBtn.disabled = true;
    });
    </script>
@endsection