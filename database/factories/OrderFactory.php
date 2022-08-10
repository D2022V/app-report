<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date_create = fake()->dateTimeBetween('- 12 month');
        $date_close = null;
        $status = fake()->numberBetween(1, 4);
        if ($status === 4) {
            $date_close = fake()->dateTimeInInterval($date_create, '+20 days');
        }
        return [

            'num_order' => fake()->unique()->numberBetween(1, 1000),
            'status_id' => $status,
            'date_create' => $date_create,
            'date_close' => $date_close,
            'manager_id' => fake()->numberBetween(1, 8),
            'category_id' => fake()->numberBetween(1, 4),

        ];
    }
}
