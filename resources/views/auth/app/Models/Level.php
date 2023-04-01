<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    public function get_ws()
    {
        return $this->belongsto(Wharehouse::class,'w_id','id');
    }
}
