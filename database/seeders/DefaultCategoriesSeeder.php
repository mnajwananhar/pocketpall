<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DefaultCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultCategories = [
            ['name' => 'General', 'description' => 'General category', 'is_default' => true],
            ['name' => 'Work', 'description' => 'Work related category', 'is_default' => true],
            ['name' => 'Personal', 'description' => 'Personal category', 'is_default' => true],
        ];

        foreach ($defaultCategories as $category) {
            Category::create($category);
        }
    }
}
