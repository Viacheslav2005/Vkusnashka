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
        <form action="{{route('admin_store')}}" method="POST" style="display: flex; flex-direction: column; width: 40vw; justify-content:center; margin: 0 auto;" enctype="multipart/form-data">
            @csrf
            <label for="title">Название</label>
            <input type="text" name = "title">
            <label for="image">Изображение</label>
            <input type="file" name = "image">
            <label for="description">Описание</label>
            <input type="text" name = "description">
            <label for="price">Цена</label>
            <input type="number" name = "price">
            <label for="price">Количество на складе</label>
            <input type="number" name = "count">
            <label for="country">Страна</label>
            <input type="text" name = "country">
            <label for="category">Категория</label>
            <select name="category">
                @foreach($categories as $i)
                    <option value="{{$i->id}}">{{$i->name_category}}</option>
                @endforeach
            </select>
            <label for="structure">Структура</label>
            <input type="text" name = "structure">

            <input type="submit" value="Создать">
        </form>
    @endsection()
</body>
</html>
