@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="float-left">Usuário</h1>
        <a href="{{route('user.new')}}" class="float-right btn btn-success">Novo</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Criado Em</th>
                <th style="text-align: center">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->created_at}}</td>
                    <td style="text-align: center">
                        <a href="{{route('user.edit', ['user' => $u->id])}}" class="btn btn-primary">EDITAR</a>
                        <a href="{{route('user.remove', ['id' => $u->id])}}" class="btn btn-danger">EXCLUIR</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection