<?php

namespace App\Http\Controllers;

use App\Mail\ArticleCreatedMail;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
        $this->authorize('create', Article::class);

        return view('articles.create');
    }


    // 3. СОХРАНЕНИЕ НОВОЙ ЗАПИСИ
    public function store(Request $request)
    {
        // 1. ПРОВЕРКА ПРАВ (Важнейший шаг!)
        // Если зайдёт обычный юзер, Laravel выдаст ошибку 403 и письмо не отправится.
        $this->authorize('create', Article::class);

        // 2. ВАЛИДАЦИЯ
        $request->validate([
            'date' => 'required|date',
            'name' => 'required|min:5',
            'desc' => 'required',
        ]);

        // 3. СОХРАНЕНИЕ
        $article = Article::create($request->all() + [
            'preview_image' => 'preview.jpg',
            'full_image' => 'full.jpeg',
            'user_id' => auth()->id(),
        ]);

        // 4. ОТПРАВКА ПИСЬМА
        // Так как только модератор может сюда "попасть", письмо отправится в момент его действий.
        Mail::to('твой_адрес@mail.ru')->send(new ArticleCreatedMail($article));


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
        Gate::authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    // 6. ОБНОВЛЕНИЕ ДАННЫХ
    public function update(Request $request, Article $article)
    {
        Gate::authorize('update', $article);

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
        Gate::authorize('delete', $article);

        $article->delete();

        return redirect()->route('articles.index');
    }
}
