<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);

        Comment::create([
            'text' => $request->text,
            'article_id' => $request->article_id,
            'user_id' => auth()->id(), // Автоматически берем ID вошедшего юзера
        ]);

        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Используем новое имя шлюза для комментариев
        Gate::authorize('delete-comment', $comment);

        $comment->delete();

        return back();
    }
}
