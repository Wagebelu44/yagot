<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Banks extends Model
{
    use SoftDeletes;
    protected $table = 'banks';
    protected $fillable = ['name_ar','name_en','account_no','iban','tax_number','status','images'];
  
}