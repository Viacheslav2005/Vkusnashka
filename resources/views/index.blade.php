<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="/styles/index.css">
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
        <div class="description">
            <div class="div1_descr">
                <p>
                    Мы предлагаем домашнюю еду. В интерьере кафе присутствует деревянная мебель и витрина с выпечкой. Кафе выглядит уютным и стильным.
                </p>
            </div>
            <div>
                <img src="/image/staik.jpeg" alt="" style="border-radius: 50%;">
            </div>
        </div>
        <div class="cards">
            <h1>Лучшие блюда</h1>
            <div class="div_card">
                <div>
                    <img src="/image/image 4.png" alt="">
                    <p>Том ян суп с рисом</p>
                    <button>Подробнее</button>
                </div>
                <div>
                    <img src="/image/image 4.png" alt="">
                    <p>Том ян суп с рисом</p>
                    <button>Подробнее</button>
                </div>
                <div>
                    <img src="/image/image 4.png" alt="">
                    <p>Том ян суп с рисом</p>
                    <button>Подробнее</button>
                </div>
            </div>
        </div>
    @endsection()
</body>
</html>
