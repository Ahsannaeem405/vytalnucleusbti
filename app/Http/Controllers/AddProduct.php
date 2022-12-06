<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User,ProductCategory,ProductImage,Category, Order};
use App\Services\QtyService;

use App\Models\Product;
use DB;
use Http;


class AddProduct extends Controller
{
  private QtyService $QtyService;
  public function __construct(QtyService $QtyService)
    {
      // dd('123');

        $this->QtyService = $QtyService;
        $this->middleware('CheckRole');
    }
  function product()
  {
    $product=Product::get();
    $All_Box=Wharehouse::get();
    return view('dashboard/product',compact('product','All_Box'));
  }
  public function create_product()
  {
    // $queryString = http_build_query([
    //   'api_key' => '896FA1DAB98241CCADB2D8908BC5EB51',
    //   'type' => 'product',
    //   'gtin' => '071249404324',
    //   'amazon_domain' => 'amazon.com',
    // ]);
    //
    //
    //
    // $url='https://api.rainforestapi.com/request?'.$queryString;
    // $response=Http::get($url);
    //
    //
    // $res=json_decode($response->body());
    // $status=$res->request_info;

      $Box=Box::all();
       $cat=Category::whereNull('category_id')->get();
       $orders=Order::where('quantity', '>', 0)->get()->unique('order_id');

      return view('dashboard/create_product' ,compact('Box','cat', 'orders'));
  }
  public function create_inventory_product($id)
  {


      $Box=Box::find($id);
      $All_Box=Box::get();
      $product=Product::where('box_id',$Box->name)->orderBy('id', 'DESC')->get();
       $cat=Category::whereNull('category_id')->get();
       $orders=Order::where('quantity', '>', 0)->get()->unique('order_id');
      //  dd($orders);
      return view('dashboard/create_inventory_product' ,compact('Box','product','All_Box','cat', 'orders'));
  }

