@extends('layouts.app')

@section('content')
    <h1>Добавить новость</h1>
    
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <p>Дата: <br><input type="date" name="date" required></p>
        <p>Заголовок: <br><input type="text" name="name" style="width:100%" required></p>
        <p>Текст: <br><textarea name="desc" style="width:100%; height:100px;" required></textarea></p>
        <button type="submit" style="background: blue; color:white; padding: 10px 20px;">Сохранить</button>
    </form>
@endsection
