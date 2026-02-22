<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Создаем локализованный Faker прямо здесь
        $fakerRu = \Faker\Factory::create('ru_RU');

        return [
            'date' => $fakerRu->date(),
            'name' => $fakerRu->sentence(3),
            'shortDesc' => $fakerRu->paragraph(1),
            'desc' => $fakerRu->paragraph(5),
            'preview_image' => 'preview.jpg', 
            'full_image' => 'full.jpeg',
        ];
    }
}
