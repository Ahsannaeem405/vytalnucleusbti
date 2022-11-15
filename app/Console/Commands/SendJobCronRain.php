<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Jobs\ProductApi;
use App\Jobs\ProductUploadApi;


class SendJobCronRain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendjobrain:cron';

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
        $product=Product::whereNull('read')->whereNull('rain_queue')->get();
        $jobs = \DB::table('jobs')->count();
        foreach($product as $row)
        {
          $id=$row->id;
          $product_update=Product::find($id);
          $product_update->rain_queue=1;
          $product_update->update();
          dispatch(new ProductApi($id))->delay($jobs * 60);
           

        }

    }
}
