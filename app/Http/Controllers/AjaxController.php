<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,Category,Product};
use Http;
use DB;
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
      ///$product=DB::table('products')->where('upc',$request->bar_code)->where('box_id',$request->box_id)->increment('qty', 1);
      $data=Product::where('upc',$request->bar_code)->where('read',1)->first();
      return response()->json(['status'=>1,'product'=>$data]);

    }
    else{
      // $product=new Product();
      // $product->upc=$request->bar_code;
      // $product->box_id=$request->box_id;
      // $product->qty=1;
      // $product->save();
      // $data=Product::find($product->id);
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





}
