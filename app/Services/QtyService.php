<?php
namespace App\Services;
use App\Models\Product;


class QtyService {
    public function Qty($id,$amount)
    {
      $update=Product::find($id);
      $update->qty=$amount;
      $update->save();
    

    }


}
