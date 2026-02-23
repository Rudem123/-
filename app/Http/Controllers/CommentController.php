<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['text' => 'required']);
        \App\Models\Comment::create($request->all());

        return back(); // Вернуться назад на страницу статьи
    }

    public function destroy($id)
    {
        \App\Models\Comment::findOrFail($id)->delete();

        return back();
    }
}
