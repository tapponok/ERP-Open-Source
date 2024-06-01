<?php

namespace Database\Seeders;

use App\Models\salesInvoiceItems;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class salesInvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) { // Ganti 20 dengan jumlah data yang Anda inginkan
            salesInvoiceItems::insert([
                'sales_invoice_id' => $faker->numberBetween(2,11),
                'product_id' => $faker->numberBetween(1,10000),
                'quantity' => $faker->numberBetween(100, 200),
                'product_code' => $faker->ean13(),
                'product_name' => $faker->sentence(),
                'price' => $faker->randomFloat(2, 10, 100),
                'discount_percentage' => $faker->randomFloat(2, 0, 50),
                'discounttotal' => $faker->randomFloat(2, 0, 20),
                'subtotal' => $faker->randomFloat(2, 50, 500),
                'total_after_discount' => $faker->randomFloat(2, 30, 400),
                'isarchive' => false,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
            ]);
        }

    }
}
