<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use Illuminate\Http\Request;

class BinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bin_save(Request $request)
    {
      $add= $request->input();
      $create=Bin::create($add);
      return back()->with('success', ' Bins Successfully Saved');
    }
    public function bin_Delete(Request $request)
    {

      $add =Bin::find($request->id);
      $add->delete();
      return back()->with('success', 'Bin Successfully Deleted');


    }
    public function bin_update(Request $request,$id)
    {

      $add =Bin::find($id);
      $add->w_id=$request->w_id;
      $add->level_id=$request->level_id;
      $add->name=$request->name;
      $add->update();
      return back()->with('success', 'Level Successfully Updated');


    }



}
