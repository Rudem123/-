@extends('layouts.app')

@section('content')
    <div class="text-center mt-5">
        <h1 class="display-1 text-danger">403</h1>
        <h2>Доступ запрещен!</h2>
        <p>{{ $exception->getMessage() ?: 'У вас нет прав для просмотра этой страницы.' }}</p>
        <a href="/" class="btn btn-primary">Вернуться на главную</a>
    </div>
@endsection
