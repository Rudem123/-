<?php

namespace App\Http\Controllers;

use App\Models\Article; // Импортируем модель

class ArticleController extends Controller
{
    public function index()
    {
        // Получаем все новости из базы данных
        $articles = Article::all(); 
        return view('articles.index', ['articles' => $articles]);
    }
}
