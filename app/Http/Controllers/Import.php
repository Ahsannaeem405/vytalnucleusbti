<?php

namespace App\Http\Controllers;

use App\Jobs\ProductStatusChange;
use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User,ProductCategory,ProductImage,Category, ProducttCategory};
use App\Models\Product;
use Http;

class Import extends Controller
{
  public function import_product(Request $request)
  {
    $file = $request->file('file');

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
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
           $num = count($filedata );


           // Skip first row (Remove below comment if you want to skip the first row)
           if($i == 0){



              if($filedata[0]=="Title" && $filedata[1]=="Description" && $filedata[2]=="Image" && $filedata[3]=="Quantity" && $filedata[4]=="Reserved Quantity" && $filedata[5]=="Cost" && $filedata[6]=="Price" && $filedata[7]=="UPC" && $filedata[8]=="Variant/Color" && $filedata[9]=="SKU" && $filedata[10]=="Uploaded Status" && $filedata[11]=="Inventory Locations" && $filedata[12]=="Categories"  && $filedata[13]=="Tags")
              {
                  //dd($filedata [0],"id",$filedata [1],"Sku", $filedata [2],"Location_id", $filedata [4],"Tag",'sss');

                $i++;
                continue;
              }
              else{
                 // dd($filedata [0],"id",$filedata [1],"Sku", $filedata [2],"Location_id", $filedata [4],"Tag");
                  return back()->with('success','File Column Is Not Match According To Sample File');

              }
           }
           for ($c=0; $c < $num; $c++) {
              $importData_arr[$i][] = $filedata [$c];
           }
           $i++;
        }

        fclose($file);

        // Insert to MySQL database

