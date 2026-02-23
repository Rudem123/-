<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController; // Импортируем контроллер
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// Главная теперь вызывает метод index контроллера
Route::get('/', [MainController::class, 'index']);

// Маршрут для галереи
Route::get('/galery', [MainController::class, 'galery']);

// Старые маршруты из прошлой лабы оставляем без изменений
Route::get('/about', function () {
    return view('about');
});
Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'г. Москва, ул. Прянишникова, 2а',
        'phone' => '+7 (999) 9964397283',
        'email' => 'trafimovrudem@gmail.com',
        'work_hours' => 'Пн-Пт 9:00 - 18:00',
    ]);
});

// Публичные маршруты
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Защищенные маршруты (только для авторизованных)
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('articles', ArticleController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{id}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
