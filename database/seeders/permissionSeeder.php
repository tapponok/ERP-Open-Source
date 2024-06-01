<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datapermission = [
            ['name' => 'indexuser'],
            ['name' => 'createuser'],
            ['name' => 'updateuser'],
            ['name' => 'deleteuser'],
            ['name' => 'indexteam'],
            ['name' => 'createteam'],
            ['name' => 'updateteam'],
            ['name' => 'deleteteam'],
            ['name' =>'indexrolepermission'],
            ['name' =>'createrolepermission'],
            ['name' =>'updaterolepermission'],
            ['name' =>'deleterolepermission'],
            ['name' => 'indexcategory'],
            ['name' => 'createcategory' ],
            ['name' => 'updatecategory' ],
            ['name' => 'deletecategory' ],
            ['name' => 'indexunit'],
            ['name' => 'createunit'],
            ['name' => 'updateunit'],
            ['name' => 'deleteunit'],
            ['name' => 'indexgarage'],
            ['name' => 'creategarage'],
            ['name' => 'updategarage'],
            ['name' => 'deletegarage'],
            ['name' => 'indexproduct'],
            ['name' => 'createproduct'],
            ['name' => 'updateproduct'],
            ['name' => 'deleteproduct'],
            ['name' => 'indexgroupproduct'],
            ['name' => 'creategroupproduct'],
            ['name' => 'updategroupproduct'],
            ['name' => 'deletegroupproduct'],
            ['name' => 'indexstockopname'],
            ['name' => 'createstockopname'],
            ['name' => 'approvestockopname'],
            ['name' => 'rejectstockopname'],
            ['name' => 'indexreceiveorder'],
            ['name' => 'createreceiveorder'],
            ['name' => 'approvereceiveorder'],
            ['name' => 'rejectreceiveorder'],
            ['name' => 'indexsupplier'],
            ['name' => 'createsupplier'],
            ['name' => 'updatesupplier'],
            ['name' => 'deletesupplier'],
            ['name' => 'indexpurchaseorder'],
            ['name' => 'createpurchaseorder'],
            ['name' => 'approvepurchaseorder'],
            ['name' => 'rejectpurchaseorder'],
            ['name' => 'indexpurchaseinvoice'],
            ['name' => 'createpurchaseinvoice'],
            ['name' => 'approvepurchaseinvoice'],
            ['name' => 'rejectpurchaseinvoice'],
            ['name' => 'indexsalesorder'],
            ['name' => 'createsalesorder'],
            ['name' => 'approvesalesorder'],
            ['name' => 'rejectsalesorder'],
            ['name' => 'indexsalesinvoice'],
            ['name' => 'createsalesinvoice'],
            ['name' => 'approvesalesinvoice'],
            ['name' => 'rejectsalesinvoice'],
            ['name' => 'stocklogs'],
            ['name' => 'stockproduct']
        ];
        foreach ($datapermission as $datapermission) {
            Permission::create($datapermission);
        }
    }
}
