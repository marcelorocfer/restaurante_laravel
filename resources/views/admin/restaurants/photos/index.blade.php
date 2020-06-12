@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-12">
            <h1>Cadastro de Fotos do Restaurante</h1>
            <hr>
        </div>
        <div class="col-12">
            <form action="{{route('restaurant.photo.save', ['id' => $restaurant_id])}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label>Carregar Fotos</label>
                    <input type="file" class="form-control-file" name="photos[]" multiple>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-success" type="submit">Enviar Fotos</button>
                </div>
            </form>
        </div>
    </div>
@endsection