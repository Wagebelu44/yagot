<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\System_Constants as MyModel;

class CountryController extends AdminController
{
   

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Request $request)
    {
        $lang = \App::getLocale();
        $data['country'] = MyModel::where('type','Country')->orderBy('id','desc')->select(['id',"name_$lang as name",'status'])->paginate(20);
        if ($request->ajax()) {
            return view('admin.country.table-data', compact('data'))->render();
        }
        return view('admin.country.index', compact('data'));
    }

 /***********************************************************************************************************************/

 public function UpdateStats(Request $request){

    // $userhasper = \Auth::user();
    // $true = $userhasper->hasPermissionTo('status_zone');
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
public function add(Request $request){
    $hidden = $request->get('hidden');
    if($hidden == 0){
        
        if(isset($request['activeValue'] )){
            $status = 1;
        }else{
            $status = 0;
        }
        $name_ar = $request->get('name_ar');
        $name_en = $request->get('name_en');
        $country_code = $request->get('country_code');

        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',
        ];
        $validator = \Validator::make([
            'name_ar' => $name_ar,
            'name_en' => $name_en,
        ],
            $rules
        );

        if ($validator->fails()) {
            return response()->json(['status' => false , 'data' => trans("lang.required")]);
        }

        $item = new MyModel();
        $item->name_ar = $name_ar;
        $item->name_en = $name_en;
        $value = MyModel::where('type','Country')->max('value');
        $item->value = $value + 1;
        $item->type = 'Country';
        $item->value2 = $country_code;
        $item->status = $status;
        $item->user_id = \Auth::user()->id;
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
    
    $hidden = $request->get('hidden');
    if($hidden != 0){
        
        if(isset($request['activeValue'] )){
            $status = 1;
        }else{
            $status = 0;
        }
        $name_ar = $request->get('name_ar');
        $name_en = $request->get('name_en');
        $country_code=$request->get('country_code');
       

        $rules = [
            'name_ar' => 'required',
            'name_en' => 'required',

        ];
        $validator = \Validator::make([
            'name_ar' => $name_ar,
            'name_en' => $name_en,  
        ],
            $rules
        );

        if ($validator->fails()) {
            return response()->json(['status' => false , 'data' => trans("lang.required")]);
        }

        $item = MyModel::find($hidden); 

        if($item != ''){
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->value2 = $country_code;
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }

    }
}

/***********************************************************************************************************************/

public function edit(Request $request){
    $id = $request->get('id');
    $item = MyModel::find($id);
    if($item != ''){
        return response()->json(['status' => true , 'data' => $item]);
    }else{
        return response()->json(['status' => false , 'data' =>  trans("lang.error")]);
    }
}



/***********************************************************************************************************************/
public function delete(Request $request){
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
