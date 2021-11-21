<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use SoftDeletes;
    protected $table = 'company';
    protected $fillable = ['name_ar','name_en','image'];

    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }
}