<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    return view('dashboard/inventory');
  }
  function warehouse()
  {
    return view('dashboard/warehouse');
  }
  function levels()
  {
    return view('dashboard/levels');
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
