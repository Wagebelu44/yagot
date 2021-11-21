<?php



namespace App\Http\Controllers\Admin;



use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Permission;

use App\Models\User_Permission;

use App\Models\System_Constants;

use App\Models\Clients;
use App\Models\Products;
use App\Models\Messages;
  

class DashboardController extends AdminController

{

    public function __construct()

    {

        parent::__construct();

    }

    //////////////////////////////////////////////////////////////////////////////////////////////

    public function index(Request $request)

    {
        $data['messages'] = Messages::count('*');
        $data['client'] = Clients::count('*');
        $data['products'] = Products::count('*');
        return view('admin.dashboard.index',compact('data'));

    }

    //////////////////////////////////////////////////////////////////////////////////////////////

    public function getProfile(){
        $lang  = \App::getLocale();
        $data['language'] = System_Constants::select('id', 'value', "name_$lang as name")->where('status',1)->where('type', 'lang')->get();

        return view('admin.dashboard.profile',compact('data'));

    }

    //////////////////////////////////////////////////////////////////////////////////////////////

    public function postPassword(Request $request){

        $password = $request->get('password');

        $lang = $request->get('lang_id');

        if($lang == ''){

            return response()->json(['status' => false , 'data' =>  trans("lang.required")]);

        }

        $item = User::find(\Auth::user()->id);

        if($item != ''){

            if($password){

                $item->password = \Hash::make($password);

            }

            $item->lang_id = $lang;

            if($lang == 1){

                \App::setLocale('ar');

                $lang = 'ar';

            }else{

                \App::setLocale('en');

                $lang = 'en';

            }

            $request->session()->put('lang_id', $lang);

            $saved = $item->save();

            if(!$saved){

                     return response()->json(['status' => false , 'data' => trans("lang.error")]);

            }

             return response()->json(['status' => true , 'data' => trans("lang.success")]);

        }else{

           return response()->json(['status' => false , 'data' => trans("lang.error")]);

        }

    }

     //////////////////////////////////////////////////////////////////////////////////////////////



}