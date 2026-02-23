@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Ссылка назад -->
    <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-sm mb-3">← Вернуться к списку</a>

    <div class="card shadow-sm border-0">
        <!-- БЛОК С КАРТИНКОЙ -->
        <img src="{{ asset('img/' . $article->full_image) }}" 
             class="card-img-top" 
             style="max-height: 400px; object-fit: cover;" 
             alt="{{ $article->name }}">

        <div class="card-body p-4">
            <h1 class="fw-bold">{{ $article->name }}</h1>
            <p class="text-muted"><strong>Дата публикации:</strong> {{ $article->date }}</p>
            <hr>
            <div class="article-text" style="font-size: 1.1rem; line-height: 1.6;">
                {{ $article->desc }}
            </div>
        </div>
    </div>

    <!-- Твой блок с комментариями (оставляем без изменений) -->
    <div class="mt-5">
        <h3>Комментарии ({{ $article->comments->count() }})</h3>
        @foreach($article->comments as $comment)
            <div class="card mb-2 p-3 shadow-sm border-0 bg-light">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <strong class="text-primary">{{ $comment->user->name ?? 'Аноним' }}:</strong> 
                        <span>{{ $comment->text }}</span>
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

        @auth
            <form action="{{ route('comments.store') }}" method="POST" class="mt-4 card p-3 shadow-sm border-0">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <h5>Оставить комментарий</h5>
                <textarea name="text" class="form-control" rows="3" placeholder="Ваш комментарий..."></textarea>
                <button type="submit" class="btn btn-primary mt-2">Отправить</button>
            </form>
        @else
            <p class="text-muted mt-3">Чтобы оставить комментарий, пожалуйста, <a href="/login">войдите</a>.</p>
        @endauth
    </div>
</div>
@endsection

