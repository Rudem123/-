@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Очередь модерации</h1>
    
    @if($comments->isEmpty())
        <p>Новых комментариев на проверку нет.</p>
    @else
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3">Автор</th>
                            <th class="py-3">Текст</th>
                            <th class="py-3">Статья</th>
                            <th class="px-4 py-3 text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $comment->user->name }}</td>
                            <td class="py-3 align-middle">{{ $comment->text }}</td>
                            <td class="py-3 align-middle">
                                <a href="{{ route('articles.show', $comment->article_id) }}" class="text-decoration-none">
                                    {{ $comment->article->name }}
                                </a>
                            </td>
                            <td class="px-4 py-3 align-middle text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('comments.accept', $comment->id) }}" class="btn btn-sm btn-success">Принять</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Отклонить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
