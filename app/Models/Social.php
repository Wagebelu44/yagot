<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Social extends Model

{
    protected $table = 'social';
    protected $fillable = ['class_icon','icon','user_id','status','url','title','color'];

    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }
}