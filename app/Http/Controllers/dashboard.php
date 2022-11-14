<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User};
use Spatie\Permission\Models\Role;
use Http;
use Signifly\Shopify\Shopify;
use App\Models\Product;
use DB;

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
   
    
    

    // $Product=Product::whereNull('shopfyid')->get()->groupBy('upc');
  
    // foreach ($Product as $key => $value) {



    //   $sum=Product::where('upc',$key)->sum('qty');
      
    //   $add_product=[
    //     "name"=>$value[0]->name.'44545',
    //     "type"=>"simple",
    //     "regular_price"=> $value[0]->price,
    //     'price'=>$value[0]->price,
    //     'sku'=>$value[0]->sku,
    //     "description"=> $value[0]->description,
    //     "short_description"=> $value[0]->description,
    //     "status"=>'draft',
    //   ];
    //   $response = Http::withHeaders([
    // 'Content-Length' => 'application/json',
    //  ])->post('https://bulkbuys.online/wp-json/wc/v3/products?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38',$add_product);
      
      
    //   $wo_status=$response->status();
    //   dd($wo_status,$response->body());

      




    //   $response = Http::post('https://bulkbuys.online/wp-json/wc/v3/products?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38',$add_product);
      
    //   $variants[]=[
    //   "price"=> $value[0]->price,
    //   "sku"=> $value[0]->sku,
    //   "barcode"=>$value[0]->bar_code,
    //   "inventory_quantity"=>$sum

    //   ];
    //   $images[]= [
    //       "position"=> 1,
    //       "alt"=> $value[0]->name,
    //       "width"=> 800,
    //       "height"=> 600,
    //       "src"=> "",
    //   ];
    //   $dis=$value[0]->description;

    //   $product=[
    //     "title"=>$value[0]->name,
    //     "body_html"=>$dis,
    //     "vendor"=>"Burton",
    //     "product_type"=>"Snowboard",
    //     'status'=>'draft',
    //     "variants"=>$variants,
    //     "images"=>$images

    //   ];


    //   $data=[
    //     "product"=>$product
    //   ];


    //   $response = Http::withHeaders([
    //   'X-Shopify-Access-Token' => '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',
    //   'Content-Type' => 'application/json'
    //   ])->post('https://bulk-masters.myshopify.com/admin/api/2022-10/products.json',$data);
    //   $result=json_decode($response->body());
    //   $status=$response->status();

    //   if ($status==201) {
    //     $shop_id=$result->product->id;
    //     $get_pro=Product::where('upc',$key)->get();
    //     foreach ($get_pro as $prod) {
    //       $pro=Product::find($prod->id);
    //       $pro->shopfyid=$shop_id;
    //       $pro->update();
    //     }
        
    //    } 
      

     

    // }
    
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
    $Box=Box::orderBy('id', 'desc')->take(10)->get();
    $Level = Box::get()->unique('level_id');
    $Bin=Box::get()->unique('bin_id');
    $Row=Box::get()->unique('row_id');
    return view('dashboard/index',compact('Wharehouse','Level','Bin','Row','Box'));
  }

  function inventory()
  {
    // dd('dd');
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
