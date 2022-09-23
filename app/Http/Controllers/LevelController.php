<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;


class LevelController extends Controller
{
  public function level_store(Request $request)
  {
    $request->validate([
        'w_id' => 'required',
    ]);


    $add = new Level();
    $add->w_id=$request->w_id;
    $add->name=$request->name;
    $add->save();
    return back()->with('success', ' Level Successfully Saved');


  }
  public function level_update(Request $request,$id)
  {

    $add =Level::find($id);
    $add->w_id=$request->w_id;
    $add->name=$request->name;
    $add->update();
    return back()->with('success', 'Level Successfully Updated');


  }

  public function level_Delete(Request $request)
  {

    $add =Level::find($request->id);
    $add->delete();
    return back()->with('success', 'Level Successfully Deleted');


  }
}
