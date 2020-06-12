@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edição de Cardápio</h1>
        <a href="{{route('menu.index')}}" class="btn btn-primary">Home</a>
        <hr>

        <form action="{{route('menu.update', ['menu' => $menu->id])}}" method="post">
            {{csrf_field()}}
            <p class="form-group">
                <label>Nome do Cardápio</label>
                <input type="text"
                       name="name"
                       value="{{$menu->name}}"
                       class="form-control col-sm-6 @if($errors->has('name')) is-invalid @endif">
                @if($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>
                            {{$errors->first('name')}}
                        </strong>
                    </span>
                @endif
            </p>

            <p class="form-group">
                <label>Preço</label>
                <input type="text"
                       name="price"
                       value="{{$menu->price}}"
                       class="form-control col-sm-6 @if($errors->has('price')) is-invalid @endif">
                @if($errors->has('price'))
                    <span class="invalid-feedback">
                        <strong>
                            {{$errors->first('price')}}
                        </strong>
                    </span>
                @endif
            </p>

            <p class="form-group">
                <label>Restaurante</label>
                <select name="restaurant_id" class="form-control col-sm-6">
                    @foreach($restaurants as $r)
                        <option
                            value="{{$r->id}}"
                            @if($menu->restaurant_id == $r->id)
                                selected
                            @endif
                        >{{$r->name}}</option>
                    @endforeach
                </select>

                @if($errors->has('restaurant_id'))
                    <span class="invalid-feedback">
                        <strong>
                            {{$errors->first('restaurant_id')}}
                        </strong>
                    </span>
                @endif
            </p>

            <input type="submit" value="Atualizar Cardápio" class="btn btn-success btn-lg">

        </form>
    </div>
@endsection

