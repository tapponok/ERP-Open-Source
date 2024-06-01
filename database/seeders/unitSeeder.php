<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class unitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'unit_name' => 'kg',
            'created_by' => 1,
        ]);
        Unit::create([
            'unit_name' => 'pack',
            'created_by' => 1,
        ]);
        Unit::create([
            'unit_name' => 'pcs',
            'created_by' => 1,
        ]);
        Unit::create([
            'unit_name' => 'dozen',
            'created_by' => 1,
        ]);
    }
}
