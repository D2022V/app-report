<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ManagerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
//            'name'=>fake()->randomElement(['Иванова Татьяна Сергеевна', 'Антоненко Тамара Владимировна', 'Брик Светлана Андреевна', 'Баранова Инна Денисовна']),

            'name'=>fake()->firstName(),
            'surname'=>fake()->lastName(),

        ];
    }
}
