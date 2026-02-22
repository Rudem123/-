@extends('layouts.app')

@section('content')
    <h1>Контакты</h1>
    <p>Свяжитесь со мной следующими способами:</p>
    
    <ul>
        <li><strong></strong> {{ $address }}</li>
        <li><strong></strong> {{ $phone }}</li>
        <li><strong></strong> {{ $email }}</li>
    </ul>

    <p>Часы работы: {{ $work_hours }}</p>
@endsection