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


class ProductApi implements ShouldQueue
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
      $product=Product::find($this->id);
      $queryString = http_build_query([
        'api_key' => '896FA1DAB98241CCADB2D8908BC5EB51',
        'type' => 'product',
        'gtin' => $product->upc,
        'amazon_domain' => 'amazon.com',
      ]);



      $url='https://api.rainforestapi.com/request?'.$queryString;
      $response=Http::get($url);
      //
      //
      $res=json_decode($response->body());
      $status=$res->request_info;
      if($status->success == True)
      {

        $product_update=Product::find($product->id);
        $product_update->name=$res->product->title;
        $product_update->image=$res->product->images_flat;
        if(isset($res->product->description))
        {
          $product_update->description=$res->product->description;
        }
        $product_update->read=1;
        $product_update->save();

      }
    }
}
