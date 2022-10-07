<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Product;
use DB;
use Http;


class AddProduct extends Controller
{
  function product()
  {
    $product=Product::get();
    return view('dashboard/product',compact('product'));
  }
  public function create_product()
  {
    // $queryString = http_build_query([
    //   'api_key' => '896FA1DAB98241CCADB2D8908BC5EB51',
    //   'type' => 'product',
    //   'gtin' => '071249404324',
    //   'amazon_domain' => 'amazon.com',
    // ]);
    //
    //
    //
    // $url='https://api.rainforestapi.com/request?'.$queryString;
    // $response=Http::get($url);
    //
    //
    // $res=json_decode($response->body());
    // $status=$res->request_info;

      $Box=Box::all();
      return view('dashboard/create_product' ,compact('Box'));
  }
  public function create_inventory_product($id)
  {


      $Box=Box::find($id);
      $product=Product::where('box_id',$Box->name)->get();
      return view('dashboard/create_inventory_product' ,compact('Box','product'));
  }

  public function add_product(Request $request)
  {

      foreach($request->upc as $key=>$val)
      {

        if(Product::where('upc',$val)->where('box_id',$request->box_id)->exists())
        {
          $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->increment('qty',$request->qty[$key]);
          //if(Product::where('upc',$val->upc)->where('read',1)->exists())

        }
        else
        {
          if(Product::where('upc',$val)->where('read',1)->exists())
          {
            $get=Product::where('upc',$val)->where('read',1)->first();

            $product=new Product();
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            $product->name=$get->name;
            $product->image=$get->image;
            $product->read=1;
            $product->save();
          }
          else{
            $product=new Product();
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            $product->save();

          }






        }

      }

    return response()->json(200);
  }
  public function add_inventory_product(Request $request)
  {

      foreach($request->upc as $key=>$val)
      {
            $product=Product::firstOrNew(array('id' => $request->id[$key]));
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            if(Product::where('upc',$val)->where('read',1)->exists())
            {
              $get=Product::where('upc',$val)->where('read',1)->first();
              $product->name=$get->name;
              $product->image=$get->image;
              $product->read=1;
            }
            $product->save();



      }
      return response()->json(200);


  }

}
