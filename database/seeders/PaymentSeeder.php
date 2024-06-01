<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'name' => 'transfer',
                'created_by' => 1
            ],
            [
                'name' => 'Cash',
                'created_by' => 1
            ],
            [
                'name' => 'Debit',
                'created_by' => 1
            ],
        ];
        foreach ($payments as $payment) {
            Payment::create($payment);
        }
    }
}
