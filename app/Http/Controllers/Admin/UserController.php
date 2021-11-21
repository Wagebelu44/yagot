<?php



namespace App\Http\Controllers\Admin;



use App\Models\User as MyModel;

use App\Models\System_Constants;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

use App\Models\User_Permission;

use Lang;

class UserController extends AdminController

{

    public function __construct()

    {

        parent::__construct();

        // \App::setLocale(\Session::get('lang_id')); 

        // $this->middleware(['permission:users|view_users|add_users|update_users|delete_users|change_password_user|change_status_users']);

    }

    //////////////////////////////////////////////

    public function index(Request $request)

    {

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('view_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }
        
        $name  = $request->get('name');

        $data['users'] = MyModel::orderBy('id','desc');

        

        if($name != ''){
            $data['users'] = $data['users']->where('email', $name)->orWhere('fullname', 'like', '%' .  $name . '%');
        }

        $data['language'] = System_Constants::select('id', 'value', 'name_ar', 'name_en')->where('status',1)->where('type', 'lang')->get();

        $data['users'] = $data['users']->paginate(8);

        if ($request->ajax()) {

            return view('admin.users.table-data', compact('data'))->render();

        }

        return view('admin.users.index',compact('data'));

    }

  /***********************************************************************************************************************/

    public function add(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('add_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $hidden = $request->get('hidden');

        if($hidden == 0){

            $fullname = $request->get('fullname');

            $username = $request->get('username');

            $email = $request->get('email');

            $password = $request->get('password');

            $lang_id = $request->get('lang_id');

            $mobile = $request->get('mobile');

            if(isset($request['activeValue'])){

                $status = 1;

            }else{

                $status = 0;

            }



            if($username != ''){

                if(preg_match('/[^A-Za-z0-9]/', $username)){

                    return response()->json(['status' => false , 'data' => trans('lang.username_english')]);

                }

            }

               

            $users_name_count = MyModel::where('name',$username)->count();

            $users_count = MyModel::where('email',$email)->count();

            

            if($users_name_count > 0){ 

                return response()->json(['status' => false , 'data' => trans('lang.username_exists')]);

            }

            if($users_count > 0){

                return response()->json(['status' => false , 'data' => trans('lang.email_exists')]);

            }

            $rules = [

                'username' => 'required',

                // 'email' => 'required',

                'lang_id' => 'required',

                'password' => 'required',

            ];

     

            $validator = \Validator::make([

                'username' => $username,

                // 'email' => $email,

                'password' => $password,

                'lang_id' => $lang_id,

            ],

                $rules

    

            );

    

            if ($validator->fails()) {

                return response()->json(['status' => false , 'data' => trans("lang.required")]);

            }

    

            $item = new MyModel();

            $item->name = $username;

            $item->fullname = $fullname;

            $item->email = $email;

            $item->mobile = $mobile;

            $item->lang_id = $lang_id;

            $item->password = \Hash::make($password);

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

    public function edit(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('update_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $id = $request->get('id');

            $item = MyModel::find($id);

            if($item != ''){

                return response()->json(['status' => true , 'data' => $item]);

            }else{

                return response()->json(['status' => false , 'data' =>  trans("lang.error")]);

            }

    }



    /***********************************************************************************************************************/



    public function UpdateStats(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('change_status_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $id = $request->get('id');

        $item = MyModel::find($id);

            if($item != ''){ 

                if($item->id == 1){

                    return response()->json(['status' => false , 'data' => trans("lang.status_admin")]);

                }

                if($item->status == 0){

                    $item->status = 1;

                }else{

                    $item->status = 0;

                }

                $saved = $item->save();

                if(!$saved){

                    return response()->json(['status' => false , 'data' =>  trans("lang.error")]);

                }

                return response()->json(['status' => true , 'data' =>  trans("lang.success")]);

            }else{

                return response()->json(['status' => false , 'data' =>  trans("lang.error")]);

            }

    }

/***********************************************************************************************************************/

    public function update(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('update_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $userhasper = \Auth::user();

        $userhasper->hasPermissionTo('update_users');

        $hidden = $request->get('hidden');



        if($hidden != 0){

            $item = MyModel::find($hidden);

            if($item == ''){

                return response()->json(['status' => false , 'data' =>  trans("lang.error")]);

            }

            $username = $request->get('username');

            $fullname = $request->get('fullname');

            $email = $request->get('email');

            $mobile = $request->get('mobile');

            $lang_id = $request->get('lang_id');

            $password = $request->get('password');

            if(isset($request['activeValue'])){

                $status = 1;

            }else{

                $status = 0;

            }

            

            if($username != ''){

                if(preg_match('/[^A-Za-z0-9]/', $username)){

                    return response()->json(['status' => false , 'data' => trans('lang.username_english')]);

                }

            }

               

            $users_name_count = MyModel::where('name',$username)->where('id','!=',$item->id)->count();

            $users_count = MyModel::where('email',$email)->where('id','!=',$item->id)->count();



            if($users_name_count > 0){

                return response()->json(['status' => false , 'data' => trans('lang.username_exists')]);

            }

            

            if($users_count > 0){

                return response()->json(['status' => false , 'data' => trans('lang.email_exists')]);

            }



            $rules = [

                'username' => 'required',

                'lang_id' => 'required',

                // 'email' => 'required',

            ];

    

            $validator = \Validator::make([

                'lang_id' => $lang_id,

                'username' => $username,

                // 'email' => $email,

            ],

                $rules

           

            );

    

            if ($validator->fails()) {

                return response()->json(['status' => false , 'data' => trans('lang.required')]);

            }



                $item->name = $username;

                $item->fullname = $fullname;

                $item->email = $email;

                $item->mobile = $mobile;

                if($hidden != 1){
                    $item->status = $status;
                }
                $item->lang_id = $lang_id;

                if($password != ''){

                    $item->password = \Hash::make($password);

                }

                $saved = $item->save();

                if(!$saved){

                    return response()->json(['status' => false , 'data' => trans('lang.error')]);

                }

                return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }

    }

/****************************************************************************************************************************************** */

    public function delete(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('delete_users');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $id = $request->get('id');

        $item = MyModel::find($id);

        if($item != ''){

            if($item->id == 1){

                return response()->json(['status' => false , 'data' => trans('lang.admin_delete')]);

            }

            $deleted = $item->delete();

            if(!$deleted){

                return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

        }



    }

/****************************************************************************************************************************************** */

  public function changepassword(Request $request){

    $userhasper = \Auth::user();

    $true = $userhasper->hasPermissionTo('change_password_user');

    if(!$true){

        return 'عذرا ليس لديك صلاحية';

    }

     $hidden = $request->get('hidden');

     $password = $request->get('password');

     $confirmation_password = $request->get('confirmation_password');

     

     if($password == '' or $confirmation_password == ''){

        return response()->json(['status' => false , 'data' => trans('lang.required')]);

     }



     $item = MyModel::find($hidden);

     if($item != ''){

        if($password === $confirmation_password){

            $item->password = \Hash::make($password);

            $saved = $item->save();

            if(!$saved){

                return response()->json(['status' => false , 'data' => trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.password_changed')]);

        }else{

            return response()->json(['status' => false , 'data' => trans('lang.password_not_match')]);

        }

    }else{

        return response()->json(['status' => false , 'data' => trans('lang.error')]);

    }



  }

/**************************************************************************************/



public function permission(Request $request){

    $userhasper = \Auth::user();

    $true = $userhasper->hasPermissionTo('permission_users');

    if(!$true){

        return 'عذرا ليس لديك صلاحية';

    }

    $hidden = $request->get('hidden');

    $permissions = $request->get('permissions');

    $item = MyModel::find($hidden);

        if($item != ''){

            // if($item->id == 1){

            //     return response()->json(['status' => false , 'data' => trans('lang.permission_admin')]);

            // }

           $user_permissions = User_Permission::where('model_id','=',$item->id)->get();

           foreach($user_permissions as $per){

            $item->revokePermissionTo($per->guard_name);

           }



           foreach($permissions as $permission){

                $perm = Permission::find($permission);

                $item->givePermissionTo($perm);

           }

           return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

        }

    

}



public function getpermission(){

    $lang = Lang::getLocale();

   return $data['permissions'] = Permission::orderBy('group_id')->get(['id',"name_$lang as name",'name as name_en','group_id','group']);

}



public function userpermission(Request $request){

    $userhasper = \Auth::user();

    $true = $userhasper->hasPermissionTo('permission_users');

    if(!$true){

        return 'عذرا ليس لديك صلاحية';

    }

    $id = $request->get('id');

    $user_permissions = User_Permission::where('model_id','=',$id)->get();

    $permissions = self::getpermission();

    $permissions = $permissions->groupBY('group_id');

    $user_per ='';

    $per_group = 0;

    $checked ='';

    $i = 0;

    $z = 0;

    $margin_top = 0;





    $user_per = '<div class="m-portlet" style="box-shadow: none;width: 100%;"><div class="m-portlet__body" style="padding: 0;">';

    foreach($permissions as $permission){

        $i = 0;

        $z = 0;

        $i++;

        $user_per .= '<div class="panel panel-default">';

        foreach($permission as $per){

            $z++;

            $checked ='';

            foreach($user_permissions as $user_permission){

                if($user_permission->permission_id == $per->id){

                    $checked ='checked';

                }

            } 

            

            if($per->group == 1){

                

                    $user_per .= '<div class="m-portlet__head" style="height: 2.7rem;">

                                    <h3 class="m-portlet__head-title">

                                            <div class="md-checkbox">

                                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand" for="p'.$per->name_en.'">

                                                    <input id="p'.$per->name_en.'" '.$checked.' data-id="p'.$per->id.'" class="group_per p'.$per->id.'" type="checkbox">'.$per->name.'<span></span>

                                            </label>

                                            </div>

                                        </h3>

                                    </div>';

                $per_group = $per->id;

            }



            if($z == 1){

                $user_per .= '<div class="m-portlet__body" id="mtab_storesm">

                              <div class="md-checkbox-inline col-lg-12 col-xs-12 col-sm-12 row">';

            }

            

                    $user_per .= '<div class="row md-checkbox col-lg-4 col-xs-4 col-sm-4">

                            <label class="m-checkbox m-checkbox--solid m-checkbox--brand" for="'.$per->name_en.'">

                                <input type="checkbox" id="'.$per->name_en.'"  value="'.$per->id.'" '.$checked.'  name="permissions[]"  class=" p'.$per_group.'">

                                '.$per->name.'

                                <span class="col_name1"></span>

                            </label>

                    </div>';



            if($z == count($permission)){

                  $user_per .= '</div></div>';

            }

        }





         $user_per .= '</div>';

    }

    $user_per .= '</div></div>';

    return response()->json(['status' => true , 'data' => $user_per]);

    

}



}