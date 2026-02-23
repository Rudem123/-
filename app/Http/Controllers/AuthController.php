<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Присвоение токена Sanctum (как требует задание)
            $user = Auth::user();
            $user->createToken('auth_token')->plainTextToken;

            return redirect('/articles');
        }

        return back()->withErrors(['email' => 'Неверный логин или пароль']);
    }

    public function logout(Request $request)
    {
        // 1. Удаляем токен (требование задания)
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        // 2. Выходим именно из WEB-сессии (исправляет твою ошибку)
        Auth::guard('web')->logout();

        // 3. Аннулируем сессию и обновляем CSRF (требование задания)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
