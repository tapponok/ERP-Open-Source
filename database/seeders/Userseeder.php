<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 1,
        ]);
        $admin->assignRole(Role::all());

        $inventory = User::create([
            'name' => 'inventory',
            'email' => 'inventory@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 1,
        ]);
        $inventory->assignRole('inventory');

        $inventoryspv = User::create([
            'name' => 'inventoryspv',
            'email' => 'inventoryspv@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 1,
        ]);
        $inventoryspv->assignRole('inventoryspv');

        $puchaser = User::create([
            'name' => 'puchaser',
            'email' => 'puchaser@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 1,
        ]);
        $puchaser->assignRole('puchaser');

        $puchaserspv = User::create([
            'name' => 'puchaserspv',
            'email' => 'puchaserspv@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 1,
        ]);
        $puchaserspv->assignRole('puchaserspv');

        #garge 2

        $inventory = User::create([
            'name' => 'inventory2',
            'email' => 'inventory2@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $inventory->assignRole('inventory');

        $inventoryspv = User::create([
            'name' => 'inventoryspv2',
            'email' => 'inventoryspv2@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $inventoryspv->assignRole('inventoryspv');

        $puchaser = User::create([
            'name' => 'puchaser2',
            'email' => 'puchaser2@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $puchaser->assignRole('puchaser');

        $puchaserspv = User::create([
            'name' => 'puchaserspv2',
            'email' => 'puchaserspv2@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $puchaserspv->assignRole('puchaserspv');

        $puchaser = User::create([
            'name' => 'sales',
            'email' => 'sales@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $puchaser->assignRole('sales');

        $puchaserspv = User::create([
            'name' => 'salesspv',
            'email' => 'salesspv2@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
        $puchaserspv->assignRole('salesspv');

        $newuser = User::create([
            'name' => 'jursnamo',
            'email' => 'jursnamo@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);

        $newuser2 = User::create([
            'name' => 'loli',
            'email' => 'loli@jwms.com',
            'password' => bcrypt('12345678'),
            'garage_id' => 2,
        ]);
    }
}