  public function add_product(Request $request)
  {

      foreach($request->upc as $key=>$val)
      {

        if(Product::where('upc',$val)->where('box_id',$request->box_id)->exists())
        {
          $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->increment('qty',$request->qty[$key]);
          //if(Product::where('upc',$val->upc)->where('read',1)->exists())

        }
        else
        {
          if(Product::where('upc',$val)->where('read',1)->exists())
          {
            $get=Product::where('upc',$val)->where('read',1)->first();

            $product=new Product();
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            $product->name=$get->name;
            $product->image=$get->image;
            $product->read=1;
            $product->save();
          }
          else{
            $product=new Product();
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            $product->save();

          }






        }

      }

    return response()->json(200);
  }
  public function add_inventory_product(Request $request)
  {


      foreach($request->upc as $key=>$val)
      {
            $product=Product::firstOrNew(array('id' => $request->id[$key]));
            $product->upc=$val;
            $product->box_id=$request->box_id;
            $product->qty=$request->qty[$key];
            if(Product::where('upc',$val)->where('read',1)->exists())
            {
              $get=Product::where('upc',$val)->where('read',1)->first();
              $product->name=$get->name;
              $product->image=$get->image;
              $product->read=1;
            }
            $product->save();



      }
      return response()->json(200);


  }
  public function show_box()
  {
    if (isset($_GET['id'])) {
      $id=$_GET['id'];

    }
    $product=Product::whereId($id)->get();
    $Wharehouse=Wharehouse::all();
    $Box=Box::all();
    $count=Box::count();
    $count++;
    return view('dashboard/Boxes_inventory',compact('Wharehouse','Box','count','product'));
  }
  public function update_qty(Request $request)
  {
    $product=Product::find($request->id);
    if($product->qty==$request->Quantity)
    {
        $del=Product::find($request->id);
        $del->delete();
    }
    else{
        $qty=$product->qty-$request->Quantity;

        $del=Product::find($request->id);
        $del->qty=$qty;
        $del->update();

    }

    // dd($product);
    // update stock api on wocomerce start
    $updt_product=[
      'stock_quantity'=>$del->qty,
    ];
    $response = Http::withHeaders([
    'Content-Length' => 'application/json',
    ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$del->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);

    // update stock api on wocomerce end
    
    // update quantity on shopify start
      $variants[]=[
        'inventory_quantity' => $del->qty
      ];
      $productss=[
        'variants' => $variants
      ];
      $data7=[
        "product"=>$productss
      ];
      $response = Http::withHeaders([
      'X-Shopify-Access-Token' => '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',
      'Content-Type' => 'application/json'
      ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$del->shopfyid.json",$data7);

  // update quantity on shopify end 

    return back()->with('success', 'Quantity Successfully removed');



  }
  public function move_product(Request $request)
  {

    $product=Product::find($request->id);

    if($product !=null)
    {


      if($product->qty <= $request->Quantity)
      {
        if(Product::whereUpc($product->upc)->where('box_id',$request->box_id)->exists()) {

          $get_pro=Product::whereUpc($product->upc)->where('box_id',$request->box_id)->first();
          $id=$get_pro->id;
          $qty=$get_pro->qty + $request->Quantity;


          $this->QtyService->Qty($id,$qty);
          $det=Product::find($product->id);
          $det->delete();


        }
        else{
          $dely=Product::find($product->id);
          $dely->box_id=$request->box_id;
          $dely->update();
        }

      }
      else{

          $qty=$product->qty - $request->Quantity;
          $id=$product->id;
          $this->QtyService->Qty($id,$qty);

          $get_product=$product->toArray();
          unset($get_product['id']);
          unset($get_product['created_at']);
          unset($get_product['updated_at']);
          $get_product['box_id']=$request->box_id;
          $get_product['qty']=$request->Quantity;

        if(Product::whereUpc($product->upc)->where('box_id',$request->box_id)->exists()) {

          $new_id=Product::whereUpc($product->upc)->where('box_id',$request->box_id)->first();
          $ids=$new_id->id;
          $new_qty=$new_id->qty + $request->Quantity ;

          $this->QtyService->Qty($ids,$new_qty);
        }
        else{
          $create=Product::create($get_product);

        }
      }

    }
    else{



    }
    return back()->with('success', 'Product Successfully Moved');







  }
  public function remove_inventory_product(Request $request)
  {
    // dd($request->typee);
    // dd('dsfad');

    
    $token = env('shop_access_token');
    
      foreach($request->upc as $key=>$val)
      {
        

        if($request->typee == 'woocomerce')
        {
          $order = Order::where('order_id', $request->productid[$key])->where('quantity', '>', 0)->get();
          $productidd = [];
          foreach($order as $ordr)
          {
            array_push($productidd,$ordr->product_id);
          }

          if(Product::where('upc',$val)->where('box_id',$request->box_id)->whereIn('id',$productidd)->exists())
          {

            $product=Product::where('upc',$val)->where('box_id',$request->box_id)->first();

            $product_first=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->first();
            $order_remove = Order::where('product_id', $product_first->id)->where('order_id', $request->productid[$key])->decrement('quantity',$request->qty[$key]);

            $order_remove2 = Order::where('product_id', $product_first->id)->where('order_id', $request->productid[$key])->first();
            if($order_remove2->remove_qty == null)
            {
              $order_remove2->remove_qty = $request->qty[$key];
              $order_remove2->update();
            }else{
              $order_remove2->remove_qty += $request->qty[$key];
              $order_remove2->update();
            }
          
            if($product->r_qty < $request->qty[$key])
            {
              $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->update(['r_qty'=>0]);
              
              // $product=Product::find($product->id);
              // $product->delete();
            }
            else{
              $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->decrement('r_qty',$request->qty[$key]);

            }

          }


        }elseif($request->typee == 'B2B')
        {

            $product=Product::where('upc',$val)->where('box_id',$request->box_id)->first();

            if($product->qty <= $request->qty[$key])
            {
              $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->update(['qty'=>0]);
            }
            else{
              $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->decrement('qty',$request->qty[$key]);
            }

            $product_b3n=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->first();
            $product_b2n=Product::findOrFail($product_b3n->id);
            if($product_b2n->qty < $product_b2n->r_qty)
            {
              $product_b2n->r_qty = 0;
              $product_b2n->update();
            }

             // update stock api on wocomerce start
             $updt_product=[
              'stock_quantity'=>$product_b2n->qty,
            ];
            $response = Http::withHeaders([
            'Content-Length' => 'application/json',
            ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$product_b2n->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);

            // update stock api on wocomerce end
            
            // update quantity on shopify start
              $variants[]=[
                'inventory_quantity' => $product_b2n->qty
              ];
              $productss=[
                'variants' => $variants
              ];
              $data=[
                "product"=>$productss
              ];

              $response = Http::withHeaders([
              'X-Shopify-Access-Token' => $token,
              'Content-Type' => 'application/json'
              ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$product_b2n->shopfyid.json",$data);

            // update quantity on shopify end
            
        }

      }

      if($request->order_num != null)
      {
        $order_sum = Order::where('order_id', $request->order_num)->sum('quantity');
        if($order_sum <=0)
        {
          $order_first = Order::where('order_id', $request->order_num)->first();
  
          if($order_first->order_from == 'shopify')
          {
  
          }elseif($order_first->order_from == 'woocommerce')
          {
            $dattta = [
              "status" => "completed"
            ];
            $response = Http::withHeaders([
            'Content-Length' => 'application/json',
            ])->put("https://bulkbuys.online/wp-json/wc/v3/orders/$request->order_num?&consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38", $dattta);
            $orders=json_decode($response->body());
            $statusttt=$response->status();
            // dd(55, $orders, $statusttt);

          }
        }
        
  
      }
      
      // dd('123',$request->order_num, $order_sum);



    return response()->json(200);
  }

  public function get_order_detail(Request $request)
  {
    $orders = Order::where('order_id', $request->orderid)->get();
    // dd($orders);

    return view('layout.order_detail', compact('orders'));
  }

  public function update_product (Request $request,$id)
  {

    if($request->tags !=null)
    {
      $tag=implode(',',$request->tags);

    }
    else{
      $tag=null;
    }

    $get_product=Product::find($id);
    $all=Product::where('upc',$get_product->upc)->get();
    foreach($all as $all_row)
    {
      $product=Product::find($all_row->id);
      $product->name=$request->name;
      $product->description=$request->description;
      $product->qty=$request->qty;
      $product->r_qty=$request->r_qty;
      $product->price=$request->price;
      $product->cost=$request->cost;
      $product->vc=$request->vc;
      $product->sku=$request->sku;
      $product->memo=$request->memo;
      $product->tag=$tag;
      $product->save();
      //
      // update stock api on wocomerce start
      $images2[] =  [
        "src" => $product->image,
        "alt" => $product->image,
      ];
      $tags2[] = [
        $product->tag,
      ];
      $meta_data[] = [
        "id" => 181161,
        "key" => "_et_gtin",
        "value" => $product->upc,
      ];
        $updt_product=[
          "name"=>$product->name,
          "type"=>"simple",
          "regular_price"=> $product->cost,
          'price'=>$product->price,
          'sku'=>$product->sku,
          "manage_stock" => true,
          'stock_quantity'=>$product->qty,
          "description"=> $product->description,
          "short_description"=> $product->description,
          "images" => $images2,
          "tags" => $tags2,
          "meta_data" => $meta_data,
        ];
        $response4 = Http::withHeaders([
        'Content-Length' => 'application/json',
        ])->put("https://bulkbuys.online/wp-json/wc/v3/products/$product->wo_id?consumer_key=ck_36d00fe9619eabcdd51c316ad4eafb8819c31580&consumer_secret=cs_28a3c3ad0e42e0605a2886b0bc476756b3d90b38",$updt_product);
        $status4=$response4->status();
        $result4=json_decode($response4->body());

        // update stock api on wocomerce end
    // dd($status4, $result4);
        
        // update quantity on shopify start
          $variants[]=[
            'inventory_quantity' => $product->qty,
            "price"=> $product->price,
            "sku"=> $product->sku,
            "cost" => $product->cost,
            "barcode"=>$product->upc,
          ];

          $images[]= [
            "position"=> 1,
            "alt"=> $product->name,
            "width"=> 800,
            "height"=> 600,
            "src"=> $product->image,
        ];

          $tags = [
            $product->tag,
          ];
          $productss=[
            'variants' => $variants,
            "title"=>$product->name,
            "body_html"=>$product->description,
            "tags" => $tags,
            "images"=>$images
          ];
          $data4=[
            "product"=>$productss
          ];
        $token = env('shop_access_token');

          $response5 = Http::withHeaders([
          'X-Shopify-Access-Token' => $token,
          'Content-Type' => 'application/json'
          ])->put("https://bulk-masters.myshopify.com/admin/api/2022-10/products/$product->shopfyid.json",$data4);

          $status5=$response5->status();
          $result5=json_decode($response5->body());

        // update quantity on shopify end 
        // dd(12, $status4, $status5, $result5);

      // 

      DB::table('product_categories')->where('product_id',$product->id)->delete();
      foreach($request->cat as $row)
      {
        $cat=new ProductCategory();
        $cat->cat_id=$row;
        $cat->product_id=$product->id;
        $cat->save();

      }
      if($request->hasfile('file'))
      {
        $i=0;

          foreach($request->file('file') as $image)
          {
              $i++;
              $file=$image;


              $extension=$file->extension();
              $name=$i.time()."_.".$extension;
              $file->move(public_path().'/upload/images/',$name);


              $data[] = $name;
          }
      }
      if(isset($data)){
        foreach($data as $row)
        {
          $image=new ProductImage();
          $image->image_id=$row;
          $image->product_id=$product->id;
          $image->save();

        }
      }
    }


      return back()->with('success', 'Product Update Successfully');

  }
 
  public function add_new_product(Request $request)
  {
    dd($request);
  }
  public function new_add_product(Request $request)
  {
    if($request->tags !=null)
    {
      $tag=implode(',',$request->tags);

    }
    else{
      $tag=null;
    }
    $product=new Product();
    $product->name=$request->name;
    $product->bar_code=$request->bar_code;
    $product->box_id=$request->box_id;
    $product->description=$request->description;
    $product->upc=$request->upc;
    $product->qty=$request->qty;
    $product->r_qty=$request->r_qty;
    $product->price=$request->price;
    $product->cost=$request->cost;
    $product->vc=$request->vc;
    $product->sku=$request->sku;
    $product->memo=$request->memo;
    $product->tag=$tag;
    $product->save();



    DB::table('product_categories')->where('product_id',$product->id)->delete();
    foreach($request->cat as $row)
    {
      $cat=new ProductCategory();
      $cat->cat_id=$row;
      $cat->product_id=$product->id;
      $cat->save();

    }
    if($request->hasfile('file'))
    {
      $i=0;

        foreach($request->file('file') as $image)
        {
            $i++;
            $file=$image;


            $extension=$file->extension();
            $name=$i.time()."_.".$extension;
            $file->move('upload/images/',$name);


            $data[] = $name;
        }
    }
    if(isset($data)){
      foreach($data as $row)
      {
        $image=new ProductImage();
        $image->image_id=$row;
        $image->product_id=$product->id;
        $image->save();

      }

    }

    $url=url()->previous();
    if($request->print=='print')
    {
      $bar_code=$request->bar_code;
      return view('product_print' ,compact('bar_code','url'));

    }

    return back()->with('success', 'Product Update Successfully');

  }
  function export_product(Request $request)
  {

    if($request->type=='Export')
    {
      $count=$request->check;
      if($count !=null)
      {
        $product=Product::whereIn('id',$request->check)->get();

      }
      else{
        $product=Product::get();
      }

      return view('dashboard/export_product',compact('product'));

    }


  }




}
