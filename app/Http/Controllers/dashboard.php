<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User};
use Spatie\Permission\Models\Role;
use Http;
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
    // $queryString = http_build_query([
    //   'api_key' => '26355D24D09E40F9A5977B641424B56B',
    //   'type' => 'product',
    //   'gtin' => '3605970725259',
    //   'amazon_domain' => 'amazon.com',
    // ]);
    // $url='https://api.rainforestapi.com/request?'.$queryString;
    //  $response=Http::get($url);
    //
    //
    // dd(json_decode($response->body()['request_info']['success']));

//
// # make the http GET request to Rainforest API
// $ch = curl_init(sprintf('%s?%s', 'https://api.rainforestapi.com/request', $queryString));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// # the following options are required if you're using an outdated OpenSSL version
// # more details: https://www.openssl.org/blog/blog/2021/09/13/LetsEncryptRootCertExpire/
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_TIMEOUT, 180);
//
// $api_result = curl_exec($ch);
// curl_close($ch);
//
// # print the JSON response from Rainforest API
// dd(json_decode($api_result));
    $Wharehouse=Wharehouse::all();
    $Level = Box::get()->unique('level_id');
    $Bin=Box::get()->unique('bin_id');
    $Row=Box::get()->unique('row_id');
    return view('dashboard/index',compact('Wharehouse','Level','Bin','Row'));
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
