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
      $value=Product::where('upc',$this->id)->get();
      if($sum > 0)
      {
        $sat='instock';
      }


      $add_product=[
        "name"=>$value[0]->name,
        "type"=>"simple",
        "regular_price"=> $value[0]->price,
        'price'=>$value[0]->price,
        'sku'=>$value[0]->sku,
        "manage_stock" => true,
        'stock_quantity'=>$sum,
        'stock_status'=>$sat,
        "description"=> $value[0]->description,
        "short_description"=> $value[0]->description,
        "status"=>'draft',
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
      $variants[]=[
      "price"=> $value[0]->price,
      "sku"=> $value[0]->sku,
      "barcode"=>$value[0]->bar_code,
      "inventory_quantity"=>$sum

      ];
      $images[]= [
          "position"=> 1,
          "alt"=> $value[0]->name,
          "width"=> 800,
          "height"=> 600,
          "src"=> "",
      ];
      $dis=$value[0]->description;

      $product=[
        "title"=>$value[0]->name,
        "body_html"=>$dis,
        "vendor"=>"Burton",
        "product_type"=>"Snowboard",
        'status'=>'draft',
        "variants"=>$variants,
        "images"=>$images

      ];


      $data=[
        "product"=>$product
      ];


      $response = Http::withHeaders([
      'X-Shopify-Access-Token' => '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',
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

      

     

    }
     
     
}
