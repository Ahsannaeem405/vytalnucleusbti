<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;
    protected $table = 'model_has_roles';
    public function role_name()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }


}