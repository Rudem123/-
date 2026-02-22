@extends('layouts.app')

@section('content')
    <h1>Список новостей</h1>
    <table border="1" style="width:100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f4f4f4;">
                <th>Дата</th>
                <th>Название</th>
                <th>Превью</th>
                <th>Краткое описание</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
            <tr>
                <td>{{ $article->date }}</td>
                <td>{{ $article->name }}</td>
                <td>
                    <!-- Ссылка на галерею с передачей имени полноразмерного фото -->
                    <a href="/galery?img={{ $article->full_image }}">
                        <img src="{{ asset('img/' . $article->preview_image) }}" width="100">
                    </a>
                </td>
                <td>{{ $article->shortDesc ?? 'Нет описания' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
