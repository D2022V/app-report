<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = ['Отключение', 'Проверка/удешевлени', 'Тех. вопрос', 'Прочее'];
        $categories = ['disconnected', 'check/cheapening', 'tech_question', 'other'];
        foreach ($categories as $category) {
            Category::factory()->create([
                'category' => $category,
            ]);
        }
    }
}
