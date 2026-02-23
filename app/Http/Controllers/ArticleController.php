<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // 1. СПИСОК (с пагинацией)
    public function index()
    {
        // Сортировка строго по ID от 1 до 20
        $articles = Article::orderBy('id', 'asc')->paginate(5);

        return view('articles.index', compact('articles'));
    }

    // 2. ФОРМА СОЗДАНИЯ
    public function create()
    {
        return view('articles.create');
    }

    // 3. СОХРАНЕНИЕ НОВОЙ ЗАПИСИ
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|min:5',
            'desc' => 'required',
        ]);

        Article::create($request->all() + [
            'preview_image' => 'preview.jpg', // заглушки для лабы
            'full_image' => 'full.jpeg',
        ]);

        return redirect()->route('articles.index');
    }

    // 4. ПРОСМОТР ОДНОЙ НОВОСТИ
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // 5. ФОРМА РЕДАКТИРОВАНИЯ
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // 6. ОБНОВЛЕНИЕ ДАННЫХ
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|min:5',
            'desc' => 'required',
        ]);

        $article->update($request->all());

        return redirect()->route('articles.index');
    }

    // 7. УДАЛЕНИЕ
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
