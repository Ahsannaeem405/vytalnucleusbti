<?php

namespace App\Http\Controllers;

use App\Models\Wharehouse;
use App\Models\User;
use Spatie\Permission\Models\Permission;

use Hash;
use DB;
use Illuminate\Http\Request;

class WharehouseController extends Controller
{


    public function warehouse_save(Request $request)
    {

      $add = new Wharehouse();
      $add->name=$request->name;
      $add->save();
      return back()->with('success', ' Warehouse Successfully Saved');


    }
    public function warehouse_update(Request $request,$id)
    {

      $add =Wharehouse::find($id);
      $add->name=$request->name;
      $add->update();
      return back()->with('success', 'Warehouse Successfully Updated');


    }
    public function warehouse_Delete(Request $request)
    {

      $add =Wharehouse::find($request->id);
      $add->delete();
      return back()->with('success', 'Warehouse Successfully Deleted');


    }


    public function user_create(Request $request)
    {
      $request->validate([
        'email' => 'required|unique:users',
        'username' => 'required|unique:users',
        'name'=>'required',
        'password'=>'required',
        'role'=>'required'

      ]);

      $add =new User();
      $add->name=$request->name;
      $add->username=$request->username;
      $add->email=$request->email;
      $add->password=Hash::make($request->password);
      $add->save();

      $user = User::find($add->id);
      $user->assignRole($request->role);

      return back()->with('success', 'Warehouse Successfully Deleted');


    }
    public function user_update(Request $request,$id)
    {
      $request->validate([
        'email' => 'required|unique:users,email,' . $id,
        'username' => 'required|unique:users,username,' . $id,
      ]);

      $add =User::find($request->id);
      $add->name=$request->name;
      $add->username=$request->username;
      $add->email=$request->email;
      $add->save();

      DB::table('model_has_roles')->where('model_id', $add->id )->update(array('role_id' => $request->role ));

      return back()->with('success', 'Warehouse Successfully Deleted');


    }






}
