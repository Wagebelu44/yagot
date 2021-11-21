<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banks as MyModel;
use Lang;
class BanksController extends AdminController
{
    //
    
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)

    {
        $lang = \App::getLocale();
        $data['banks'] = MyModel::orderBy('id','desc')->select('id',"name_$lang as name",'account_no','iban','tax_number','status','images');
        if($request->name){
            $data['banks'] = $data['banks']->where('name_ar', 'like', '%' .  $request->name . '%')->orWhere('name_en', 'like', '%' .  $request->name . '%');
        }
        $data['banks'] = $data['banks']->paginate(8);

        if ($request->ajax()) {
            return view('admin.banks.table-data', compact('data'))->render();
        }
        return view('admin.banks.index',compact('data'));
    }

  /***********************************************************************************************************************/
  public function add(Request $request){

    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('add_slider');
    // if(!$true){
    //     return 'عذرا ليس لديك صلاحية';
    // }
    $hidden = $request->get('hidden');
    if($hidden == 0){
        $user_id = \Auth::user()->id;
        if(isset($request['activeValue'] )){
            $status = 1;
        }else{
            $status = 0;
        }  
        $name_bank = $request->get('name_bank');
        $name_en = $request->get('name_en');
        $account_no = $request->get('account_no');
        $IBAN = $request->get('IBAN');
        $tax_number = $request->get('tax_number');

        $rules = [
            'name_bank' => 'required',
            'name_en' => 'required',
            'account_no' => 'required',
            'IBAN' => 'required',
            // 'tax_number' => 'required', 
        ];
        $validator = \Validator::make([
            'name_bank' => $name_bank,
            'name_en' => $name_en,
            'account_no' => $account_no,
            'IBAN' => $IBAN,
            // 'tax_number' => $tax_number, 
        ],
            $rules
        );

        if ($validator->fails()) {
            return response()->json(['status' => false , 'data' => trans("lang.required")]);
        }

        $item = new MyModel();
        $item->user_id = $user_id;
        $item->name_ar = $name_bank;
        $item->name_en = $name_en;
        $item->account_no = $account_no;
        $item->iban = $IBAN;
        $item->tax_number = $tax_number;
        $item->status = $status;
        $saved = $item->save();

    if (!$saved) {
        return response()->json(['status' => false , 'data' => trans("lang.error")]);
    }
        return response()->json(['status' => true , 'data' => trans("lang.success")]);
    }else{
        return response()->json(['status' => false , 'data' => trans("lang.error")]);
    }

}

/***********************************************************************************************************************/
public function edit(Request $request){

    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('edit_slider');
    // if(!$true){
    //     return 'عذرا ليس لديك صلاحية';
    // }

    $id = $request->get('id');

        $item = MyModel::find($id);
        if($item != ''){
            return response()->json(['status' => true , 'data' => $item]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }

}
/***********************************************************************************************************************/

public function UpdateStats(Request $request){
    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('status_slider');
    // if(!$true){
    //     return 'عذرا ليس لديك صلاحية';
    // }
    $id = $request->get('id');
    $item = MyModel::find($id);
        if($item != ''){
            if($item->status == 0){
                $item->status = 1;
            }else{
                $item->status = 0;
            }
            $saved = $item->save();
        if (!$saved) {
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
}

/***********************************************************************************************************************/

public function update(Request $request){

    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('edit_slider');
    // if(!$true){
    //     return 'عذرا ليس لديك صلاحية';
    // }

    $hidden = $request->get('hidden');
    if($hidden != 0){
        $user_id = \Auth::user()->id;
        if(isset($request['activeValue'] )){
            $status = 1;
        }else{
            $status = 0;
        }  

        $name_bank = $request->get('name_bank');
        $name_en = $request->get('name_en');
        $account_no = $request->get('account_no');
        $IBAN = $request->get('IBAN');
        $tax_number = $request->get('tax_number');
        
        $rules = [
            'name_bank' => 'required',
            'account_no' => 'required',
            'IBAN' => 'required',
            // 'tax_number' => 'required',
            'name_en' => 'required',              
        ];
        $validator = \Validator::make([
            'name_bank' => $name_bank,
            'account_no' => $account_no,
            'IBAN' => $IBAN,
            // 'tax_number' => $tax_number,  
            'name_en' => $name_en,
        ],
            $rules
        );
        if ($validator->fails()) {
            return response()->json(['status' => false , 'data' => trans("lang.required")]);
        }
      
        $item = MyModel::find($hidden); 
        $item->user_id = $user_id;
        $item->name_ar = $name_bank;
        $item->account_no = $account_no;
        $item->iban = $IBAN;
        $item->tax_number = $tax_number;
        $item->status = $status; 
        $item->name_en = $name_en;         
        $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
    }

/***********************************************************************************************************************/
public function delete(Request $request){
    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('delete_slider');
    // if(!$true){
    //     return 'عذرا ليس لديك صلاحية';
    // }
    $id = $request->get('id');
    $item = MyModel::find($id);
    if($item != ''){
        $deleted = $item->delete();
        if(!$deleted){
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
        return response()->json(['status' => true , 'data' => trans("lang.success")]);
    }else{
        return response()->json(['status' => false , 'data' => trans("lang.error")]);
    }
}

}
