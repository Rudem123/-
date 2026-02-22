<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; // Импортируем контроллер
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// Главная теперь вызывает метод index контроллера
Route::get('/', [MainController::class, 'index']);

// Маршрут для галереи
Route::get('/galery', [MainController::class, 'galery']);

// Старые маршруты из прошлой лабы оставляем без изменений
Route::get('/about', function () { return view('about'); });
Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Москва, ул. Прянишникова, 2а',
        'phone' => '+7 (999) 9964397283',
        'email' => 'trafimovrudem@gmail.com',
        'work_hours' => 'Пн-Пт 9:00 - 18:00'
    ]);
});

// Маршруты для регистрации
// Показ формы (GET)
Route::get('/signin', [AuthController::class, 'create']);

// Обработка формы (POST)
Route::post('/signin', [AuthController::class, 'registration']);

// Это создаст сразу 7 маршрутов для всех CRUD операций
Route::resource('articles', ArticleController::class);

Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');