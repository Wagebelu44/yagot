<?php

namespace App\Models;

use Facade\FlareClient\Http\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Addresses extends Model
{
    use SoftDeletes;
    protected $table = 'addresses';
    protected $fillable = ['city_id','area','street','lat','lon','home_no','client_id'];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function city()
    {
        $lang = \App::getLocale();
        return $this->belongsTo(Zones::class, 'city_id', 'id')->select('id',"name_$lang as name");
    }
    
}