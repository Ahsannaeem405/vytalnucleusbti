<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;
use App\Models\Product;
use DB;


class AddProduct extends Controller
{
  public function create_product()
  {
      $Box=Box::all();
      return view('dashboard/create_product' ,compact('Box'));
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
        else{


          $product=new Product();
          $product->upc=$val;
          $product->box_id=$request->box_id;
          $product->qty=$request->qty[$key];
          $product->save();



        }

      }

  }

}
