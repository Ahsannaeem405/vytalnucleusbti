<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProducttCategory;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function get_box()
    {
        return $this->belongsto(Box::class,'box_id','name');
    }
    public function categories()
    {
        return $this->hasMany(ProductCategory::class,'product_id','id');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id','id');
    }

    public function Productcatgry()
    {
        return $this->hasMany(ProducttCategory::class,'upc_id','upc');
    }

    

}
