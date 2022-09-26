<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\{User};


class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        Permission::create(['id'=>1,'name' => 'dashboard']);
        Permission::create(['id'=>2,'name' => 'Products']);
        Permission::create(['id'=>3,'name' => 'Inventory']);
        Permission::create(['id'=>4,'name' => 'Roles']);

        Permission::create(['id'=>5,'name' => 'warehouse']);
        Permission::create(['id'=>6,'name' => 'warehouse_save']);
        Permission::create(['id'=>7,'name' => 'warehouse_update']);
        Permission::create(['id'=>8,'name' => 'warehouse_Delete']);


        Permission::create(['id'=>9,'name' => 'levels']);
        Permission::create(['id'=>10,'name' => 'level_store']);
        Permission::create(['id'=>11,'name' => 'level_update']);
        Permission::create(['id'=>12,'name' => 'level_Delete']);

        Permission::create(['id'=>13,'name' => 'bins']);
        Permission::create(['id'=>14,'name' => 'bin_save']);
        Permission::create(['id'=>15,'name' => 'bin_update']);
        Permission::create(['id'=>16,'name' => 'bin_Delete']);


        Permission::create(['id'=>17,'name' => 'rows']);
        Permission::create(['id'=>18,'name' => 'row_save']);
        Permission::create(['id'=>19,'name' => 'row_update']);
        Permission::create(['id'=>20,'name' => 'row_Delete']);


        Permission::create(['id'=>21,'name' => 'Boxes']);
        Permission::create(['id'=>22,'name' => 'box_save']);
        Permission::create(['id'=>23,'name' => 'box_update']);
        Permission::create(['id'=>24,'name' => 'box_Delete']);

        $adminRole = Role::create(['name' => 'Admin']);
        $editorRole = Role::create(['name' => 'Editor']);





        $adminRole->givePermissionTo([
            'dashboard','Products','Inventory','Roles','warehouse','warehouse_save','warehouse_update','warehouse_Delete','levels','level_store','level_update','level_Delete',
            'bins','bin_save','bin_update','bin_Delete','rows','rows','row_save','row_update','row_Delete','Boxes','box_save','box_update',
            'box_Delete'

        ]);

        $editorRole->givePermissionTo([
            'Boxes',

        ]);
        $user = User::find(2);
        $user->assignRole('Admin');
    }
}
