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
use Http;

class GetOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $orders;
    protected $domainn;

    public function __construct($orders, $domainn)
    {
        //
        $this->orders = $orders;
        $this->domainn = $domainn;

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
        if($this->domainn == "wo")
        {
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
                            $order_exist = Order::where('product_id', $prood->id)->where('order_id', $order->id)->where('order_from', 'woocommerce')->exists();
                            if(!$order_exist)
                            {
                                \Log::info('ordser add');
                                $order_add = new Order();
                                $order_add->product_id = $prood->id;
                                $order_add->order_id = $order->id;
                                $order_add->quantity = $ordr->quantity;
                                $order_add->total_qty = $ordr->quantity;
                                $order_add->status = $order->status;
                                $order_add->order_from = "woocommerce";

                                $order_add->save();
                                
                                if($prood->qty != null && $prood->qty != 0 && $prood->qty >$ordr->quantity)
                                {
                                    $prood->r_qty += $ordr->quantity;
                                    $prood->qty -= $ordr->quantity;
                                    $prood->update();

                                    // update stock api on wocomerce start
                                        $updt_product=[
                                            'stock_quantity'=>$prood->qty,
                                        ];
                                        $response = Http::withHeaders([
                                        'Content-Length' => 'application/json',
                                        ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$prood->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);
                
                                    // update stock api on wocomerce end
                                    
                                    // update quantity on shopify start
                                        $variants[]=[
                                        'inventory_quantity' => $prood->qty
                                        ];
                                        $productss=[
                                        'variants' => $variants
                                        ];
                                        $dataa=[
                                        "product"=>$productss
                                        ];
                                        // var_dump($prood->wo_id,$prood->shopfyid);
                                        $response = Http::withHeaders([
                                        'X-Shopify-Access-Token' => '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',
                                        'Content-Type' => 'application/json'
                                        ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$prood->shopfyid.json",$dataa);
            
                                    // update quantity on shopify end
                                }
                            }
                            sleep(40);

                        }
                    }
                    sleep(40);
                }
            }
        }else
        {
            foreach($allorder as $order)
            {
                // dd($order);
                
                foreach($order->line_items as $ordr)
                {
                    
                    $prod_exist = Product::where('shopfyid', $ordr->product_id)->exists();
                    if($prod_exist)
                    {
                    $prodt = Product::where('shopfyid', $ordr->product_id)->get();

                    foreach($prodt as $prood)
                        {
                            $order_exist = Order::where('product_id', $prood->id)->where('order_id', $order->id)->where('order_from', 'shopify')->exists();
                            if(!$order_exist)
                            {
                            

                                \Log::info('shopify orders add');
                                $order_add = new Order();
                                $order_add->product_id = $prood->id;
                                $order_add->order_id = $order->id;
                                $order_add->quantity = $ordr->quantity;
                                $order_add->total_qty = $ordr->quantity;
                                $order_add->status = $order->financial_status;
                                $order_add->order_from = "shopify";
                                $order_add->save();
                                
                                if($prood->qty != null && $prood->qty != 0 && $prood->qty >=$ordr->quantity)
                                {
                                    $prood->r_qty += $ordr->quantity;
                                    $prood->qty -= $ordr->quantity;
                                    $prood->update();

                                    // update stock api on wocomerce start
                                        $updt_product=[
                                            'stock_quantity'=>$prood->qty,
                                        ];
                                        $response = Http::withHeaders([
                                        'Content-Length' => 'application/json',
                                        ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$prood->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);
                
                                    // update stock api on wocomerce end
                                    
                                    // update quantity on shopify start
                                        $variants[]=[
                                        'inventory_quantity' => $prood->qty
                                        ];
                                        $productss=[
                                        'variants' => $variants
                                        ];
                                        $dataa=[
                                        "product"=>$productss
                                        ];
                                        // var_dump($prood->wo_id,$prood->shopfyid);
                                        $response9 = Http::withHeaders([
                                        'X-Shopify-Access-Token' => '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',
                                        'Content-Type' => 'application/json'
                                        ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$prood->shopfyid.json",$dataa);
            
                                    // update quantity on shopify end
                                }
                            }
                            sleep(40);
                        }
                    }
                    sleep(40);
                }
            }
        }
    }
}
