<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
@extends('layouts.header')
@section('content')

    <!-- Сообщение об ошибке или успехе -->
    @if(session('message'))
        <script>
            var message = "{{ session('message') }}";
            var alertType = "{{ session('alert_type') }}";
            var alertClass = alertType === 'success' ? 'alert-success' : 'alert-danger';
            alert(message);
        </script>
    @endif

    <!-- Сообщения об ошибках -->
    @if ($errors->any())
        <script>
            var errors = json . <?php ($errors->all()) ?>;
            if (errors.length > 0) {
                alert(errors.join("\n"));
            }
        </script>
    @endif


    <form action="{{ route('signup') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя заглавными буквами!">
        </div>
        <div class="mb-3">
            <label for="surname" class="form-label">Фамилия</label>
            <input type="text" class="form-control" id="surname" name="surname">
        </div>
        <div class="mb-3">
            <label for="patronymic" class="form-label">Отчество</label>
            <input type="text" class="form-control" id="patronymic" name="patronymic">
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="password_repeat" class="form-label">Повторите пароль</label>
            <input type="password" class="form-control" id="password_repeat" name="password_repeat">
        </div>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>

@endsection
<script src="js/app.js"></script>
</body>
</html>
