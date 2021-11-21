<?php

namespace App\Http\Controllers\Admin;

use App\Models\System_Constants as MyModel;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User_Permission;
use Lang;

class SystemConstantController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        // \App::setLocale(\Session::get('lang_id')); 
        // $this->middleware(['permission:system_constants|view_system_constants|add_system_constants|update_system_constants|delete_system_constants|status_system_constants']);
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('view_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $lang = Lang::getLocale();
        $data['all_constant'] = MyModel::where('type','system_constants')->where('value3','!=','category')->where('status',1)->get(["name_$lang as name",'value3']);
        $name  = $request->get('name');
        $type  = $request->get('type');
        $data['system_constants'] = MyModel::leftJoin('system_constants as s', function($join) {
                                        $join->on('s.value3', '=', 'system_constants.type')->whereNull('s.deleted_at');
                                    })->orderBy('status','desc')->orderBy('type');
        
        if($name != ''){
            $data['system_constants'] = $data['system_constants']->Where('system_constants.name_ar', 'like', '%' .  $name . '%');
        }
        if($type != ''){
            $data['system_constants'] = $data['system_constants']->Where('system_constants.type',$type);
        }

        $data['system_constants'] = $data['system_constants']->Where('system_constants.type','!=','country')->Where('system_constants.type','!=','action_source')
                                    ->Where('system_constants.type','!=','order_status')->where('system_constants.type','!=','category')->Where('system_constants.type','!=','delivery') 
                                    ->Where('system_constants.type','!=','subscriptions')->where('system_constants.type','!=','slider_type')->where('system_constants.type','!=','stones')->where('system_constants.type','!=','country_code')
                                    ->Where('system_constants.type','!=','lang')->Where('system_constants.type','!=','system_constants')->select(['system_constants.id',"system_constants.name_$lang as name",'system_constants.status',"s.name_$lang as type"])->paginate(15);

        if ($request->ajax()) {
            return view('admin.system_constants.table-data', compact('data'))->render();
        }
        return view('admin.system_constants.index',compact('data'));
    }
  /***********************************************************************************************************************/
    public function add(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('add_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $hidden = $request->get('hidden');
        if($hidden == 0){
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $type = $request->get('type');
            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'type' => 'required',
            ];
    
            $validator = \Validator::make([
                'name_ar' => $name_ar,
                'name_en' => $name_en,
                'type' => $type,
            ],
                $rules
            
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }
    
            $item = new MyModel();
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->type = $type;
            $item->user_id = \Auth::user()->id;
            $item->status = 1;
            $value = MyModel::where('type',$type)->max('value');
            $item->value = $value + 1;
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
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('update_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
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
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('status_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
            if($item != ''){
                if($item->status == 0){
                    $item->status = 1;
                }else{
                    $item->status = 0;
                }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
    }
/***********************************************************************************************************************/
    public function update(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('update_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }

        $hidden = $request->get('hidden');

        if($hidden != 0){
            $item = MyModel::find($hidden);
            if($item == ''){
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

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

                $item->name_ar = $name_ar;
                $item->name_en = $name_en;
                // $item->status = $status;
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }
    }
/****************************************************************************************************************************************** */
    public function delete(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('delete_system_constants');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){
            $deleted = $item->delete();
            if(!$deleted){
                return response()->json(['status' => false , 'data' =>  trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }

    }
/****************************************************************************************************************************************** */

}