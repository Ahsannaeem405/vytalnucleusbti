<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box};
use Http;
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
  function check_box(Request $request)
  {

    if (Box::where('name', '=', $request->id)->exists()) {
      return response()->json(201);
    }
    else{
      return response()->json(200);

    }


  }
  function check_update_box(Request $request)
  {

    if (Box::where('id','!=',$request->bin_id)->where('name', '=', $request->id)->exists()) {
      return response()->json(201);
    }
    else{
      return response()->json(200);

    }


  }

  function get_inventory(Request $request)
  {
    $Wharehouse=Wharehouse::all();


    $Box=Box::when($request->type == '1', function ($q) {
      return $q->orderBy('created_at', 'desc');
    })
    ->when($request->type == '2', function ($q) {
        return $q->orderBy('updated_at', 'desc');
    })
    ->whereIn('w_id',$request->id)

    ->get();



    return view('ajax/get_inventory',compact('Box','Wharehouse'));
  }
  function search_product(Request $request)
  {
    $queryString = http_build_query([
      'api_key' => '896FA1DAB98241CCADB2D8908BC5EB51',
      'type' => 'product',
      'gtin' => $request->bar_code,
      'amazon_domain' => 'amazon.com',
    ]);


    // $queryString = http_build_query([
    //   'api_key' => '26355D24D09E40F9A5977B641424B56B',
    //   'type' => 'product',
    //   'gtin' =>$request->bar_code,
    //   'amazon_domain' => 'amazon.com',
    // ]);
    $url='https://api.rainforestapi.com/request?'.$queryString;
    $response=Http::get($url);


    $res=json_decode($response->body());
    $status=$res->request_info;



    # print the JSON response from Rainforest API
    if($status->success ==1)
    {
      $product=$res->product;
      return response()->json(['status'=>$status->success ,'product'=>$product]);

    }
    else{
      return response()->json(['msg'=>$status->message,'status'=>$status->success]);

    }

}


}
