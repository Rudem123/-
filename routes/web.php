<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; // Импортируем контроллер

// Главная теперь вызывает метод index контроллера
Route::get('/', [MainController::class, 'index']);

// Маршрут для галереи
Route::get('/galery', [MainController::class, 'galery']);

// Старые маршруты из прошлой лабы оставляем без изменений
Route::get('/about', function () { return view('about'); });
Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Москва, ул. Королева, 12',
        'phone' => '+7 (999) 123-45-67',
        'email' => 'support@laravel.ru',
        'work_hours' => 'Пн-Пт 9:00 - 18:00'
    ]);
});