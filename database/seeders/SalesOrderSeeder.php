<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class SalesOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // Ganti 10 dengan jumlah data yang Anda inginkan
            DB::table('salesorders')->insert([
                'salesorder_code' => $faker->ean13(),
                'estimate_date' => now(),
                'partnership_id' => $faker->numberBetween(1, 3),
                'payment_id' => $faker->numberBetween(1, 3),
                'garage_id' => $faker->numberBetween(1, 3),
                'address' => $faker->address(),
                'city' => $faker->city(),
                'province' => $faker->state(),
                'postal_code' => $faker->postcode(),
                'total' => $faker->randomFloat(2, 0, 1000),
                'discount' => $faker->randomFloat(2, 0, 100),
                'total_discount' => $faker->randomFloat(2, 0, 500),
                'tax_percent' => $faker->randomFloat(2, 0, 20),
                'tax_total' => $faker->randomFloat(2, 0, 200),
                'shipment_cost' => $faker->randomFloat(2, 0, 50),
                'total_charge' => $faker->randomFloat(2, 0, 1500),
                'created_by' => $faker->numberBetween(1, 5),
                'date_order' => now(),
                'approved_at' => now(),
                'approved_by' => $faker->numberBetween(1, 5),
                'canceled_at' => now(),
                'cancelled_by' => $faker->numberBetween(1, 5),
                'status' => $faker->randomElement(['submit', 'approve', 'cancel', 'draft']),
                'notes' => $faker->paragraph(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
