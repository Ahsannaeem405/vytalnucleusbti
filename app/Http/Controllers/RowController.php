<?php

namespace App\Http\Controllers;

use App\Models\Row;
use Illuminate\Http\Request;

class RowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function row_save(Request $request)
    {
      $add= $request->input();
      $create=Row::create($add);
      return back()->with('success', ' Row Successfully Saved');
    }
    public function row_Delete(Request $request)
    {

      $add =Row::find($request->id);
      $add->delete();
      return back()->with('success', 'Row Successfully Deleted');


    }


}
