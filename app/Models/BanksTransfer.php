<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BanksTransfer extends Model
{
    use SoftDeletes;
    protected $table = 'banks_transfer';
    protected $fillable = ['name','account_no_from','order_id','iban','total_price','status','action_source','client_id','image','mobile'];
  
}