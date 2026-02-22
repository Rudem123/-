@extends('layouts.app')

@section('content')
    <h1>Регистрация</h1>

    <!-- Вывод ошибок валидации, если они будут -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/signin" method="POST">
        @csrf <!-- ТОКЕН БЕЗОПАСНОСТИ: ОБЯЗАТЕЛЬНО -->
        
        <div>
            <label>Имя:</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </div>

        <div>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            <label>Пароль:</label><br>
            <input type="password" name="password">
        </div>

        <br>
        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection