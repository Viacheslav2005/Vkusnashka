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
        <h1 style="text-align: center;">Админ</h1>
        <div class="divs">
            <div>
            <table>
                <thead>
                    <tr>
                    <th>Продукт</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Изображение</th>
                    <th>Страна</th>
                    <th>Категория</th>
                    <th>Структура</th>
                    </tr>
                </thead>
                @foreach ($prod as $i)
                    <tbody>
                        <tr>
                        <td>{{$i -> title}}</td>
                        <td>{{$i -> description}}</td>
                        <td>{{$i -> price}}</td>
                        <td><img src="/public/{{$i -> image}}" alt="" width="50px" height="50px"></td>
                        <td>{{$i -> country}}</td>
                        <td>{{$i -> categories_id}}</td>
                        <td>{{$i -> structure}}</td>
                        <td>
                            <button class="edit-btn"><a href="{{route('admin_edit', ['prod' => $i -> id])}}">Редактировать</a></button>
                            <button class="delete-btn"><a href="{{route('admin_delete', ['prod' => $i -> id])}}">Удалить</a></button>
                        </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>

            </div>
        </div>
        <button><a href="{{route('admin_add')}}">Создать</a></button>

    @endsection()
</body>
</html>
