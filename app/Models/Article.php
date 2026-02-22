<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. ДОБАВИТЬ ЭТО

class Article extends Model
{
    use HasFactory; // 2. И ДОБАВИТЬ ЭТО ВНУТРИ КЛАССА

    // Здесь могут быть твои настройки, например:
    protected $fillable = ['date', 'name', 'shortDesc', 'desc', 'preview_image', 'full_image'];
}
