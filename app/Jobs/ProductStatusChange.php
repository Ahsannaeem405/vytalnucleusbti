<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\ProducttCategory;
use Http;


class ProductStatusChange implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $value;
    protected $domainn;
    public function __construct($value, $domainn)
    {
        $this->value = $value;
        $this->domainn = $domainn;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $product = $this->value;
        if($this->domainn == "wocommerce")
        {
          
          foreach($product as $pro) {
              $wo_id = $pro->wo_id;
              $add_product=[
                "status"=>'publish',
              ];
              $response = Http::withHeaders([
              'Content-Length' => 'application/json',
              ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);

              $wo_status=$response->status();
              if($wo_status == 200)
              {
                $product_update=Product::find($pro->id);
                $product_update->status='publish';
                $product_update->update();

              }
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
                    foreach($category_result as $categ)
                    {
                      if(strcasecmp($categ->name, $prdct_category->category_name) == 0)
                      {
                        var_dump($categ->name);
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
                          $category->wo_upload = 'yes';
                          $category->update();
                        }
                      }
                    }
                }
              }
          }

        }else{
          foreach($product as $pro) {
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
        
    }
}
