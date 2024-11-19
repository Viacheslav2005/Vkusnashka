<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="/styles/LK.css">
</head>
<body>
@extends('layouts.header')
    @section('content')
    <div class="container">
        <h2>Корзина</h2>
        @foreach ($baskets as $basket)
            <div class="contant-order">
                <div class="name-sostav-basket">
                    <p>{{ $basket -> title }}</p>
                    <p>{{ $basket -> description }}</p>
                    <p>Цена за товар - {{ $basket -> price }}</p>
                </div>
                <div class="delete-basket">
                    <a href="{{ route('removeFromCart', $basket->id) }}"> <!-- Ссылка для удаления товара -->
                        <img src="images\delete.png" alt="">
                    </a>
                    <span>{{ $basket -> count }}</span>
                    <div class="count-Tovar">
                    <a href="{{ route('increaseQuantity', $basket->id) }}" >+</a> <!-- Ссылка для увеличения количества -->
                    <a href="{{ route('decreaseQuantity', $basket->id) }}">-</a> <!-- Ссылка для уменьшения количества -->
                    </div>
                </div>

            </div>
        @endforeach

        <form action="{{ route('order.create') }}" method="POST">
            @csrf
            <button type="submit" class="order-button">Оформить заказ</button>
        </form>
    </div>
    @endsection()
</body>
</html>

