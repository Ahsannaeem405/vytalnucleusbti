<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    public function child_categories()
       {
           return $this->hasMany(Category::class,'category_id','cat_id');
       }
}
