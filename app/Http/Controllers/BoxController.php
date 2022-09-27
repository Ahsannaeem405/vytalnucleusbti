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

       unset($add['submit_val']);
       $create=Box::create($add);
       if($request->submit_val=='Create And Print')
       {
        return view('print' ,compact('create'));
       }
       else{
        return back()->with('success', ' Box Successfully Saved');
       }

    }
    public function box_Delete(Request $request)
    {

      $add =Box::find($request->id);
      $add->delete();
      return back()->with('success', 'Box Successfully Deleted');


    }


}
