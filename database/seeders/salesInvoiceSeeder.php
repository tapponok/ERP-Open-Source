<?php

namespace Database\Seeders;

use App\Models\salesInvoice;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class salesInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $payment = $faker->numberBetween(1000, 200000);
        $downpayment = $faker->numberBetween(1000, 200000); // Menghasilkan nilai uang muka acak


        for ($i = 0; $i < 10; $i++) { // Ganti 10 dengan jumlah data yang Anda inginkan
            salesInvoice::insert([
                'sales_order_invoice' => $faker->text(10),
                'estimate_date' => $faker->date(),
                'sales_order_id' => $faker->numberBetween(1,2),
                'partnership_id' => $faker->numberBetween(1,2),
                'payment_id' => $faker->numberBetween(1,2),
                'payment' => $faker->numberBetween(),
                'downpayment' => $faker->numberBetween(),
                'total_payment' => $payment + $downpayment,
                'garage_id' => $faker->numberBetween(1,2),
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
                'created_by' => $faker->numberBetween(1,2),
                'date_order' => $faker->date(),
                'approved_at' => $faker->date(),
                'approved_by' => $faker->numberBetween(1,2),
                'canceled_at' => $faker->date(),
                'cancelled_by' => $faker->numberBetween(1,2),
                'status' => $faker->randomElement(['submit', 'approve', 'cancel', 'draft']),
                'notes' => $faker->paragraph(),
            ]);
        }
    }
}
