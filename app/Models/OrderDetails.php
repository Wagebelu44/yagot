<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderDetails extends Model
{
    use SoftDeletes;
    protected $table = 'order_details';
    protected $fillable = ['order_id','product_id','price','type'];
}