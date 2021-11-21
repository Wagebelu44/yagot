<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class SubscriptionFeatures extends Model
{
    // use SoftDeletes;
    protected $table = 'subscription_features';
    protected $fillable = ['subscription_id','feature_id'];

    public function feature(){
        $lang = \App::getLocale();
        $lang = \App::getLocale();
        return $this->belongsTo(System_Constants::class,'feature_id','value')->where('type','subscriptions')->select('value',"name_$lang as name");
    }
}