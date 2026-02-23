<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ArticleView;

class LogArticleView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Получаем объект статьи из маршрута (если он там есть)
        $article = $request->route('article');

        if ($article && $article instanceof \App\Models\Article) {
            ArticleView::create([
                'article_id' => $article->id,
                'url' => $request->fullUrl(),
            ]);
        }

        return $response;
    }
}
