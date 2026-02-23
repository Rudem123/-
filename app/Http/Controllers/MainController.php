<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MainController extends Controller
{
    public function index()
    {
        // Читаем файл из папки public
        $path = public_path('articles.json');
        $json = File::get($path);
        $articles = json_decode($json, true);

        return view('home', ['articles' => $articles]);
    }

    public function galery(Request $request)
    {
        // Получаем имя картинки из запроса
        $img = $request->query('img');

        return view('galery', ['img' => $img]);
    }
}
