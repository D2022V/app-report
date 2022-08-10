<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = fake()->randomElement(['новая', 'в работе', 'решена']);
        $statuses = (['new', 'in_processing', 'done']);

        foreach ($statuses as $status) {
            DB::table('statuses')->insert([
                'status' => $status,
            ]);
        };
    }
}
