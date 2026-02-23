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
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $comment->user->name ?? 'Аноним' }}:</strong> 
                    {{ $comment->text }}
                </div>

                @can('delete-comment', $comment)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑</button>
                    </form>
                @endcan
            </div>
        </div>
    @endforeach

    <hr>
    @auth
        <h4>Оставить комментарий</h4>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="text" class="form-control" required placeholder="Напишите комментарий..."></textarea>
            <button type="submit" class="btn btn-primary mt-2">Отправить</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
    @endauth

@endsection
