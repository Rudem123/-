<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index()
    {
        // Показываем только те, что НЕ прошли модерацию
        $comments = Comment::where('is_moderated', false)->latest()->get();

        return view('comments.moderation', compact('comments'));
    }

    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);

        Comment::create([
            'text' => $request->text,
            'article_id' => $request->article_id,
            'user_id' => auth()->id(),
            'is_moderated' => false, // На всякий случай принудительно
        ]);

        return back()->with('status', 'Ваш комментарий отправлен и ожидает модерации.');
    }

    public function accept($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_moderated' => true]);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        // Для модератора проверка Gate::before сработает автоматически
        $comment->delete();

        return back();
    }

}
