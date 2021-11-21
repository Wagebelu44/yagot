<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Setting extends Model
{
    use SoftDeletes;
    protected $table = 'settings';
    protected $fillable = ['title','email','mobile','logo','user_id','description','','videos_no','ios','andriod','duration_notify','delete_notify'];
    public function getsetting($id){
        return $this->find($id);
    }

}