<?php

namespace Database\Seeders;

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
        $this->call(RoleSeeder::class);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => bcrypt('123456'),
            'role_id' => 1, // ID модератора
        ]);

        \App\Models\Article::factory(10)->create();

        Comment::factory(20)->create();
    }
}
