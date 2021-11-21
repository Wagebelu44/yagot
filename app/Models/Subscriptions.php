<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subscriptions extends Model
{
    use SoftDeletes;
    protected $table = 'subscriptions';
    protected $fillable = ['name','price','currency_id','number_slider','number_days','number_products'];

    public function features(){
        return $this->hasMany(SubscriptionFeatures::class,'subscription_id','id')->select('subscription_id','feature_id','id');
    }
}