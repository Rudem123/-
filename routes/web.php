<?php

use Illuminate\Support\Facades\Route;

// Главная страница
Route::get('/', function () {
    return view('home');
});

// Страница О нас
Route::get('/about', function () {
    return view('about');
});

// Страница Контакты с передачей массива данных
Route::get('/contacts', function () {
    $contactInfo = [
        'address' => 'г. Москва, ул. Академика Королева, д. 12',
        'phone' => '+7 (999) 123-45-67',
        'email' => 'support@laravel-project.ru',
        'work_hours' => 'Пн-Пт с 9:00 до 18:00'
    ];

    return view('contacts', $contactInfo);
});