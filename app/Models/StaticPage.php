<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class StaticPage extends Model
{
    use SoftDeletes;
    protected $table = 'static_page';
    protected $fillable = ['photo','title_ar','details_ar','title_en','details_en','slug','user_id','delete_flag','status'];
}