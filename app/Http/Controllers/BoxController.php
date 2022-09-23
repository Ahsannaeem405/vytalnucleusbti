<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function box_save(Request $request)
    {
       $add= $request->input();
       $create=Box::create($add);
       return back()->with('success', ' Box Successfully Saved');
    }
    public function box_Delete(Request $request)
    {

      $add =Box::find($request->id);
      $add->delete();
      return back()->with('success', 'Box Successfully Deleted');


    }


}
