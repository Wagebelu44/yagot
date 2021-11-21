<?php

namespace App\Http\Controllers\Admin;

use App\Models\StaticPage as MyModel;
use App\Models\Partners;
use App\Models\System_Constants;
use Illuminate\Http\Request;
use Lang;

class StaticPageController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        // \App::setLocale(\Session::get('lang_id')); 
        // $this->middleware(['permission:static_page|view_page|edit_page|delete_page|add_page|status_page']);
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('view_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $lang = Lang::getLocale();
        $data['system'] = System_Constants::where('status',1)->where('type','lang')->select("value2","name_$lang as name")->get();
        $data['static'] = MyModel::orderBy('id','desc')->select('id','slug','photo','status',"title_$lang as title","details_$lang as details")->paginate(8);
        if ($request->ajax()) {
            return view('admin.static_page.table-data', compact('data'))->render();
        }
        return view('admin.static_page.index',compact('data'));
    }
  /***********************************************************************************************************************/
    public function add(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('add_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $hidden = $request->get('hidden');
        if($hidden == 0){
            $user_id = \Auth::user()->id;
            $title_ar = $request->get('title_ar');
            $details_ar = $request->get('details_ar');
            $title_en = $request->get('title_en');
            $details_en = $request->get('details_en');
            $slug = $request->get('slug');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }
            // $file = $request->file('image');

            $rules = [
                'title_ar' => 'required',
                'details_ar' => 'required',
                'title_en' => 'required',
                'details_en' => 'required',
                'slug' => 'required',
            ];
    
            $validator = \Validator::make([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
                'details_ar' => $details_ar,
                'details_en' => $details_en,
                'slug' => $slug,
            ],
                $rules
              
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }
    
            if($slug != ''){
                if(preg_match('/[^A-Za-z0-9_-]/', $slug)){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_error")]);
                }
            }
            
            $count = MyModel::where('slug',$slug)->count();
           
            if($count > 0){
                return response()->json(['status' => false , 'data' => trans("lang.slug_used")]);
            }
            
          

            $pic = '';
            // if ($request->hasFile('image') && $file->isValid())
            // {
            //     $ext = $file->getClientOriginalExtension();
            //     if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg' and $ext != 'mp4'){
            //         return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
            //     }
            //     $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('uploads'), $pic);
            // }
    
            $item = new MyModel();
            $item->user_id = $user_id;
            $item->title_ar = $title_ar;
            $item->details_ar = $details_ar;
            $item->title_en = $title_en;
            $item->details_en = $details_en;
            $item->slug = $slug;
            // $item->delete_flag = 1;
            $item->status = $status;
            // $item->photo = $pic;
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
        $true = $userhasper->hasPermissionTo('edit_page');
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
        $true = $userhasper->hasPermissionTo('status_page');
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
        $true = $userhasper->hasPermissionTo('edit_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $hidden = $request->get('hidden');

        if($hidden != 0){
            $user_id = \Auth::user()->id;
            $title_ar = $request->get('title_ar');
            $details_ar = $request->get('details_ar');
            $title_en = $request->get('title_en');
            $details_en = $request->get('details_en');
            $slug = $request->get('slug');
            // $file = $request->file('image');
            if(isset($request['activeValue'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'title_ar' => 'required',
                'details_ar' => 'required',
                'title_en' => 'required',
                'details_en' => 'required',
                'slug' => 'required',
            ];
    
            $validator = \Validator::make([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
                'details_ar' => $details_ar,
                'details_en' => $details_en,
                'slug' => $slug,
            ],
                $rules
              
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            if($slug != ''){
                if(preg_match('/[^A-Za-z0-9_-]/', $slug)){
                    return response()->json(['status' => false , 'data' => trans("lang.slug_error")]);
                }
            }

            $pic = '';
            // if ($request->hasFile('image') && $file->isValid())
            // {
            //     $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
            //     $file->move(public_path('uploads'), $pic);
            // }

            $count = MyModel::where('slug',$slug)->where('id','!=',$hidden)->count();
                        
            if($count > 0){
                return response()->json(['status' => false , 'data' => trans("lang.used")]);
            }
            $item = MyModel::find($hidden); 
            if($item != ''){
                $item->user_id = $user_id;
                $item->title_ar = $title_ar;
                $item->details_ar = $details_ar;
                $item->details_en = $details_en;
                $item->title_en = $title_en;
                $item->status = $status;
                // $item->delete_flag = 1;
                // if($pic != ''){
                //     $item->photo = $pic;
                // }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

        }
    }

    public function delete(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('delete_page');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){
            if($item->delete_flag == 1){
                return response()->json(['status' => false , 'data' => trans("lang.can_delete")]);
            }
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