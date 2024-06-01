<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = [
            ['name' => 'superadmin', 'guard_name' => 'web'],
        ];
        foreach ($superadmin as $superadmin) {
            $uperadmin = Role::create($superadmin);
            $uperadmin->givePermissionTo(Permission::all());
        }
        $inventory = [
            ['name' => 'inventory', 'guard_name' => 'web'],
        ];
        foreach ($inventory as $inventory) {
            $inventory = Role::create($inventory);
            $inventory->givePermissionTo(
                'indexcategory','createcategory',  'updatecategory', 'deletecategory',
                'indexgroupproduct', 'creategroupproduct', 'updategroupproduct', 'deletegroupproduct',
                'indexunit', 'createunit', 'updateunit', 'deleteunit',
                'indexstockopname', 'createstockopname',
                'indexproduct', 'createproduct', 'updateproduct', 'deleteproduct', 'stockproduct',
                'indexreceiveorder', 'createreceiveorder',
            );
        }
        $inventoryspv = [
            ['name' => 'inventoryspv', 'guard_name' => 'web'],
        ];
        foreach ($inventoryspv as $inventoryspv) {
            $inventoryspv = Role::create($inventoryspv);
            $inventoryspv->givePermissionTo(
                'indexcategory','createcategory',  'updatecategory', 'deletecategory',
                'indexgroupproduct', 'creategroupproduct', 'updategroupproduct', 'deletegroupproduct',
                'indexunit', 'createunit', 'updateunit', 'deleteunit',
                'indexstockopname', 'createstockopname', 'approvestockopname', 'rejectstockopname',
                'indexproduct', 'createproduct', 'updateproduct', 'deleteproduct', 'stockproduct',
                'indexreceiveorder', 'createreceiveorder', 'approvereceiveorder', 'rejectreceiveorder'
            );
        }


        $puchaser = [
            ['name' => 'puchaser', 'guard_name' => 'web',],
        ];
        foreach ($puchaser as $puchaser) {
            $puchaser = Role::create($puchaser);
            $puchaser->givePermissionTo(
                'indexproduct','stockproduct',
                'indexsupplier', 'createsupplier', 'updatesupplier', 'deletesupplier',
                'indexpurchaseorder', 'createpurchaseorder',
                'indexpurchaseinvoice', 'createpurchaseinvoice',
            );
        }

        $puchaserspv = [
            ['name' => 'puchaserspv','guard_name' => 'web'],
        ];
        foreach ($puchaserspv as $puchaserspv) {
            $puchaserspv = Role::create($puchaserspv);
            $puchaserspv->givePermissionTo(
                'indexproduct','stockproduct',
                'indexsupplier', 'createsupplier', 'updatesupplier', 'deletesupplier',
                'indexpurchaseorder', 'createpurchaseorder','approvepurchaseorder', 'rejectpurchaseorder',
                'indexpurchaseinvoice', 'createpurchaseinvoice','approvepurchaseinvoice', 'rejectpurchaseinvoice',
            );
        }
        $sales = [
            ['name' => 'sales', 'guard_name' => 'web',],
        ];
        foreach ($sales as $sales) {
            $sales = Role::create($sales);
            $sales->givePermissionTo(
                'indexsalesorder','createsalesorder',
                'indexsalesinvoice','createsalesinvoice',
            );
        }

        $salesspv = [
            ['name' => 'salesspv','guard_name' => 'web'],
        ];
        foreach ($salesspv as $salesspv) {
            $salesspv = Role::create($salesspv);
            $salesspv->givePermissionTo(
                'indexsalesorder','createsalesorder',
                'approvesalesorder', 'rejectsalesorder',
                'indexsalesinvoice','createsalesinvoice',
                'approvesalesinvoice', 'rejectsalesinvoice',

            );
        }
    }
}
