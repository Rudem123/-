<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // 1. ДОБАВИТЬ ЭТО

class Article extends Model
{
    use HasFactory; // 2. И ДОБАВИТЬ ЭТО ВНУТРИ КЛАССА

    // Здесь могут быть твои настройки, например:
    protected $fillable = ['date', 'name', 'shortDesc', 'desc', 'preview_image', 'full_image', 'user_id'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
