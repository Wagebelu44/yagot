<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MobileNotification extends Model
{
    use SoftDeletes;
    protected $table = 'mobile_notification';
    protected $fillable = ['title','adv_id','client_id'];
}