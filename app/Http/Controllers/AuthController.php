<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Показывает страницу с формой
    public function create()
    {
        return view('auth.signin');
    }

    // Обрабатывает данные из формы
    public function registration(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Возвращаем данные в формате JSON (как просит задание)
        return response()->json($validated);
    }
}