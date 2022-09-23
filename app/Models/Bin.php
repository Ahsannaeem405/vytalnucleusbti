<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function get_ws()
    {
        return $this->belongsto(Wharehouse::class,'w_id','id');
    }
    public function get_level()
    {
        return $this->belongsto(Level::class,'level_id','id');
    }
}
