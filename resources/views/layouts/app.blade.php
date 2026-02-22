<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Мой сайт на Laravel</title>
    <style>
        body { font-family: sans-serif; margin: 0; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #333; color: #fff; padding: 1rem; }
        nav a { color: #fff; margin-right: 15px; text-decoration: none; }
        main { flex: 1; padding: 20px; }
        footer { background: #eee; padding: 10px; text-align: center; border-top: 1px solid #ccc; }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="/">Главная</a>
        <a href="/about">О нас</a>
        <a href="/contacts">Контакты</a>
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