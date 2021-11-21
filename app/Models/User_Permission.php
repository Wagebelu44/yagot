<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Permission extends Model
{
    public $timestamps = false;
    protected $table = 'model_has_permissions';
    protected $fillable = ['permission_id','model_type','model_id'];
}
