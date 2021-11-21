<?php



namespace App\Http\Controllers\Admin;



use App\Models\Setting as MyModel;

use Illuminate\Http\Request;





class SettingController extends AdminController

{

    public function __construct()

    {

        parent::__construct();

        // \App::setLocale(\Session::get('lang_id')); 

        // $this->middleware(['permission:setting|edit_setting']);



    }

    //////////////////////////////////////////////

    public function index(Request $request)

    {

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('setting');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $data['setting'] = MyModel::first();

        return view('admin.setting.index',compact('data'));

    }

/***********************************************************************************************************************/

    public function update(Request $request){

            $userhasper = \Auth::user();

            $true = $userhasper->hasPermissionTo('update_setting');

            if(!$true){

                return 'عذرا ليس لديك صلاحية';

            }

            $site_name_ar = $request->get('site_name_ar');

            $site_name_en = $request->get('site_name_en');


            $mobile = $request->get('mobile');

            $email = $request->get('email');


            $ios = $request->get('ios');
            $andriod = $request->get('andriod');

            $site_commission = $request->get('site_commission');


            $rules = [

                'site_name_ar' => 'required',

                'site_name_en' => 'required',

                'email' => 'required',

                'site_commission' => 'required',


            ];

    

            $validator = \Validator::make([

                'site_name_ar' => $site_name_ar,

                'site_name_en' => $site_name_en,

                'email' => $email,

                'site_commission' => $site_commission,



            ],



                $rules

             

            );

    

            if ($validator->fails()) {

                return response()->json(['status' => false , 'message' => trans("lang.required")]);

            }


            $item = MyModel::where('id',1)->first();

            if($item == ''){

                $item = new MyModel();

            }

            $item->title_ar = $site_name_ar;

            $item->title_en = $site_name_en;

            $item->email = $email;

            $item->ios = $ios;
            $item->site_commission = $site_commission;
            
            $item->andriod = $andriod;

            $saved = $item->save();

            if(!$saved){

                return response()->json(['status' => false , 'message' => trans("lang.error")]);

            }

            return response()->json(['status' => true , 'message' => trans("lang.success")]);



        }


}