<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
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
    public function __construct($value)
    {
        $this->value = $value;
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
       
        foreach($product as $pro) {
            $wo_id = $pro->wo_id;
           
            // dd($wo_id);
            $add_product=[
              "status"=>'publish',
            ];
            $response = Http::withHeaders([
            'Content-Length' => 'application/json',
            ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$add_product);
            
            // \Log::info($response);
            \Log::info('MEW');
            $wo_status=$response->status();
            if($wo_status == 200)
            {
              $product_update=Product::find($pro->id);
              $product_update->status='publish';
              $product_update->update();

            }
        }
        
    }
}
