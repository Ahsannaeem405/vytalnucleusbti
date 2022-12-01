<?php

namespace App\Console\Commands;

use App\Jobs\GetOrder;
use Illuminate\Console\Command;
use App\Models\Product;
use App\Jobs\ProductApi;
use App\Jobs\ProductStatusChange;
use App\Jobs\ProductUploadApi;
use Http;


class SendJobCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendjob:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$product=Product::whereNull('read')->whereNull('upload_queue')->get();
        $product_upload=Product::whereNull('upload')->whereNull('upload_queue')->get()->groupBy('upc');
        $jobs = \DB::table('jobs')->count();
        foreach($product_upload as $key => $row)
        {
          $id=$key;
          $value=Product::where('upc',$id)->get();
          {
            foreach ($value as $pro) {
              $product_update=Product::find($pro->id);
              $product_update->upload_queue=1;
              $product_update->update();
               
            }
          }
          dispatch(new ProductUploadApi($id))->delay($jobs * 60);
        }


        // 
      //change status to active 
      $product_draft=Product::whereNotNull('wo_id')->whereHas('Productcatgry')->whereStatus('draft')->get()->groupBy('upc');
      $domainn = "wocommerce";
      foreach($product_draft as $key => $row)
      {
        $id=$key;
        $value=Product::where('upc',$id)->get();
        dispatch(new ProductStatusChange($value, $domainn))->delay($jobs * 60);
        
      }
      // 

    $product_draftshopify=Product::whereNotNull('shopfyid')->whereHas('Productcatgry')->where('shopify_status', 'draft')->get()->groupBy('upc');
    $domainn = "shopify";
    foreach($product_draftshopify as $key => $row)
    {
      $id=$key;
      $value=Product::where('upc',$id)->get();
      dispatch(new ProductStatusChange($value, $domainn))->delay($jobs * 60);
    }
    // dd($product_draftshopify, 22);


      // get order api start
      $response = Http::withHeaders([
      // 'Content-Length' => 'application/json',
      ])->get('https://bulkbuys.online/wp-json/wc/v3/orders?status=pending,processing&consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38');
      $orders=json_decode($response->body());
      $statusttt=$response->status();
      $jobs_total = \DB::table('jobs')->count();
      $domainn = 'wo';
      dispatch(new GetOrder($orders, $domainn))->delay($jobs_total * 5);

      // get order api end

      // get shopify order api start

      $response = Http::withHeaders([
        'X-Shopify-Access-Token' => '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',
        // 'Content-Type' => 'application/json'
        ])->get('https://bulk-masters.myshopify.com/admin/api/2022-10/orders.json?financial_status=pending');
        $result=json_decode($response->body());
        $status=$response->status();

      $jobs_total_forshop = \DB::table('jobs')->count();
      $domainn = 'shop';

        foreach($result as $orders)
        {
          dispatch(new GetOrder($orders, $domainn))->delay($jobs_total_forshop * 5);

        }
      // get shopify order api end


    }
}
