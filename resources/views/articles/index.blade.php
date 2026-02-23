@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Управление новостями</h1>
        @can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" class="btn btn-success">+ Добавить новость</a>
        @endcan
    </div>


    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Превью</th> <!-- Добавили заголовок -->
                <th>Название</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>
                    <!-- Возвращаем вывод картинки -->
                    <img src="{{ asset('img/' . $article->preview_image) }}" width="70" class="img-thumbnail">
                </td>
                <td>{{ $article->name }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-outline-primary">👁 Просмотр</a>
                        
                        @can('update', $article)
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-secondary">✏ Редакт.</a>
                        @endcan
                        
                        @can('delete', $article)
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Удалить?')">🗑</button>
                            </form>
                        @endcan
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection
