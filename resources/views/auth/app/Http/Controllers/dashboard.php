<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level};

class dashboard extends Controller
{
  public function __construct()
  {
    $this->middleware('CheckRole');
  }
  function login()
  {
    return view('auth/login');
  }
  function index()
  {
    return view('dashboard/index');
  }
  function product()
  {
    return view('dashboard/product');
  }
  function inventory()
  {
    // dd('dd');
    return view('dashboard/inventory');
  }
  function warehouse()
  {
    $Wharehouse=Wharehouse::all();
    return view('dashboard/warehouse',compact('Wharehouse'));
  }
  function levels()
  {
    $Wharehouse=Wharehouse::all();
    $Level=Level::all();

    return view('dashboard/levels',compact('Wharehouse','Level'));
  }
  function bins()
  {
    return view('dashboard/bins');
  }
  function rows()
  {
    return view('dashboard/rows');
  }
  function Boxes()
  {
    return view('dashboard/Boxes');
  }
  function users()
  {
    return view('dashboard/users');
  }
  function roles() {
    return view('dashboard/roles');
  }
}
