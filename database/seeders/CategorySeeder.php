<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $categories = ['Отключение', 'Проверка/удешевлени', 'Тех. вопрос', 'Прочее'];
        $categories = ['disconnected', 'check/cheapening', 'tech_question', 'other'];
        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'category' => $category,
            ]);
        };
    }
}
