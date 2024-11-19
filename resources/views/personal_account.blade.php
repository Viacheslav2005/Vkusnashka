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
        <h1 style="text-align: center;">Личный кабинет</h1>
        <!-- <div class="content">
            <div class="order_div">
                <h3>Заказы</h3>
                <p>Заказ №1 - 18.09.2024</p>
                <p>Заказ №2 - 18.09.2024</p>
                <p>Заказ №3 - 18.09.2024</p>
            </div>
            <div class="basket_div">
                <h3>Корзина</h3>
                <p>Товар 1</p>
                <p>Товар 1</p>
                <p>Товар 1</p>
            </div>
        </div> -->

        <div class="content">
        <!-- Блок заказов -->
        <div class="order-block">
            @foreach ($order as $i)
            <h2>Ваши заказы:</h2>
            <div class="order-item">
                <h3>Заказ №1</h3>
                <p>Дата: {{$i -> created_at}}</p>
                <p>Статус: {{$i -> status}}</p>
                <p>Общая сумма: {{$i -> count * $i -> price}} руб.</p>
            </div>
            @endforeach
        </div>
    </div>
    @endsection()
</body>
</html>
