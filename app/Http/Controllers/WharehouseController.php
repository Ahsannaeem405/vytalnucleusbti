<?php

namespace App\Http\Controllers;

use App\Models\Wharehouse;
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





}
