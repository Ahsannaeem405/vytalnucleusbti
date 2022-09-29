<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box};

class AjaxController extends Controller
{
  function get_level(Request $request)
  {

    $Level=Level::where('w_id' ,$request->id)->get();
    return view('ajax/get_level' , compact('Level'));
  }
  function get_bins(Request $request)
  {

    $Bin=Bin::where('level_id' ,$request->id)->get();
    return view('ajax/get_bin' , compact('Bin'));
  }
  function get_row(Request $request)
  {

    $Row=Row::where('bin_id' ,$request->id)->get();
    return view('ajax/get_row' , compact('Row'));
  }
  function check_box(Request $request)
  {

    if (Box::where('name', '=', $request->id)->exists()) {
      return response()->json(201);
    }
    else{
      return response()->json(200);

    }


  }
  function check_update_box(Request $request)
  {

    if (Box::where('id','!=',$request->bin_id)->where('name', '=', $request->id)->exists()) {
      return response()->json(201);
    }
    else{
      return response()->json(200);

    }


  }

  function get_inventory(Request $request)
  {
    $Wharehouse=Wharehouse::all();


    $Box=Box::when($request->type == '1', function ($q) {
      return $q->orderBy('created_at', 'desc');
    })
    ->when($request->type == '2', function ($q) {
        return $q->orderBy('updated_at', 'desc');
    })
    ->whereIn('w_id',$request->id)
  
    ->get();



    return view('ajax/get_inventory',compact('Box','Wharehouse'));
  }


}
