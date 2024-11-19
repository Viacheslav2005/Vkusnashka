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
                    <a class="nav-link" href="{{route('admin')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin_order')}}">Заказы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">Выход</a>
                </li>
            </ul>
        </div>
    </header>
    @yield('content')
</body>
</html>
