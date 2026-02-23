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


        
        <div class="ms-auto d-flex align-items-center">
            @auth
                <!-- Колокольчик уведомлений -->
                <div class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle position-relative" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        🔔 
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="navbarDropdown" style="width: 280px;">
                        <li class="dropdown-header">Уведомления</li>
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li>
                                <a class="dropdown-item py-2 border-bottom" href="{{ route('articles.show', $notification->data['article_id']) }}?notify_id={{ $notification->id }}">
                                    <small class="d-block text-muted">Новая статья:</small>
                                    <span class="text-wrap">{{ $notification->data['article_name'] }}</span>
                                </a>
                            </li>
                        @empty
                            <li><span class="dropdown-item text-muted">Нет новых уведомлений</span></li>
                        @endforelse
                    </ul>
                </div>

                <span class="nav-link text-info me-3">Привет, {{ Auth::user()->name }}</span>
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