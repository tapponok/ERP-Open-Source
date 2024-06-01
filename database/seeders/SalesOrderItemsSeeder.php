<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SalesOrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) { // Ganti 10 dengan jumlah data yang Anda inginkan

            DB::table('salesorder_items')->insert([
                'salesorder_id' => $faker->numberBetween(1, 10),
                'product_id' => $faker->numberBetween(1, 10), // Ganti 10 dengan jumlah produk yang tersedia
                'quantity' => $faker->numberBetween(1, 5),
                'product_code' => $faker->text(10),
                'product_name' => $faker->text(20),
                'price' => $faker->randomFloat(2, 10, 1000),
                'discount_percentage' => $faker->randomFloat(2, 0, 50),
                'discounttotal' => $faker->randomFloat(2, 0, 100),
                'subtotal' => $faker->randomFloat(2, 10, 500),
                'total_after_discount' => $faker->randomFloat(2, 10, 500),
                'isarchive' => $faker->boolean(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
