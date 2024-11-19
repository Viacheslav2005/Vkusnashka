<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/styles/main.css">
</head>
<body>
    <header>
        <div class="container">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('index')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('menu')}}">Меню</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('find_us')}}">Где нас найти?</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{route('signin')}}">Вход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('signup')}}">Регистрация</a>
                </li>
                @endguest
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('personal_account')}}">Личный кабинет</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('basket')}}">Корзина</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Выход</a>
                </li>
                @endauth
            </ul>
        </div>
    </header>
    @yield('content')
</body>
</html>
