@extends('layouts.app')
@section('content')
<form action="/register" method="POST" class="col-md-4 mx-auto">
    @csrf
    <h2>Регистрация</h2>
    <input type="text" name="name" class="form-control mb-2" placeholder="Имя" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Пароль" required>
    <input type="password" name="password_confirmation" class="form-control mb-2" placeholder="Повторите пароль" required>
    <button class="btn btn-primary w-100">Зарегистрироваться</button>
</form>
@endsection
