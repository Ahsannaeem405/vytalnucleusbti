<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Wharehouse,Level,Bin,Row,Box,User,ProductCategory,ProductImage,Category};
use App\Services\QtyService;

use App\Models\Product;
use DB;
use Http;


class AddProduct extends Controller
{
  private QtyService $QtyService;
  public function __construct(QtyService $QtyService)
    {

        $this->QtyService = $QtyService;
    }
  function product()
  {
    $product=Product::get();
    return view('dashboard/product',compact('product'));
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
      return view('dashboard/create_product' ,compact('Box','cat'));
  }
  public function create_inventory_product($id)
  {


      $Box=Box::find($id);
      $All_Box=Box::get();
      $product=Product::where('box_id',$Box->name)->orderBy('id', 'DESC')->get();
       $cat=Category::whereNull('category_id')->get();
      return view('dashboard/create_inventory_product' ,compact('Box','product','All_Box','cat'));
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

    return back()->with('success', 'Product Successfully Deleted');



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

      foreach($request->upc as $key=>$val)
      {

        if(Product::where('upc',$val)->where('box_id',$request->box_id)->exists())
        {
          $product=Product::where('upc',$val)->where('box_id',$request->box_id)->first();

          if($product->qty <= $request->qty[$key])
          {
            $product=Product::find($product->id);
            $product->delete();


            //if(Product::where('upc',$val->upc)->where('read',1)->exists())
          }
          else{
            $product=DB::table('products')->where('upc',$val)->where('box_id',$request->box_id)->decrement('qty',$request->qty[$key]);

          }

        }

      }

    return response()->json(200);
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
    }


      return back()->with('success', 'Product Update Successfully');

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
