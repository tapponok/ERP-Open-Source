<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class supplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create([
            'supplier_name' => 'Ribca',
            'email' => 'ribca@ribca.com',
            'phone' => '081233445566',
            'address' => 'Jl. KH. Wahid Hasyim No. 258 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '213121',
            'shop_name' => 'ribca shop',
            'account_number' => '2384324394392',
            'bank_name' => 'BRI',
            'created_by' => 1,
        ]);
        Supplier::create([
            'supplier_name' => 'Maudy Ayunda',
            'email' => 'maudy@maudy.com',
            'phone' => '081233445588',
            'address' => 'Jln. Leuwipanjang Kebonlega II Kompleks Muara Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '123211',
            'shop_name' => 'Maudy shop',
            'account_number' => '23443245657657',
            'bank_name' => 'BCA',
            'created_by' => 1,
        ]);
        Supplier::create([
            'supplier_name' => 'Chelsea Iskland',
            'email' => 'chelsea@chelsea.com',
            'phone' => '0899112233',
            'address' => 'Jl. Batununggal No.3 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '2344324',
            'shop_name' => 'Chealse shop',
            'account_number' => '1423567864',
            'bank_name' => 'BNI',
            'created_by' => 1,
        ]);
    }
}
