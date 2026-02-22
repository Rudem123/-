@extends('layouts.app')

@section('content')
    <h1>Редактировать новость</h1>
    
    <form action="{{ route('articles.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Обязательно для обновления -->
        
        <p>Дата: <br><input type="date" name="date" value="{{ $article->date }}" required></p>
        <p>Заголовок: <br><input type="text" name="name" value="{{ $article->name }}" style="width:100%" required></p>
        <p>Текст: <br><textarea name="desc" style="width:100%; height:100px;" required>{{ $article->desc }}</textarea></p>
        
        <button type="submit" style="background: blue; color:white; padding: 10px 20px;">Обновить</button>
        <a href="{{ route('articles.index') }}">Отмена</a>
    </form>
@endsection
