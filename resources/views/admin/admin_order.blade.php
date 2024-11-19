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

<!-- Форма фильтрации и сортировки -->
<form method="GET" action="{{ route('admin_order') }}">
    <label for="status">Фильтр по статусу:</label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="">Все</option>
        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новый</option>
        <option value="accept" {{ request('status') == 'accept' ? 'selected' : '' }}>Одобрено</option>
        <option value="reject" {{ request('status') == 'reject' ? 'selected' : '' }}>Отказано</option>
    </select>

    <label for="sort">Сортировка по общей цене:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>По возрастанию</option>
        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>По убыванию</option>
    </select>
</form>

<div class="divs">
    <div>
    <table>
        <thead>
            <tr>
                <th>Имя пользователя</th>
                <th>Название продукта</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Статус</th>
                <th>Общая цена</th>
            </tr>
        </thead>
        @foreach ($product as $i)
            <tbody>
                <tr>
                    <td>{{ $i->name }}</td>
                    <td>{{ $i->title }}</td>
                    <td>{{ $i->price }}</td>
                    <td>{{ $i->count }}</td>
                    <td>{{ $i->status }}</td>
                    <td>{{ $i->count * $i->price }}</td>
                    <td>
                        @if($i->status == 'new')
                            <button class="edit-btn"><a href="{{ route('admin_accept', ['id_order' => $i->id]) }}">Одобрено</a></button>
                            <button class="delete-btn"><a href="{{ route('admin_reject', ['id_order' => $i->id]) }}">Отказано</a></button>
                        @endif
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>



    </div>
</div>
    <!-- Пагинация -->
    <div class="pagination">
        {{ $product->links() }}
    </div>
    @endsection()

</body>
</html>
