<?php

namespace App\Http\Controllers;
 
use App\Events\NewArticleEvent;
use App\Mail\ArticleCreatedMail;
use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleCreatedNotification;
use App\Jobs\VeryLongJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class ArticleController extends Controller
{
    // 1. СПИСОК (с пагинацией и кешированием)
    public function index(Request $request)
    {
        $page = $request->get('page', 1);

        // Кешируем результат на 1 час
        $articles = Cache::remember("articles_page_$page", 3600, function () {
            // Сортировка строго по ID от 1 до 20
            return Article::orderBy('id', 'asc')->paginate(5);
        });

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

        // 3.5 ВЫЗОВ СОБЫТИЯ (ДЛЯ REAL-TIME УВЕДОМЛЕНИЙ)
        event(new NewArticleEvent($article));

        // 4. ОТПРАВКА ПИСЬМА (ЧЕРЕЗ ОЧЕРЕДЬ)
        // Мы не отправляем письмо сразу, а кидаем задачу в очередь.
        VeryLongJob::dispatch($article);

        // 5. РАССЫЛКА СИСТЕМНЫХ УВЕДОМЛЕНИЙ В БД
        // Получаем всех Читателей (role_id = 2), кроме текущего пользователя
        $readers = User::where('role_id', 2)
                       ->where('id', '!=', auth()->id())
                       ->get();

        // Отправляем уведомление всем читателям
        Notification::send($readers, new ArticleCreatedNotification($article));

        // Очищаем кеш первой страницы
        Cache::forget('articles_page_1');

        return redirect()->route('articles.index');
    }

    // 4. ПРОСМОТР ОДНОЙ НОВОСТИ (с вечным кешированием)
    public function show(Request $request, Article $article)
    {
        // Если перешли по ссылке из уведомления — помечаем его прочитанным
        $notify_id = $request->query('notify_id');
        if ($notify_id && auth()->check()) {
            auth()->user()->unreadNotifications->where('id', '=', $notify_id)->markAsRead();
        }

        // Кешируем статью и её комментарии "навсегда"
        $article = Cache::rememberForever("article_show_{$article->id}", function () use ($article) {
            return $article->load('comments');
        });

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

        Cache::flush(); // Полная очистка при изменении данных

        return redirect()->route('articles.index');
    }

    // 7. УДАЛЕНИЕ
    public function destroy(Article $article)
    {
        Gate::authorize('delete', $article);

        $article->delete();

        Cache::flush(); // Полная очистка при удалении данных

        return redirect()->route('articles.index');
    }
}
