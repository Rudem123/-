<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой сайт на Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #333; color: #fff; padding: 1rem; }
        nav a { color: #fff; margin-right: 15px; text-decoration: none; }
        main { flex: 1; padding: 20px; }
        footer { background: #eee; padding: 10px; text-align: center; border-top: 1px solid #ccc; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app"></div>

<header>
<nav class="navbar navbar-expand navbar-dark bg-dark px-3">
    <div class="navbar-nav w-100">
        <a class="nav-link" href="/">Главная</a>
        <a class="nav-link" href="/articles">Новости</a>
        @can('create', App\Models\Article::class)
            <a class="nav-link text-success" href="{{ route('articles.create') }}">+ Создать новость</a>
        @endcan
        @auth
            @if(Auth::user()->role && Auth::user()->role->name === 'moderator')
                <a class="nav-link text-warning" href="{{ route('comments.index') }}">Модерация комментов</a>
            @endif
        @endauth


        
        <div class="ms-auto d-flex">
            @auth
                <span class="nav-link text-info">Привет, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link nav-link">Выход</button>
                </form>
            @else
                <a class="nav-link" href="/login">Вход</a>
                <a class="nav-link" href="/register">Регистрация</a>
            @endauth
        </div>
    </div>
</nav>

</header>

<main>
    @yield('content') 
</main>

<footer>
    <p>Трафимов Рудем, группа 231-323</p> 
</footer>

</body>
</html>