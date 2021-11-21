<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class StonesImages extends Model
{
    protected $table = 'stones_images';
    protected $fillable = ['stone_id','image'];

    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }
    

}