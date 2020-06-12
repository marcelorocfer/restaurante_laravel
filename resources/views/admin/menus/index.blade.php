@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="float-left">Cardápios</h1>
        <a href="{{route('menu.new')}}" class="float-right btn btn-success">Novo</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Restaurante</th>
                <th>Criado Em</th>
                <th style="text-align: center">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menus as $m)
                <tr>
                    <td>{{$m->id}}</td>
                    <td>{{$m->name}}</td>
                    <td>{{$m->restaurant->name}}</td>
                    <td>{{$m->created_at}}</td>
                    <td style="text-align: center">
                        <a href="{{route('menu.edit', ['menu' => $m->id])}}" class="btn btn-primary">EDITAR</a>
                        <a href="{{route('menu.remove', ['id' => $m->id])}}" class="btn btn-danger">EXCLUIR</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection