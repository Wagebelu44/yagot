<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttachments extends Model
{
    use SoftDeletes;
    protected $table = 'products_attachment';
    protected $fillable = ['product_id','attachment','client_id','type'];

    public function getAttachmentAttribute($img){
        return asset('uploads/' . $img);
    }

}