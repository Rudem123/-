@extends('layouts.app')

@section('content')
    <h1>Просмотр изображения</h1>
    <div style="text-align: center;">
        @if($img)
            <img src="{{ asset('img/' . $img) }}" style="max-width: 100%; border: 5px solid #333;">
        @else
            <p>Изображение не найдено.</p>
        @endif
        <br><br>
        <a href="/">← Вернуться к списку</a>
    </div>
@endsection