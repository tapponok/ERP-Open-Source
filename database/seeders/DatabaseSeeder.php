<?php

namespace Database\Seeders;

use App\Models\salesInvoiceItems;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(garageSeeder::class);
        $this->call(permissionSeeder::class);
        $this->call(roleSeeder::class);
        $this->call(Userseeder::class);
        $this->call(categorySeeder::class);
        $this->call(unitSeeder::class);
        $this->call(supplierSeeder::class);
        $this->call(productSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PartnershipSeeder::class);
        // $this->call(SalesOrderSeeder::class);
        // $this->call(SalesOrderItemsSeeder::class);
        // $this->call(salesInvoiceSeeder::class);
        // $this->call(salesInvoiceItemsSeeder::class);
    }
}
