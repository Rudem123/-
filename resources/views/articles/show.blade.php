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

    <hr>
    <h3>Комментарии</h3>

    @foreach($article->comments as $comment)
        <div class="card mb-2 p-2">
            <p>{{ $comment->text }}</p>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
            </form>
        </div>
    @endforeach

    <hr>
    <h4>Оставить комментарий</h4>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="text" class="form-control" required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Отправить</button>
    </form>
@endsection
