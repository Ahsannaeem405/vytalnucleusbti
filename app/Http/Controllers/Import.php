<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User,ProductCategory,ProductImage,Category};
use App\Models\Product;

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
}
