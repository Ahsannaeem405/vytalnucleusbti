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


}
