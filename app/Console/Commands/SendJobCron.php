<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Jobs\ProductApi;
use App\Jobs\ProductStatusChange;
use App\Jobs\ProductUploadApi;


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
      foreach($product_draft as $key => $row)
      {
        $id=$key;
        $value=Product::where('upc',$id)->get();
        dispatch(new ProductStatusChange($value))->delay($jobs * 15);
        
      }
      

    }
}
