<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Jobs\ProductApi;
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
        $product=Product::whereNull('read')->get();
        $product_upload=Product::whereNull('upload')->get()->groupBy('upc');
        $jobs = \DB::table('jobs')->count();
        foreach($product_upload as $key => $row)
        {
          $id=$key;
          dispatch(new ProductUploadApi($id))->delay($jobs * 60);
          
          $value=Product::where('upc',$id)->get();
          {
            foreach ($value as $pro) {
               
              $product_update=Product::find($pro->id);
              $product_update->rain_queue=1;
              $product_update->save();
            }

          }


        }

    }
}
