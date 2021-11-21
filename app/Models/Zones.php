<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model

{
    protected $table = 'zones';
    protected $fillable = ['name','status','user_id','parent_id'];

    public function ports(){
        return $this->hasMany(Ports::class,'zone_id');
    }


    public function getzone(){
        $lang = \App::getLocale();
        return $this->with('parent')->select('id',"name_$lang as name",'status','parent_id')->orderBy('id','desc')->paginate(25);
    }
    
    public function getzonesub($id){
        return $this->where('parent_id',$id)->paginate(15);
    }
   

    public function addzone($name_ar,$status,$parent_id){
        $this->name_ar = $name_ar;
        $this->parent_id = $parent_id;
        $this->status = $status;
        $this->user_id = \Auth::user()->id;
        $this->save();
        return $this;
    }

    public function parent(){
        return $this->belongsTo(Zones::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(Zones::class,'parent_id');
    }
}