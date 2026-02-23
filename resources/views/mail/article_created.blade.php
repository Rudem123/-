<!DOCTYPE html>
<html>
<head>
    <title>Новая статья на сайте</title>
</head>
<body style="font-family: sans-serif;">
    <h2 style="color: #2c3e50;">Уведомление для модератора</h2>
    <p>На сайте была опубликована новая статья:</p>
    
    <div style="background: #f8f9fa; padding: 15px; border-radius: 5px;">
        <h3>{{ $article->name }}</h3>
        <p><strong>Дата:</strong> {{ $article->date }}</p>
        <p>{{ $article->shortDesc }}</p>
    </div>

    <br>
    <a href="{{ route('articles.show', $article->id) }}" 
       style="background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
       Перейти к статье
    </a>
</body>
</html>
