<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderLogs extends Model
{
    use SoftDeletes;
    protected $table = 'orders_log';
    protected $fillable = ['order_id','client_id','date','status','user_id'];

    public function status_data(){
        $lang = \App::getLocale();
        return $this->belongsTo(System_Constants::class,'status','value')->where('type','order_status')->select('value',"name_$lang as name");
    }
}