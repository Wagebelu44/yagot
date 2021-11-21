<?php

namespace App\Models;

use Faker\Provider\ar_JO\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Orders extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $fillable = ['order_no','price','client_id','status','address_id','company_id',
                        'payment_type'];

    public static function getNextOrderNo(){
        $q = \DB::table('orders')->whereDate('orders.created_at',date('Y-m-d'))->selectRaw('count(id) as count')->first();
        $q = $q?$q->count:0;
        return sprintf('%02u',$q+1).date('dmy');
    }

    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }


    public function log(){
        return $this->hasMany(OrderLogs::class,'order_id','id')->select('id','order_id','status','date');
    }

    public function address(){
        $lang = \App::getLocale();
        return $this->belongsTo(Addresses::class,'address_id','id')->select('id','city_id',"area",'street','lat','lon');
    }

    public function company(){
        $lang = \App::getLocale();
        return $this->belongsTo(Company::class,'company_id','id')->select('id',"name_$lang");
    }
}

