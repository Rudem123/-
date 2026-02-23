<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);

        Comment::create([
            'text' => $request->text,
            'article_id' => $request->article_id,
            'user_id' => Auth::id(), // Привязываем к текущему пользователю
        ]);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Модератор может всё (через Gate::before), обычный юзер - ничего здесь
        // Но по заданию: "Модератор может выполнять любые действия с комментариями"
        Gate::authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
