<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class Products extends Model
{

    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = ['title','price','category_id','details','client_id','status','image','notes','currency_id'];
  
    public function images(){
        return $this->hasMany(ProductAttachments::class, 'product_id')->where('type',1)->select('id','product_id','attachment');
    }

    public function certified_images(){
        return $this->hasMany(ProductAttachments::class, 'product_id')->where('type',2)->select('id','product_id','attachment');
    }


    public function getImageAttribute($img){
        return asset('uploads/' . $img);
    }

    public function client(){
        return $this->belongsTo(Clients::class,'client_id');
    }

}