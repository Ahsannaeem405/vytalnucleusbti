<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRole extends Controller
{

  public function create_role(Request $request){
     $this->validate($request, [
         'name' => 'required|unique:roles,name',
         'permission' => 'required',
     ]);

     $role = Role::create(['name' => $request->name]);
     foreach($request->permission as $row)
     {
       $role->givePermissionTo([$row]);


     }



     return back()->with('success','Role created successfully');
 }

}
