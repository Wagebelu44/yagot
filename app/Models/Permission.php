<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    
    protected $table = 'permissions';
    protected $fillable = ['name','guard_name','group_id','name_ar'];
}
