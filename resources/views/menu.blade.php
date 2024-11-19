<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Меню</title>
		<link href="css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="/styles/menu.css">
</head>
<body>
@extends('layouts.header')
@section('content')
    <div class="body">
        <div class="body_text">
            <p>"Вкусняшка" </p>
            <p>где домашняя еда всегда в радость!</p>
        </div>
    </div>
    <div class="cards">
        @if(count($prod) > 0)
        <div class="div_card">
            <div>
                @foreach($prod as $i)
                    <img src="{{$i->image}}" alt="">
                    <p>{{$i->country}}</p>
                    <p>{{$i -> price}}</p>
                    <button><a href="{{route('detail', ['prod' => $i->id])}}">Подробнее</a></button>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <h1>Пусто</h1>
    @endif
@endsection('content')
<script src="js/app.js"></script>
</body>
</html>
