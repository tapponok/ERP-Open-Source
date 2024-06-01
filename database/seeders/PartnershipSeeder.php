<?php

namespace Database\Seeders;

use App\Models\Partnership;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partnerships = [
            [
                'name' => 'Jujur Sitanggang',
                'email' => 'soalparna@gmail.com',
                'phone' => '085351364674',
                'address' => 'Lorem ipsum aja',
                'city' => 'Bandung',
                'province' => 'Wes Java',
                'bankname' => 'BCA',
                'bankaccount' => '1232131',
                'created_by' => 1,
            ],
            [
                'name' => 'Dell Namaku',
                'email' => 'dell@dell.com',
                'phone' => '12312313',
                'address' => 'Jl.In aja dulu nanti juga betah',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'bankname' => 'BRI',
                'bankaccount' => '1231231231',
                'created_by' => 1,
            ],
            [
                'name' => 'Oppo Namaku',
                'email' => 'oppo@oppo.com',
                'phone' => '123213123',
                'address' => 'Jl. Mulu cape',
                'city' => 'Bandung',
                'province' => 'West Java',
                'bankname' => 'CIMB',
                'bankaccount' => '123132332',
                'created_by' => 1
            ],
        ];
        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}
