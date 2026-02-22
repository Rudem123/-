<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // ВОТ ЭТОТ БЛОК ВЫЗЫВАЕТ ОШИБКУ, ЕГО НУЖНО ЗАКОММЕНТИРОВАТЬ:
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Оставляем только твою фабрику для Новостей:
        \App\Models\Article::factory(10)->create();
        
        Comment::factory(20)->create();
    }
}
