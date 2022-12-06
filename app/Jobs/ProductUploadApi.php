<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Wharehouse,Level,Bin,Row,Box,Category,Product};
use Http;


class ProductUploadApi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {



      $sum=Product::where('upc',$this->id)->sum('qty');
      $value=Product::where('upc',$this->id)->first();
      if($sum > 0)
      {
        $sat='instock';
      }

      $images2[] =  [
        "src" => $value->image,
        "alt" => $value->name,
      ];
      $tags2[] = [
        $value->tag,
      ];
      $meta_data[] = [
        "id" => 181161,
        "key" => "_et_gtin",
        "value" => $value->upc,
      ];

      $add_product=[
        "name"=>$value->name,
        "type"=>"simple",
        "regular_price"=> $value->price,
        'price'=>$value->price,
        'sku'=>$value->sku,
        "manage_stock" => true,
        'stock_quantity'=>$sum,
        'stock_status'=>$sat,
        "description"=> $value->description,
        "short_description"=> $value->description,
        "status"=>'draft',
        "images" => $images2,
        "tags" => $tags2,
        "meta_data" => $meta_data,
      ];
      $response = Http::withHeaders([
      'Content-Length' => 'application/json',
      ])->post('https://bulkbuys.online/wp-json/wc/v3/products?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38',$add_product);
      
      
      $wo_status=$response->status();
      
      

      if($wo_status==201) {
        $result=json_decode($response->body());

        $shop_id=$result->id;
        $get_pro=Product::where('upc',$this->id)->get();
        foreach ($get_pro as $prod) {
          $pro=Product::find($prod->id);
          $pro->wo_id=$shop_id;
          $pro->update();
        }
        
      } 

      \Log::info('woocomerce product updoad');
      \Log::info($wo_status);
      $variants[]=[
      "price"=> $value->price,
      "sku"=> $value->sku,
      "cost" => $value->cost,
      "barcode"=>$value->upc,
      "fulfillment_service"  => "manual",
      "inventory_management" => "shopify",
      "inventory_quantity"=>$sum,

      ];
      $images[]= [
          "position"=> 1,
          "alt"=> $value->name,
          "width"=> 800,
          "height"=> 600,
          "src"=> $value->image,
      ];
      $dis=$value->description;

      $tags = [
        $value->tag,
      ];
      $product=[
        "title"=>$value->name,
        "body_html"=>$dis,
        "vendor"=>"Burton",
        "product_type"=>"Snowboard",
        'status'=>'draft',
        "variants"=>$variants,
        "images"=>$images,
        "tags" => $tags

      ];


      $data=[
        "product"=>$product
      ];

      $token = env('shop_access_token');
      $response = Http::withHeaders([
      'X-Shopify-Access-Token' => $token,
      'Content-Type' => 'application/json'
      ])->post('https://bulk-masters.myshopify.com/admin/api/2022-10/products.json',$data);
      $result=json_decode($response->body());
      $status=$response->status();

      if ($status==201) {
        $shop_id=$result->product->id;
        $get_pro=Product::where('upc',$this->id)->get();
        foreach ($get_pro as $prod) {
          $pro=Product::find($prod->id);
          $pro->shopfyid=$shop_id;
          $pro->update();
        }
        
      } 
      if($wo_status==201 && $status==201) {
        $get_pro=Product::where('upc',$this->id)->get();
        foreach ($get_pro as $prod) {
          $pro=Product::find($prod->id);
          $pro->upload=1;
          $pro->update();
        }

      }

      \Log::info('shopify product updoad');
      \Log::info($status);

      

     

    }
     
     
}
