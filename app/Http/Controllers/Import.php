<?php

namespace App\Http\Controllers;

use App\Jobs\ProductStatusChange;
use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User,ProductCategory,ProductImage,Category, Order, ProducttCategory};
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

  public function active_product()
  {

    // $response = Http::withHeaders([
    //   // 'Content-Length' => 'application/json',
    //   ])->get("https://bulkbuys.online/wp-json/wc/v3/products/41290?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38");
  
    //     $wo_status=$response->status();
    //     $orders=json_decode($response->body());
    //     dd(555, $wo_status, $orders);
    




    // $add_product=[
    //   "status"=>'publish',
    //   "manage_stock" => true,
    //   'stock_quantity'=>12,
    //   "stock_status" => 'outofstock',
    // ];
    // $response = Http::withHeaders([
    // 'Content-Length' => 'application/json',
    // ])->put("https://bulkbuys.online/wp-json/wc/v3/products/41290?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);

    //   $wo_status=$response->status();
    //   $orders=json_decode($response->body());
    //   if($orders->stock_quantity == null)
    //   {
    //     dd(34, $wo_status,$orders->stock_quantity, $orders);

    //   }
    //   dd('44',$orders->stock_quantity);


    // get order api start
    $response = Http::withHeaders([
      // 'Content-Length' => 'application/json',
      ])->get('https://bulkbuys.online/wp-json/wc/v3/orders?status=pending,processing&consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38');
      $orders=json_decode($response->body());
      $status=$response->status();

      foreach($orders as $order)
      {
          foreach($order->line_items as $ordr)
          {
            
            $prod_exist = Product::where('wo_id', $ordr->product_id)->exists();
            if($prod_exist)
            {
              $prodt = Product::where('wo_id', $ordr->product_id)->get();

              foreach($prodt as $prood)
                {
                  $order_exist = Order::where('product_id', $prood->id)->where('order_id', $order->id)->exists();
                  if(!$order_exist)
                  {
                    $order_add = new Order();
                    $order_add->product_id = $prood->id;
                    $order_add->order_id = $order->id;
                    $order_add->quantity = $ordr->quantity;
                    $order_add->total_qty = $ordr->quantity;
                    $order_add->status = $order->status;
                    $order_add->save();
                    
                      if($prood->qty != null || $prood->qty != 0 || $prood->qty <$ordr->quantity)
                      {
                        $prood->r_qty += $ordr->quantity;
                        $prood->qty -= $ordr->quantity;
                        $prood->update();
                      }
                  }

                }
            }
          }
      }

      dd($orders, $status,'111111111');
      // get order api end


    // dd($result, $status,'orders');

    // create order api start
    // $billing[]= [
    //   "first_name" => "John",
    //   "last_name"=>"Doe",
    //   "address_1"=>"969 Market",
    //   "address_2"=> "",
    //   "city"=> "San Francisco",
    //   "state"=> "CA",
    //   "postcode"=> "94103",
    //   "country"=> "US",
    //   "email"=> "john.doe@example.com",
    //   "phone"=> "(555) 555-5555",
    // ];
    // $line_items[] = [
    //     "product_id"=> 40982,
    //     "quantity"=> 2,
        
    //   ];
    // $line_items[] = [
    //     "product_id"=> 41021,
    //     "quantity"=> 3,
        
    //   ];

    // $add_product=[
    //   "payment_method"=> "bacs",
    //   "payment_method_title"=> "Direct Bank Transfer",
    //   "currency" => "USD",
    //   "set_paid"=> true,
    //   "billing" => $billing,
    //   "line_items" => $line_items,
    // ];
    // $response = Http::withHeaders([
    // 'Content-Length' => 'application/json',
    // ])->post('https://bulkbuys.online/wp-json/wc/v3/orders?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38',$add_product);
    
    // $result=json_decode($response->body());
    // $status=$response->status();


    // dd($result, $status,'orders');

    // create order api end






    // dd('333');

    $product_draft=Product::whereNotNull('wo_id')->whereHas('Productcatgry')->whereStatus('draft')->get()->groupBy('upc');
    // dd($product_draft,'666');
      $domainn = "wocommerce";
      $lop = 0;
      foreach($product_draft as $key => $row)
      {
        $id=$key;
        $value=Product::where('upc',$id)->get();
        // if($lop ==0)
        //     {
            //   var_dump('<pre>');
            //   var_dump($value[0]->Productcatgry,'test prod');
            //   var_dump('</pre>');
            // // }else{
            //   var_dump('<pre>');
            //   var_dump($value[1]->Productcatgry);
            //   var_dump('</pre>');

            // }
        // dd($product_draft,$value);
        foreach($value as $pro) {
          
          $wo_id = $pro->wo_id;
          

          
          foreach($pro->Productcatgry as $prdct_category)
          {
              //
              $category_exiist = ProducttCategory::find($prdct_category->id);
              if($category_exiist->wo_upload != 'yes')
              {
                

              
                $response = Http::withHeaders([
                // 'Content-Length' => 'application/json',
                ])->GET("https://bulkbuys.online/wp-json/wc/v3/products/categories?search=$prdct_category->category_name&consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38");
              
                $category_result=json_decode($response->body());
                // \Log::info($category_result);
                // \Log::info('teseted');
                foreach($category_result as $categ)
                {
                  // dd($categ->name);
                  if(strcasecmp($categ->name, $prdct_category->category_name) == 0)
                  {
                    // var_dump($categ->name);
                      $categories[]= [
                        "id"=> $categ->id,
                        "name"=> $categ->name,
                        "slug"=> $categ->name,
                      ];
          
                    $add_product=[
                      "categories" => $categories,
                    ];
                    $response = Http::withHeaders([
                    'Content-Length' => 'application/json',
                    ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);
                    // break;
                    $woo_status=$response->status();
                    if($woo_status == 200)
                    {
                      $category = ProducttCategory::find($prdct_category->id);
                      // dd($category, 9);
                      $category->wo_upload = 'yes';
                      $category->update();

                    }
                  }
                }
              }

          }
          $lop++;

          
          
        }
      // dd('dddd');
        
      }
      
      dd($product_draft,'22','11','11111');




    $response = Http::withHeaders([
      // 'Content-Length' => 'application/json',
      ])->GET("https://bulkbuys.online/wp-json/wc/v3/products/categories?search=Pet Supplies&consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38");
    
      $result=json_decode($response->body());
      foreach($result as $categ)
      {
        // dd($categ->name);
        if(strcasecmp($categ->name, 'live aniMals') == 0)
        {
          var_dump($categ->name);
            $categories[]= [[
              "id"=> 3327,
              "name"=> 'Animals & Pet Supplies',
              "slug"=> 'Animals & Pet Supplies',
            ],[
              "id"=> 3329,
              "name"=> 'Pet Supplies',
              "slug"=> 'Pet Supplies',]
            ];

          $add_product=[
            "status"=>'draft',
            "categories" => $categories,
          ];
          $response = Http::withHeaders([
          'Content-Length' => 'application/json',
          ])->put("https://bulkbuys.online/wp-json/wc/v3/products/41290?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);

          break;


        }else{
           var_dump('not this name match');
        }
      }
      $wo_status=$response->status();

    // $add_product=[
    //   "status"=>'publish',
    // ];
    // $response = Http::withHeaders([
    // 'Content-Length' => 'application/json',
    // ])->put("https://bulkbuys.online/wp-json/wc/v3/products/41290?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);
    
    // // \Log::info($response);
    // // \Log::info('MEW');
    // $wo_status=$response->status();
    // $result=json_decode($response->body());
    dd($wo_status, $result, '44a4');



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
