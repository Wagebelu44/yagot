<?php



namespace App\Http\Controllers\Admin;



use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;



class LoginController extends AdminController

{

    use AuthenticatesUsers;

    public function __construct()

    {

        parent::__construct();
    }

    ///////////////////////////////////////////

    public function getIndex()

    {

        return view('admin.login.index');
    }

    ///////////////////////////////////////////

    public function postIndex(Request $request)

    {

        $field = 'name';

        $username = $request->get('username');

        $password = $request->get('password');

        $remember_token = $request->get('remember_token');


        $user = User::where('name', $username)->first();

        if ($user != '') {

            if ($user->status != 1) {

                return redirect('/admin/login')->with(['danger' => 'عذرا ، الحساب معطل الرجاء مراجعة الإدارة']);
            }
        } else {

            return redirect('/admin/login')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }

        $admin[$field] = $username;
        $admin['password'] = $password;

        // $admin['status'] = 1;



        if (Auth::attempt($admin, $remember_token)) {

            if ($user->lang_id == 1) {
                \App::setLocale('ar');
                $lang = 'ar';
            } else {
                \App::setLocale('en');
                $lang = 'en';
            }

            $request->session()->put('lang_id', $lang);
            return redirect('/admin/dashboard');
        } else {

            return redirect('/admin/login')->with(['danger' => 'عذرا ، خطأ في البيانات المدخلة']);
        }
    }

    ///////////////////////////////////////////

    public function getLogout()

    {

        // \Session::forget('lang_id');

        Auth::guard('admin')->logout();

        return redirect('/');
    }
}
