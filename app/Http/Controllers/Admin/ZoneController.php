<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Zones as MyModel;
use App\Models\System_Constants;

class ZoneController extends AdminController
{
   

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Request $request)
    {
        $lang = \App::getLocale();
        $id = $request->get('id');
        $zone = New MyModel();   
        $data['zone']=$zone->getzone();
        $data['parents'] = MyModel::where('parent_id',null)->get(['id',"name_$lang as name"]);
        $sys = new System_Constants();
        $data['countries'] =  $sys->constants('Country');
        if ($request->ajax()) {
            return view('admin.zone.table-data', compact('data'))->render();
        }
        return view('admin.zone.index', compact('data'));
    }

 /***********************************************************************************************************************/

    public function show(Request $request){

        $id  = $request->get('id');   
        $zone = new MyModel();
        $data['zone_sub'] =$zone->getzonesub($id);   
        $view = view('admin.zone.table-data-sub', compact('data'))->render();
        return response()->json(['status' => true , 'data' => $view]);
        
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
        $notes = $request->get('notes');
        $parent_id=$request->get('parent_id');
        $country_id=$request->get('country_id');

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
        $item->parent_id = $parent_id;
        $item->status = $status;
        $item->notes = $notes;
        $item->country_id = $country_id;
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
        $notes = $request->get('notes');
        $parent_id=$request->get('parent_id');
        $country_id=$request->get('country_id');
       

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
            $item->status = $status;
            $item->notes = $notes;
            $item->parent_id = $parent_id;
            $item->country_id = $country_id;
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
