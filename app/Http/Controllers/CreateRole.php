<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;


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
  public function edit_role($id)
  {
    $role = Role::find($id);
    $permission=\DB::table("role_has_permissions")->where("role_id", $id)
    ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')->pluck('permissions.name')->toArray();

    return view('dashboard/edit_role' ,compact('permission','role'));



  }
  public function update_role($id, Request $request)
   {
       $this->validate($request, [
           'name' => 'required',
           'permission' => 'required',
       ]);

       $role = Role::find($id);
       $role->name = $request->name;
       $role->save();
       $role->syncPermissions($request->permission);

       return back()->with('success', 'Role updated successfully');
   }

}
