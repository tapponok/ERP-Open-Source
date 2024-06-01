<?php

namespace Database\Seeders;

use App\Models\Sales_order;
use App\Models\salesInvoiceItems;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class salesInvoiceItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) { // Change 10 to the number of fake records you want to generate
            $salesInvoiceId = // ... Set the sales_invoice_id as needed

            salesInvoiceItems::insert([
                'sales_invoice_id' => $faker->numberBetween(1, 20),
                'product_id' => $faker->numberBetween(1, 20), // Change 20 to the number of products available
                'quantity' => $faker->numberBetween(1, 5),
                'product_code' => $faker->ean13(),
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
