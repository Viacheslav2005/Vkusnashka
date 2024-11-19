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
        <form action="{{route('admin_update', ['prod' => $prod -> id])}}" method="POST" style="display: flex; flex-direction: column; width: 40vw; justify-content:center; margin: 0 auto;">
            @csrf
            @method('PATCH')
            <label>Название</label>
            <input type="text" name = "title" value="{{old('title', $prod->title)}}">
            <label>Описание</label>
            <input type="text" name = "description" value="{{old('description', $prod->description)}}">
            <label>Цена</label>
            <input type="text" name = "price" value="{{old('price', $prod->price)}}">
            <label>Страна</label>
            <input type="text" name = "country" value="{{old('country', $prod->country)}}">
            <label>Категория</label>
            <select name="category" id="" value="{{old('category', $prod->category)}}">
                @foreach($categories as $i)
                    <option value="{{$i->id}}">{{$i->name_category}}</option>
                @endforeach
            </select>
            <label>Структура</label>
            <input type="text" name = "structure" value="{{old('structure', $prod->structure)}}">

            <input type="submit" value="Обновить">
        </form>
    @endsection()
</body>
</html>
