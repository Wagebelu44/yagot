<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Clients extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clients';
    protected $fillable = [
        'mobile', 'name', 'country_code','email','image','status','user_id','zone_id','password','city_id','os','type','token_reset_password','date_token_reset_password'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function favorites(){
        return $this->hasMany(Favorites::class, 'client_id');
    }

    public function checkMobile($type,$mobile,$id=''){
        if($type == 1){
            return $this->where('mobile',$mobile)->count();
        }else{
            return $this->where('mobile',$mobile)->where('id','!=',$id)->count();
        }
    }

    public function getImageAttribute($img){
        if($img){
            return asset('uploads/' . $img);
        }else{
            return asset('site/assets/images/user.png');
        }
    }



    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function product(){
        return $this->hasMany(Product::class,'client_id');
    }


    public function getPhoneAttribute()
    {
        return $this->country_code . $this->mobile;
    }


    public function zone()
    {
        $lang = \App::getLocale();
        return $this->belongsTo(Zones::class, 'zone_id')->select("name_$lang as name",'id');
    }

    public function city()
    {
        return $this->belongsTo(Zones::class, 'city_id');
    }


    public function getFlagAttribute($img){
        return asset('flags/' . strtolower($img).'.png');
    }

    public function getPassportAttribute($img){
        if($img){
            return asset('uploads/' . $img);
        }else{
            return null;
        }
    }

    public function getIdentityAttribute($img){
        if($img){
            return asset('uploads/' . $img);
        }else{
            return null;
        }
    }

    public function getCommercialPhotoAttribute($img){
        if($img){
            return asset('uploads/' . $img);
        }else{
            return null;
        }
    }
    
}
