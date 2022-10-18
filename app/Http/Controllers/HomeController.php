<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $Wharehouse=Wharehouse::all();
      $Box=Box::orderBy('id', 'desc')->take(10)->get();
      $Level = Box::get()->unique('level_id');
      $Bin=Box::get()->unique('bin_id');
      $Row=Box::get()->unique('row_id');
      return view('dashboard/index',compact('Wharehouse','Level','Bin','Row','Box'));
    }
}
