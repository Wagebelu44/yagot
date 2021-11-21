<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HomeOrder extends Model
{
    protected $table = 'home_order';
    protected $fillable = ['order_no','type','reference_id','title'];
}