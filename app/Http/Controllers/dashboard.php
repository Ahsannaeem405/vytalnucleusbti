<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box};

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
    $Box=Box::all();
    return view('dashboard/inventory',compact('Box'));
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
    $Wharehouse=Wharehouse::all();
    $Level=Level::all();
    $Bin=Bin::all();

    return view('dashboard/bins' , compact('Wharehouse','Level','Bin'));
  }
  function rows()
  {
    $Wharehouse=Wharehouse::all();
    $Row=Row::all();

    return view('dashboard/rows',compact('Wharehouse','Row'));
  }
  function Boxes()
  {
    $Wharehouse=Wharehouse::all();
    $Box=Box::all();

    return view('dashboard/Boxes',compact('Wharehouse','Box'));
  }
  function users()
  {
    return view('dashboard/users');
  }
  function roles() {
    return view('dashboard/roles');
  }
}
