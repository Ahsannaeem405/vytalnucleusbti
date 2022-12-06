<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,Category,Product,ProductImage};
use Http;
use DB;
use Artisan;
use App\Jobs\ProductApi;
class AjaxController extends Controller
{
  public function __construct()
  {
      set_time_limit(8000000);
  }
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
  function check_product_box(Request $request)
  {

    if(Product::where('bar_code','=',$request->id)->exists()) {

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
  public function update_old_product(Request $request)
  {
    // dd($request->bar_code, $request->box_id);
    $data=Product::where('upc',$request->bar_code)->where('box_id',$request->box_id)->increment('qty');

    $product=Product::where('upc',$request->bar_code)->where('box_id',$request->box_id)->first();
    // dd($product);
    // update stock api on wocomerce start
      $updt_product=[
        'stock_quantity'=>$product->qty,
      ];
      $response = Http::withHeaders([
      'Content-Length' => 'application/json',
      ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$product->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);

      // update stock api on wocomerce end
      
      // update quantity on shopify start
        $variants[]=[
          'inventory_quantity' => $product->qty
        ];
        $productss=[
          'variants' => $variants
        ];
        $data6=[
          "product"=>$productss
        ];
        $response = Http::withHeaders([
        'X-Shopify-Access-Token' => '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',
        'Content-Type' => 'application/json'
        ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$product->shopfyid.json",$data6);

    // update quantity on shopify end 

  }
  function search_product(Request $request)
  {
    // $queryString = http_build_query([
    //   'api_key' => '896FA1DAB98241CCADB2D8908BC5EB51',
    //   'type' => 'product',
    //   'gtin' => $request->bar_code,
    //   'amazon_domain' => 'amazon.com',
    // ]);



    // $url='https://api.rainforestapi.com/request?'.$queryString;
    // $response=Http::get($url);
    //
    //
    // $res=json_decode($response->body());
    // $status=$res->request_info;



    // # print the JSON response from Rainforest API

    if(Product::where('upc',$request->bar_code)->where('read',1)->exists())
    {
      // dd('dddd');
      ///$product=DB::table('products')->where('upc',$request->bar_code)->where('box_id',$request->box_id)->increment('qty', 1);
      $data=Product::where('upc',$request->bar_code)->where('read',1)->first();
      return response()->json(['status'=>1,'product'=>$data]);

    }
    else{
      $product=new Product();
      $product->upc=$request->bar_code;
      $product->box_id=$request->box_id;
      $product->qty=1;
      $product->save();
      $data=Product::find($product->id);
      return response()->json(['status'=>0]);

    }

}
function import_view(){
  return view('import_view');
}
public function import(Request $request)
{



           $file=$request->image;






            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");


            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

              // Check file size
              if($fileSize <= $maxFileSize){

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location,$filename);

                // Import CSV to Database
                $filepath = public_path($location."/".$filename);

                // Reading file
                $file = fopen($filepath,"r");

                $importData_arr = array();
                $insertData=array();
                $i = 0;

                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                   $num = count($filedata );


                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){






                        $i++;
                        continue;


                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                   }
                   $i++;
                }


                fclose($file);

                // Insert to MySQL database


                foreach($importData_arr as $importData){


                  $insertData[]=[
                    'name'=>$importData[5],
                    'parent'=>$importData[4]
                  ];





                }
                foreach($insertData as $key => $value){
                   $newarray[$value['parent']][$key] = $value;
                }

                foreach($newarray as $key2 => $value2){
                  $input = array_map("unserialize", array_unique(array_map("serialize", $value2)));
                  foreach($input as $val3)
                  {
                    if($val3['name'] !='')
                    {
                      $id=Category::where('title',$val3['parent'])->first();
                      $add=new Category();
                      $add->title=$val3['name'];
                      $add->category_id=$id->id;


                      $add->save();

                    }



                  }






                }
                dd(Category::all());






                return Response()->json([
                    "success" => true,
                    "file" => $insertData,
                    "msg" => 'File Column Is Not Match According To Instructions.'
                ]);





              }else{
                return Response()->json([
                    "success" => false,
                    "msg" => 'Import Successful.File too large. File must be less than 2MB.'
                ]);
                Session::flash('message','File too large. File must be less than 2MB.');

              }

            }else{
                 return Response()->json([
                    "success" => false,
                    "msg" => 'Import Successful.Invalid File Extension.'
                ]);

            }




     }
     function send_in_queue()
     {
      $run =Artisan::call('schedule:run');



     }

     function start_queue()
     {
        $run =Artisan::call('queue:work --stop-when-empty');


     }
     function get_product(Request $request)
     {
       $product=Product::where('box_id',$request->id)->orderBy('id', 'DESC')->get();






       return view('ajax/get_product',compact('product'));
     }
     public function update_qty_ajax(Request $request)
     {
       $product=Product::whereUpc($request->utc)->where('box_id',$request->box_id)->first();
       if($product->qty <= $request->qty)
       {
           $del=Product::find($product->id);
           $del->delete();
           return response()->json(['status'=>0,'upc'=>$del->upc]);
       }
       else{
           $qty=$product->qty-$request->qty;

           $del=Product::find($product->id);
           $del->qty=$qty;
           $del->update();

           // update stock api on wocomerce start
        $updt_product=[
          'stock_quantity'=>$del->qty,
        ];
        $response = Http::withHeaders([
        'Content-Length' => 'application/json',
        ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$del->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);

        // update stock api on wocomerce end
        // dd($all,12);
        
        // update quantity on shopify start
          $variants[]=[
            'inventory_quantity' => $del->qty
          ];
          $productss=[
            'variants' => $variants
          ];
          $data5=[
            "product"=>$productss
          ];
      
          $token = env('shop_access_token');
          $response = Http::withHeaders([
          'X-Shopify-Access-Token' => $token,
          'Content-Type' => 'application/json'
          ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$del->shopfyid.json",$data5);

        // update quantity on shopify end 

           return response()->json(['status'=>$qty,'upc'=>$del->upc]);

       }





     }
      function edit_product(Request $request)
      {
       $row=Product::find($request->id);
       $cat=Category::whereNull('category_id')->get();
       return view('ajax/edit_product',compact('row','cat'));
      }

      function edit_new_product(Request $request)
      {
       $row=$request->id;
       $cat=Category::whereNull('category_id')->get();
       return view('ajax/edit_new_product',compact('row','cat'));
      }
      function get_cat(Request $request)
      {
        $cat=Category::where('category_id',$request->id)->get();
        $count=Category::where('category_id',$request->id)->count();

        return view('ajax/get_cat',compact('cat','count'));
      }
      function product_image_remove(Request $request)
      {
        $image=ProductImage::find($request->id);
        $image->delete();

        return response()->json(200);
      }
      function filter_product(Request $request)
      {
        if($request->id=='name')
        {
          $get='name';
        }
        if($request->id=='price')
        {
          $get='price';
        }
        if($request->id=='description')
        {
          $get='description';
        }
        if($request->id=='image')
        {
          $get='image';
        }
        if($request->id=='non_upload')
        {
          $get='upload';
        }

        if($request->id=='upload')
        {
          $get='upload';
          $product=Product::whereNotNull($get)->get();
          return view('ajax/filter_product',compact('product'));

        }
        if($request->id=='qty')
        {

          $product=Product::whereNotNull('qty')->get();
          return view('ajax/filter_product',compact('product'));

        }
        if($request->id=='out_qty')
        {

          $product=Product::where('qty',0)->get();
          return view('ajax/filter_product',compact('product'));

        }
        if($request->id=='upload')
        {

          $product=Product::where('upload',1)->get();
          return view('ajax/filter_product',compact('product'));

        }
        if($request->id=='cat')
        {

          $product=Product::doesntHave('categories')->get();
          return view('ajax/filter_product',compact('product'));

        }
        if($request->id=='1')
        {

          $product=Product::orderBy('updated_at', 'desc')->get();
          return view('ajax/filter_product',compact('product'));

        }



        $product=Product::whereNull($get)->get();
        return view('ajax/filter_product',compact('product'));


      }
      function filter_product_wharehouse(Request $request)
      {
        $id=$request->id;
        $product=Product::whereHas('get_box', function($query) use($id) {
           $query->where('w_id', $id);
        })->get();
        return view('ajax/filter_product',compact('product'));

      }
      function search_global_product(Request $request)
      {
        $id=$request->box_id;
        $product=Product::where('upc', $id)->get();
        return view('ajax/search_global_product',compact('product'));

      }
      function update_cost(Request $request)
      {
        $id=$request->box_id;
        $product=Product::find($request->id);
        $product->cost=$request->cost;
        $product->save();
        return response()->json(200);

      }
      function update_price(Request $request)
      {
        $id=$request->box_id;
        $product=Product::find($request->id);
        $product->price=$request->price;
        $product->save();
        return response()->json(200);

      }









}
