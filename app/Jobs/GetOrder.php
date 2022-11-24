<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $orders;
    public function __construct($orders)
    {
        //
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $allorder = $this->orders;
        foreach($allorder as $order)
        {
            
            foreach($order->line_items as $ordr)
            {
                
                $prod_exist = Product::where('wo_id', $ordr->product_id)->exists();
                if($prod_exist)
                {
                $prodt = Product::where('wo_id', $ordr->product_id)->get();

                foreach($prodt as $prood)
                    {
                    $order_exist = Order::where('product_id', $prood->id)->where('order_id', $order->id)->exists();
                    if(!$order_exist)
                    {
                        \Log::info('ordser add');
                        $order_add = new Order();
                        $order_add->product_id = $prood->id;
                        $order_add->order_id = $order->id;
                        $order_add->quantity = $ordr->quantity;
                        $order_add->status = $order->status;
                        $order_add->save();
                        
                        if($prood->qty != null || $prood->qty != 0 || $prood->qty <$ordr->quantity)
                        {
                            $prood->r_qty += $ordr->quantity;
                            $prood->qty -= $ordr->quantity;
                            $prood->update();
                        }
                    }

                    }
                }
            }
        }
    }
}
