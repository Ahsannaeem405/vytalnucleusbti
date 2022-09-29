<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User};
use Spatie\Permission\Models\Role;

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
    $Wharehouse=Wharehouse::all();
    $Level = Box::get()->unique('level_id');
    $Bin=Box::get()->unique('bin_id');
    $Row=Box::get()->unique('row_id');
    return view('dashboard/index',compact('Wharehouse','Level','Bin','Row'));
  }
  function product()
  {
    return view('dashboard/product');
  }
  function inventory()
  {
    $Wharehouse=Wharehouse::all();
    $Box=Box::all();
    $count=Box::count();
    $count++;
    return view('dashboard/Boxes',compact('Wharehouse','Box','count'));

    return view('dashboard/inventory',compact('Box','Wharehouse'));
  }
  function warehouse()
  {
    $Wharehouse=Wharehouse::all();
    return view('dashboard/warehouse',compact('Wharehouse'));
  }
  function levels()
  {
    $Wharehouse=Wharehouse::all();
    $Level = Box::get()->unique('level_id');
    return view('dashboard/levels',compact('Wharehouse','Level'));
  }
  function bins()
  {
    $Wharehouse=Wharehouse::all();
    $Level=Level::all();
    $Bin=Box::get()->unique('bin_id');

    return view('dashboard/bins' , compact('Wharehouse','Level','Bin'));
  }
  function rows()
  {
    $Wharehouse=Wharehouse::all();
    $Row=Box::get()->unique('row_id');
    return view('dashboard/rows',compact('Wharehouse','Row'));
  }
  function Boxes()
  {
    $Wharehouse=Wharehouse::all();
    $Box=Box::all();
    $count=Box::count();
    $count++;
    return view('dashboard/Boxes',compact('Wharehouse','Box','count'));
  }
  function users()
  {
    $user=User::get();
    $role=Role::all();

    return view('dashboard/users',compact('user','role'));
  }
  function roles() {
    $role=Role::all();
    return view('dashboard/roles',compact('role'));
  }
}
