@extends('layouts.app')
@section('content')
<form action="/login" method="POST" class="col-md-4 mx-auto">
    @csrf
    <h2>Вход</h2>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="password" name="password" class="form-control mb-2" placeholder="Пароль" required>
    <button class="btn btn-success w-100">Войти</button>
</form>
@endsection