        foreach($importData_arr as $importData){

            if (Product::where('upc', '=', $importData[7])->where('box_id',$importData[11])->exists())
            {
              $all=Product::where('upc', '=', $importData[7])->where('box_id',$importData[11])->get();
              foreach($all as $all_row)
              {
                $product=Product::find($all_row->id);
                $product->name=$importData[0];
                $product->description=$importData[1];
                $product->qty=$importData[3];
                $product->r_qty=$importData[4];
                $product->price=$importData[6];
                $product->cost=$importData[5];
                $product->vc=$importData[8];
                $product->sku=$importData[9];
                $product->tag=$importData[13];
                $product->save();
 
              }

            }
            else{

                $product=new Product();
                $product->name=$importData[0];
                $product->box_id=$importData[11];
                $product->upc=$importData[7];
                $product->description=$importData[1];
                $product->qty=$importData[3];
                $product->r_qty=$importData[4];
                $product->price=$importData[6];
                $product->cost=$importData[5];
                $product->vc=$importData[8];
                $product->sku=$importData[9];
                $product->tag=$importData[13];
                $product->save();
                

            }


        }




      }else{

        return back()->with('error', 'File too large. File must be less than 2MB.');

      }

    }else{
      return back()->with('error', 'Invalid File Extension.');

    }
    return back()->with('success', 'Product Import Successfully.');


  }


  public function import_product_chainable(Request $request)
  {
    $file = $request->file('file');

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
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
           $num = count($filedata );


           // Skip first row (Remove below comment if you want to skip the first row)
           if($i == 0){



              if($filedata[0]=="Title" && $filedata[1]=="Description" && $filedata[2]=="Image" && $filedata[3]=="Quantity" && $filedata[4]=="Reserved Quantity" && $filedata[5]=="Cost" && $filedata[6]=="Price" && $filedata[7]=="UPC" && $filedata[8]=="Variant/Color" && $filedata[9]=="SKU" && $filedata[10]=="Uploaded Status" && $filedata[11]=="Inventory Locations" && $filedata[12]=="Categories"  && $filedata[13]=="Tags")
              {
                  //dd($filedata [0],"id",$filedata [1],"Sku", $filedata [2],"Location_id", $filedata [4],"Tag",'sss');

                $i++;
                continue;
              }
              else{
                 // dd($filedata [0],"id",$filedata [1],"Sku", $filedata [2],"Location_id", $filedata [4],"Tag");
                  return back()->with('success','File Column Is Not Match According To Sample File');

              }
           }
           for ($c=0; $c < $num; $c++) {
              $importData_arr[$i][] = $filedata [$c];
           }
           $i++;
        }

        fclose($file);

        // Insert to MySQL database

        foreach($importData_arr as $importData){

          
          // dd($importData[11],$importData[12], explode(',',$importData[12]));

            if (Product::where('upc', '=', $importData[7])->where('box_id',$importData[11])->exists())
            {
              $all=Product::where('upc', '=', $importData[7])->where('box_id',$importData[11])->get();
              foreach($all as $all_row)
              {
                $product=Product::find($all_row->id);
                $product->name=$importData[0];
                $product->description=$importData[1];
                $product->qty=$importData[3];
                $product->r_qty=$importData[4];
                $product->price=$importData[6];
                $product->cost=$importData[5];
                $product->vc=$importData[8];
                $product->sku=$importData[9];
                $product->tag=$importData[13];
                $product->save();

                
 
              }
              $categoriess = explode(',',$importData[12]);
                foreach($categoriess as $cat)
                {
                  if(!ProducttCategory::where('upc_id', '=', $importData[7])->where('category_name',$cat)->exists())
                  {
                    $catgry = new ProducttCategory();
                    $catgry->upc_id = $importData[7];
                    $catgry->category_name = $cat;
                    $catgry->save();
                  }
                  

                }

            }
            // else{

            //     $product=new Product();
            //     $product->name=$importData[0];
            //     $product->box_id=$importData[11];
            //     $product->upc=$importData[7];
            //     $product->description=$importData[1];
            //     $product->qty=$importData[3];
            //     $product->r_qty=$importData[4];
            //     $product->price=$importData[6];
            //     $product->cost=$importData[5];
            //     $product->vc=$importData[8];
            //     $product->sku=$importData[9];
            //     $product->tag=$importData[13];
            //     $product->save();
                

            // }


        }




      }else{

        return back()->with('error', 'File too large. File must be less than 2MB.');

      }

    }else{
      return back()->with('error', 'Invalid File Extension.');

    }
    return back()->with('success', 'Product Updated Successfully.');


  }

  public function active_productaa()
  {




    // $response = Http::withHeaders([
    // 'X-Shopify-Access-Token' => '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',
    // 'Content-Type' => 'application/json'
    // ])->get("https://bulk-masters.myshopify.com/admin/api/2022-10/draft_orders/587667832964.json");

    $line_items[] =
      [
      "fulfillment_status" => "open",
      ];

    $orders=[
      
      "line_items" => $line_items
    ];

    $data=[
      "order"=>$orders
    ];

    $response = Http::withHeaders([
    'X-Shopify-Access-Token' => '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',
    'Content-Type' => 'application/json'
    ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/orders/3801545375876.json", $data);
    
    $result=json_decode($response->body());
    $sstatus=$response->status();
    dd(666,$sstatus, $result);

    // $response = Http::withHeaders([
    //   'X-Shopify-Access-Token' => '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',
    //   'Content-Type' => 'application/json'
    //   ])->get("https://bulk-masters.myshopify.com/admin/api/2022-10/products/7020663275652.json");
      
    //   $result=json_decode($response->body());
    //   $sstatus=$response->status();
    //   dd($sstatus, $result);



    dd('56565',$sstatus, $result);

    



    // $add_product=[
          
    //   "status"=>'publish',
    // ];
    // $response = Http::withHeaders([
    // 'Content-Length' => 'application/json',
    // ])->put("https://bulkbuys.online/wp-json/wc/v3/products/41290?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);
    
    
    // $wo_status=$response->status();
    // dd(12,$wo_status);

    // dd('22');

    // $product_upload=Product::whereNull('upload')->whereNull('upload_queue')->get()->groupBy('upc');
    
    $product_draftshopify=Product::whereNotNull('shopfyid')->whereHas('Productcatgry')->where('shopify_status', 'draft')->get()->groupBy('upc');
    foreach($product_draftshopify as $key => $row)
    {
      $id=$key;
      $value=Product::where('upc',$id)->get();
      
        foreach($value as $pro) {
          $shopfyid = $pro->shopfyid;
         
          // dd($wo_id);
          $productss=[
            'status' => 'active'
          ];
          $data=[
            "product"=>$productss
          ];
      
          $response = Http::withHeaders([
          'X-Shopify-Access-Token' => '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',
          'Content-Type' => 'application/json'
          ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$shopfyid.json",$data);
          $result=json_decode($response->body());
          $shopifystatus=$response->status();
          // dd($shopifystatus, $result);
      

          if($shopifystatus == 200)
          {
            $product_update=Product::find($pro->id);
            $product_update->shopify_status='publish';
            $product_update->update();

          }
      }
        
      
      
      
    }
    dd($product_draftshopify, 22);
      
      

      // if($wo_status==201) {
      //   $result=json_decode($response->body());

      //   $shop_id=$result->id;
      //   $get_pro=Product::where('upc',$this->id)->get();
      //   foreach ($get_pro as $prod) {
      //     $pro=Product::find($prod->id);
      //     $pro->wo_id=$shop_id;
      //     $pro->update();
      //   }
        
      // } 
  }
}
