<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Favorites extends Model
{
    use SoftDeletes;
    protected $table = 'favorites';
    protected $fillable = ['date','favorite_id','client_id','type'];

    public function advs(){
        return $this->belongsTo(Products::class,'favorite_id')->where('type',1);
    }

    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }

}