<?php

namespace App\Http\Controllers;

use App\Models\Box;
use Illuminate\Http\Request;
use DB;
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
    public function box_update(Request $request,$id)
    {

       $create=Box::find($id);
       $create->bar_code=$request->bar_code;
       $create->name=$request->name;
       $create->row_id=$request->row_id;
       $create->bin_id=$request->bin_id;
       $create->level_id=$request->level_id;
       $create->w_id=$request->w_id;
       $create->updated_at =date('Y-m-d G:i:s');
       $create->update();
       if($request->submit_val=='Create And Print')
       {
        return view('print' ,compact('create'));
       }
       else{
        return back()->with('success', ' Box Successfully Saved');
       }

    }


    public function print_label($id)
    {

        $create=Box::find($id);
        return view('print' ,compact('create'));


    }
    public function create_product()
    {
        $Box=Box::all();
        return view('dashboard/create_product' ,compact('Box'));
    }


    public function box_Delete(Request $request)
    {

      $add =Box::find($request->id);
      $add->delete();
      return back()->with('success', 'Box Successfully Deleted');


    }


}
