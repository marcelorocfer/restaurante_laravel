@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>{{$restaurant->name}}</h2>
            <h5>{{$restaurant->description}}</h5>
            <p>
                <address>Endereço: {{$restaurant->address}}</address>
            </p>
            <hr>
        </div>
        <div class="col-12">
            <h5>Cardápio:</h5>
            <ul class="list-group">
                @foreach($restaurant->menus as $m)
                    <li class="list-group-item">{{$m->name}} - R$ {{number_format($m->price, '2', ',', '.')}}</li>
                @endforeach
            </ul>
            <hr>
        </div>
        <div class="col-12">
            <h2>Fotos</h2>
        </div>
        <div class="col-12 row">
            @if($restaurant->photos()->count())
                @foreach($restaurant->photos as $photo)
                    <div class="col-3">
                        <img src="{{asset('/images/' . $photo->photo)}}" alt="" class="img-fluid" width="150px">
                    </div>
                @endforeach
            @else
                <span class="alert alert-warning">
                    Esse restaurante não adicionou fotos.
                </span>
            @endif
        </div>
    </div>
</div>
@endsection
