<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/food.css">
</head>
<body>
@extends('layouts.header')
    @section('content')
        <div>
            <div class="div_food">
                <div>
                    <img src="../{{$prod -> image}}" alt="Том Ян">
                </div>
                <div>
                    <form method="POST" action="{{route('add_basket', ['id_prod' => $prod -> id])}}">
                        @csrf
                        <input type="hidden" value="{{$prod -> id}}" name = "id_prod">
                        <h1>{{ $prod->title }}</h1>
                        <p>Описание блюда: </p>
                        <p>{{ $prod->description }}</p>
                        <p>Цена - </p>
                        <input type="number" name = "price" readonly value="{{ $prod->price }}">
                        <p>Категория - {{ $prod->category }}</p>
                        <p>Страна - {{ $prod->country }}</p>
                        <p>Количество</p>
                        <input type="number" name="count" min="1">
                        <input type="submit" value="Заказать" class="btn_buy">
                    </form>
                </div>
            </div>
        </div>
    @endsection()
</body>
</html>
