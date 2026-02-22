@extends('layouts.app')

@section('content')
    <h1>{{ $article->name }}</h1>
    <p><strong>Дата:</strong> {{ $article->date }}</p>
    <hr>
    <div>
        {{ $article->desc }}
    </div>
    <br>
    <a href="{{ route('articles.index') }}">← Вернуться к списку</a>
@endsection
