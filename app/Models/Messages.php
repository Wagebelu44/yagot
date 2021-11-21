<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Messages extends Model
{
    use SoftDeletes;
    protected $table = 'messages';
    protected $fillable = ['name','email','details','country_code'];
}