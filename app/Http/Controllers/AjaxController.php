<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row};

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

}
