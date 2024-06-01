<?php

namespace Database\Seeders;

use App\Models\Garage;
use Illuminate\Database\Seeder;

class garageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Garage::create([
            'garagename' => 'Garage Bandung I',
            'address' => 'Jl. Srigunting Raya No.1 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '123112',
        ]);
        Garage::create([
            'garagename' => 'Garage Bandung II',
            'address' => 'Jl. A H Nasution No. 14 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '231243',
        ]);
        Garage::create([
            'garagename' => 'Garage Bandung III',
            'address' => '	Jl. Cisaranten Kulon Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '123431',
        ]);
        Garage::create([
            'garagename' => 'Garage Bandung IV',
            'address' => 'Jl. Bojongloa No.69 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '651231',
        ]);
        Garage::create([
            'garagename' => 'Garage Bandung V',
            'address' => 'Jl. Babakan Ciparay No. 212 Bandung',
            'city' => 'Bandung',
            'province' => 'West Java',
            'postalcode' => '896744',
        ]);
    }
}
