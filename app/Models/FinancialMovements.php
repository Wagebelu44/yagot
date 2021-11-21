<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FinancialMovements extends Model
{
    use SoftDeletes;
    protected $table = 'movements';
    protected $fillable = ['movement_type','payment_type','depit','credit','total_price','exchange_type','type_spending','action_source','move_no','account_id','statement','currency'];

    public function getMoveNo(){
        $year = date('Y');
        $year_len = strlen($year);
        $year_l = (int)$year_len + 1;
        $max_value = \DB::SELECT('SELECT MAX(SUBSTRING(move_no,'.$year_l.')) AS max_value FROM movements Where SUBSTRING(move_no,1,'.$year_len.') = '.$year.' LIMIT 1');
        foreach($max_value as $arr){
            if($arr->max_value == ''){
                $move_no = str_pad(1,5,0,STR_PAD_LEFT);
            }else{
                $move_no = str_pad($arr->max_value + 1,5,0,STR_PAD_LEFT);
            }
        }
        return $move_no = $year."".$move_no;
    }

}