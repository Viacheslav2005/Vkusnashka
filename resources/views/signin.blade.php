<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход</title>
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


    <form action="{{ route('signin') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Почта</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>

@endsection
<script src="js/app.js"></script>
</body>
</html>
