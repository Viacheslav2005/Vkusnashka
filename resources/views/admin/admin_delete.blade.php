<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ</title>
    <link rel="stylesheet" href="/styles/admin.css">
</head>
<body>
@extends('layouts.header_admin')
    @section('content')
    <a href=""></a>
        <h1 style="text-align: center;">Админ</h1>
        <form action="{{route('admin_destroy', ['prod' => $prod -> id])}}" method="POST" style="display: flex; flex-direction: column; width: 40vw; justify-content:center; margin: 0 auto;">
            @csrf
            @method('delete')
            <label for="">Название</label>
            <input type="text" name = 'title' value="{{old('title', $prod->title)}}" readonly>
            <label for="">Описание</label>
            <input type="text" name = 'description' value="{{old('description', $prod->description)}}" readonly>
            <label for="">Цена</label>
            <input type="text" name = 'price' value="{{old('price', $prod->price)}}" readonly>
            <label for="">Страна</label>
            <input type="text" name = 'country' value="{{old('country', $prod->country)}}" readonly>
            <label for="">Категория</label>
            <select name="category" id="" value="{{old('category', $prod->category)}}">
                <option value="food">Food</option>
                <option value="drink">Drink</option>
            </select>
            <label for="">Структура</label>
            <input type="text" name = 'structure' value="{{old('structure', $prod->structure)}}" readonly>

            <input type="submit" value="Удалить">
        </form>
    @endsection()
</body>
</html>
