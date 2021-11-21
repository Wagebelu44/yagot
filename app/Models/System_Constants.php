<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System_Constants extends Model
{
    use SoftDeletes;
    protected $table = 'system_constants';
    protected $fillable = ['name_ar','user_id','name_en','value','value2','value3','type','order','photo','status','user_id'];

    public function user_type(){
        $lang = \App::getLocale();
        return $this->where('type','user_type')->where('status',1)->get(['value as id',"name_$lang as name",'photo']);
    }

    public function constants($constact){
        $lang = \App::getLocale();
        return $this->where('type',$constact)->where('status',1)->get(['value as id',"name_$lang as name"]);
    }
    
       public static function byType($type)
    {
        return static::where('type', $type)->select("*")->get();
    }

    public function getParentNameAttribute(){
        return System_Constants::where('type','system_constants')->where('value2',$this->type)->get()->first()['name'];
    }


    public function getSystem($name,$type){
        $lang = \App::getLocale();
        $system = $this->OrderBy('system_constants.id','desc');
        if($name != ''){
            $system = $system->Where("system_constants.name_$lang", 'like', '%' .  $name . '%');
        }
        if($type != ''){
            $system = $system->Where('system_constants.type',$type);
        }
        $system = $system->leftJoin('system_constants as sys', function($join) {
                        $join->on('system_constants.type', '=', 'sys.value2')->where('sys.type','system_constants')->whereNull('sys.deleted_at');
                    });
        return $system = $system->where('system_constants.type','!=','system_constants')->select(['system_constants.id',"system_constants.name_$lang as name",'system_constants.status','system_constants.type',"sys.name_$lang as type_name"])->paginate(8);
    }

    public function addconstant($name,$type,$status){
        $this->name_ar = $name;
        $this->type = $type;
        $this->status = $status;
        $value = $this->where('type',$type)->max('value');
        $this->value = $value + 1;
        $this->user_id = \Auth::user()->id;
        $this->save();
        return $this;
    }

    public function getconstant($id){
        return $this->find($id);
    }

    public function updateconstant($obj,$name,$type){
        $obj->name_ar = $name;
        return $obj->save();
    }

    public function UpdateStatus($obj){
        if($obj->status == 0){
            $obj->status = 1;
        }else{
            $obj->status = 0;
        }
        return  $obj->save();
    }

    public function deleteConstant($obj){
        return $obj->delete();
    }

    public function getFlagAttribute($img){
        return asset('flags/' . strtolower($img).'.png');
    }

    public function getPhotoAttribute($img){
        return asset('uploads/'.$img);
    }

    public function getImagesAttribute($img){
        return asset('uploads/'.$img);
    }

    public function images_stones(){
        return $this->hasMany(StonesImages::class,'stone_id','value')->select('image','stone_id','id');
    }

}
