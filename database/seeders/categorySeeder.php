<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'categ_name' => 'Shoes man',
            'created_by' => 1,
        ]);
        Category::create([
            'categ_name' => 'Shoes woman',
            'created_by' => 1,
        ]);
        Category::create([
            'categ_name' => 'Shirt man',
            'created_by' => 1,
        ]);
        Category::create([
            'categ_name' => 'Shirt women',
            'created_by' => 1,
        ]);
    }
}
