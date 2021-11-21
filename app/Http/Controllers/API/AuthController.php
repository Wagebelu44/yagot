<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Clients;
use Facade\FlareClient\Http\Client;
use App\Models\FinancialAccounts;
use App\Http\Helpers\Helpers;
use App\Models\MobileLog;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Value\PhoneNumber;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class AuthController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {

        $name = $request->get('name');
        $email = $request->get('email');
        $country_id = $request->get('country_id');
        $zone_id = $request->get('zone_id');
        $city_id = $request->get('city_id');
        $mobile = $request->get('mobile');
        $password = $request->get('password');
        $cpassword = $request->get('cpassword');
        $terms = $request->get('terms');
        $fcm_token = $request->get('fcm_token');
        $country_code = $request->get('country_code');
        $platform = $request->header('platform');
        $lang = $request->header('lang');
        // $response = self::user($request->get('uid'));
        // if(!$response){
        //     return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>'']);
        // }

        // $password = $request->get('password');

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'country_id' => 'required',
            'zone_id' => 'required',
            'mobile' => 'required|unique:clients',
            'password' => 'required',
            'cpassword' => 'required',
            'country_code' => 'required',
        ];

        $messages = [
            'name.required' => trans('lang.name_required'),
            'country_id.required' => trans('lang.country_required'),
            'zone_id.required' => trans('lang.zone_required'),
            'email.required' => trans('lang.email_required'),
            'email.unique' => trans('lang.email_used'),
            'email.email' => trans('lang.email_format'),
            'mobile.required' => trans('lang.mobile_required'),
            'mobile.unique' => trans('lang.mobile_used'),
            'password.required' => trans('lang.password_required'),
            'cpassword.required' => trans('lang.cpassword_required'),
            'country_code.required' => trans('lang.countrycode_required'),
        ];

        $validator = \Validator::make(
            [
                'name' => $name,
                'zone_id' => $zone_id,
                'country_id' => $country_id,
                'email' => $email,
                'mobile' => $mobile,
                'password' => $password,
                'country_code' => $country_code,
                'cpassword' => $cpassword,
            ],
            $rules,
            $messages
        );

        if ($validator->fails()) {
            $all = collect($validator->errors()->getMessages())->map(function ($item) {
                return $item[0];
            });
            $strs = [];
            foreach ($all as $value) {
                $strs[] =  $value;
            }
            return response()->json(['status' => false, 'message' => implode(',', $strs)], 422);
        }

        if ($password != $cpassword) {
            return response()->json(['status' => false, 'message' => 'كلمة المرور غير متطابقة'], 422);
        }


        \DB::beginTransaction();
        try {
            $client = new Clients();
            $client->name = $name;
            $client->zone_id = $zone_id;
            $client->country_id = $country_id;
            $client->mobile = $mobile;
            $client->country_code = $country_code;
            $client->email = $email;
            $client->fcm_token = $fcm_token;
            $client->os = $platform;
            $client->password = \Hash::make($password);
            $client->last_login = date('Y-m-d H:i:s');
            $code = rand(1000, 9999);
            // $code = 1234;
            $client->reset_code =  $code;
            // $client->save();
            $saved = $client->save();
            $t =  $client->createToken($request->mobile)->plainTextToken;
            $update_toekn = \App\Models\Tokens::where('tokenable_id', $client->id)->first();
            $update_toekn->token = $t;
            $update_toekn->platform = $platform;
            $update_toekn->fcm_token = $fcm_token;
            $update_toekn->ip = \Request::ip();
            $update_toekn->save();

            if (!$saved) {
                return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
            }


            $user_name = '966531341908';
            $user_pass = 'yagotapp@123';
            $text = trans('lang.your_code') . ' ' . $code;
            $sender = 'YagotApp-AD';
            $text = urlencode($text);
            $mobile = substr($client->mobile, 0, 1) == '0' ? substr($client->mobile, 1) :  $client->mobile;
            $mobile = $client->country_code . $mobile;
            $r = file_get_contents("https://www.hisms.ws/api.php?send_sms&username=$user_name&password=$user_pass&numbers=$mobile&sender=$sender&message=$text");

            $client->reset_code =  $code;

            $client = Clients::leftJoin('zones as z', function ($join) {
                $join->on('z.id', '=', 'clients.zone_id')->whereNull('z.deleted_at')->whereNull('z.parent_id');
            })->leftJoin('system_constants as s', function ($join) {
                $join->on('s.value', '=', 'clients.country_id')->Where('s.type', 'Country')->whereNull('s.deleted_at');
            })->where('clients.id', $client->id)->first([
                'clients.id', 'clients.active', 'clients.mobile', 'clients.name', 'clients.type', 'image', 'zone_id', 'clients.country_id', 'country_code', 's.value3 as country_image',
                'email', \DB::raw("CONCAT(clients.country_code,clients.mobile) AS full_mobile"), "s.name_$lang as country_name", "z.name_$lang as zone_name"
            ]);
            \DB::commit();
            return response()->json(['status' => true, 'message' => trans('lang.signup_success'), 'data' => ['token' => 'Bearer ' . $t, 'client' => $client]], 200);
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return response()->json(['status' => false, 'message' => trans('lang.error'), 'data' => null], 422);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {

        $mobile = $request->get('mobile');
        $password = $request->get('password');
        $fcm_token = $request->get('fcm_token');
        $platform = $request->header('platform');

        $rules = [
            'mobile' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'mobile.required' => trans('lang.mobile_required'),
            'password.required' => trans('lang.password_required'),
        ];

        $validator = \Validator::make(
            [
                'mobile' => $mobile,
                'password' => $password,
            ],
            $rules,
            $messages
        );

        if ($validator->fails()) {
            $all = collect($validator->errors()->getMessages())->map(function ($item) {
                return $item[0];
            });
            $strs = [];
            foreach ($all as $value) {
                $strs[] =  $value;
            }
            return response()->json(['status' => false, 'message' =>  implode(',', $strs)], 422);
        }
        $clients = Clients::where('mobile', $request->mobile)->first([
            'id', 'mobile', 'active', 'name', 'image', 'country_code', 'password', 'type', 'email', "clients.zone_id", "clients.country_id", 'last_login', \DB::raw("CONCAT(clients.country_code,clients.mobile) AS full_mobile")
        ]);
        if (!$clients || !\Hash::check($request->password, $clients->password)) {
            return response()->json(['status' => false, 'message' => __('lang.invalid_username_password')], 422);
        }

        \DB::beginTransaction();
        try {
            $old_tokens = \App\Models\Tokens::where('tokenable_id', $clients->id)->where('fcm_token', $fcm_token)->first();
            if ($old_tokens) {
                $old_tokens->delete();
            }

            if ($clients->active == 0) {
                $code = rand(1000, 9999);
                // $code = 1234;
                $user_name = '966531341908';
                $user_pass = 'yagotapp@123';
                $text = trans('lang.your_code') . ' ' . $code;
                $sender = 'YagotApp-AD';
                $text = urlencode($text);
                $mobile = substr($clients->mobile, 0, 1) == '0' ? substr($clients->mobile, 1) :  $clients->mobile;
                $mobile = $clients->country_code . $mobile;
                $r = @file_get_contents("https://www.hisms.ws/api.php?send_sms&username=$user_name&password=$user_pass&numbers=$mobile&sender=$sender&message=$text");
                $clients->reset_code = $code;
            }
            $clients->last_login = date('Y-m-d H:i:s');
            $clients->fcm_token = $fcm_token;
            $clients->os = $platform;
            $clients->save();
            $token =  $clients->createToken($request->mobile)->plainTextToken;
            $t = $token;
            $update_toekn =  \App\Models\Tokens::where('tokenable_id', $clients->id)->first();
            $update_toekn->token = $t;
            $update_toekn->platform = $platform;
            $update_toekn->fcm_token = $fcm_token;
            $update_toekn->ip = \Request::ip();
            $update_toekn->save();
            \DB::commit();
            return response()->json(['status' => true, 'data' => ['token' => 'Bearer ' . $t, 'client' => $clients]], 200);
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
    }


    public function logout(Request $request)
    {
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        if ($token) {
            $data['client'] = Clients::where('id', $token->tokenable_id)->first();
            if ($data['client']) {
                $data['client']->fcm_token = NULL;
                $data['client']->save();
            }
            $toekn =  \App\Models\Tokens::where('tokenable_id', $data['client']->id)->first();
            if ($toekn) {
                $toekn->delete();
            }
            return response()->json(['status' => true, 'message' => trans('lang.success')], 200);
        }
        return response()->json(['status' => true, 'message' => trans('lang.success')], 200);
    }


    public function forgetPassword(Request $request)
    {
        $mobile = $request->get('mobile');
        $rules = [
            'mobile' => 'required',
        ];
        $messages = [
            'mobile.required' => trans('lang.mobile_required'),
        ];
        $validator = \Validator::make(
            [
                'mobile' => $mobile,
            ],
            $rules,
            $messages
        );
        if ($validator->fails()) {
            $all = collect($validator->errors()->getMessages())->map(function ($item) {
                return $item[0];
            });
            $strs = [];
            foreach ($all as $value) {
                $strs[] =  $value;
            }
            return response()->json(['status' => false, 'message' => implode(',', $strs), 'data' => ''], 422);
        }

        $client = Clients::where('mobile', $mobile)->first();
        if ($client) {
            $token =  $client->createToken($mobile)->plainTextToken;
            $token_reset = \App\Models\Tokens::where('tokenable_id', $client->id)->orderBy('id', 'desc')->first();
            if ($token_reset) {

                \DB::beginTransaction();
                try {

                    $code = rand(1000, 9999);
                    $user_name = '966531341908';
                    $user_pass = 'yagotapp@123';
                    $text = trans('lang.your_password') . ' ' . $code;
                    $sender = 'YagotApp-AD';
                    $text = urlencode($text);
                    $mobile = substr($client->mobile, 0, 1) == '0' ? substr($client->mobile, 1) :  $client->mobile;
                    $mobile = $client->country_code . $mobile;
                    $r = @file_get_contents("https://www.hisms.ws/api.php?send_sms&username=$user_name&password=$user_pass&numbers=$mobile&sender=$sender&message=$text");

                    $client->token_reset_password =  $token_reset->token;
                    $client->password = \Hash::make($code);
                    $client->date_token_reset_password = date('Y-m-d H:i:s');
                    $saved = $client->save();
                    if (!$saved) {
                        return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
                    }
                    $deleted = $token_reset->delete();
                    if (!$deleted) {
                        return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
                    }

                    \DB::commit();
                    return response()->json(['status' => true, 'data' => $token_reset->token], 200);
                } catch (\Exception $e) {
                    \DB::rollback();
                }
                return response()->json(['status' => false, 'message' => trans('lang.error'), 'data' => ''], 422);
            } else {
                return response()->json(['status' => false, 'message' => trans('lang.error')], 404);
            }
        } else {
            return response()->json(['status' => false, 'message' => trans('lang.mobile_not_used')], 422);
        }
    }

    public function resetPassword(Request $request)
    {
        $password = $request->get('password');
        $confirm_password = $request->get('confirm_password');
        $token = $request->get('token');
        $code = $request->get('code');
        if ($token) {
            if ($password != $confirm_password) {
                return response()->json(['status' => false, 'message' => trans('lang.password_not_match')], 422);
            }
            $client = Clients::where('token_reset_password', $token)->where('reset_code', $code)->first();
            if (!$client) {
                return response()->json(['status' => false, 'message' => 'عذرا، الكود خطأ'], 422);
            }
            $hour1 = 0;
            $hour2 = 0;
            $date1 = $client->date_token_reset_password;
            $date2 = date('Y-m-d H:i:s');
            $datetimeObj1 = new \DateTime($date1);
            $datetimeObj2 = new \DateTime($date2);
            $interval = $datetimeObj1->diff($datetimeObj2);
            if ($interval->format('%a') > 0) {
                $hour1 = $interval->format('%a') * 24;
            }
            if ($interval->format('%h') > 0) {
                $hour2 = $interval->format('%h');
            }
            $hour = $hour1 + $hour2;
            if ($hour <= 24) {
                $client->password = \Hash::make($password);
                $saved = $client->save();
                if (!$saved) {
                    return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
                }
                return response()->json(['status' => true, 'message' => trans('lang.success')], 200);
            } else {
                return response()->json(['status' => false, 'message' => 'انتهت صلاحيةالكود المرسل'], 422);
            }
        } else {
            return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
        }
    }

    public function update_fcm_token(Request $request)
    {
        $fcm_token = $request->get('fcm_token');
        $header =  $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client =  \App\Models\Clients::where('id', $token->tokenable_id)->first();
        if ($client) {
            \DB::beginTransaction();
            try {

                $client->fcm_token = $fcm_token;
                $client->save();

                $update_toekn =  \App\Models\Tokens::where('tokenable_id', $client->id)->first();
                $update_toekn->fcm_token = $fcm_token;
                $update_toekn->save();

                \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success')], 200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false, 'message' => trans('lang.error'), 'data' => ''], 422);
        } else {
            return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
        }
    }

    public function send_code(Request $request)
    {
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id', $token->tokenable_id)->first();
        if ($client) {

            $code = rand(1000, 9999);
            // $code = 1234;
            $user_name = '966531341908';
            $user_pass = 'yagotapp@123';
            $text = trans('lang.your_code') . ' ' . $code;
            $sender = 'YagotApp-AD';
            $text = urlencode($text);
            $mobile = substr($client->mobile, 0, 1) == '0' ? substr($client->mobile, 1) :  $client->mobile;
            $mobile = $client->country_code . $mobile;
            $r = @file_get_contents("https://www.hisms.ws/api.php?send_sms&username=$user_name&password=$user_pass&numbers=$mobile&sender=$sender&message=$text");

            $client->reset_code =  $code;
            $saved = $client->save();
            if (!$saved) {
                return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
            }
            return response()->json(['status' => true, 'message' => trans('lang.success')], 200);
        } else {
            return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
        }
    }

    public function activate(Request $request)
    {
        $code = $request->code;
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id', $token->tokenable_id)->where('reset_code', $code)->first([
            'id', 'email', 'name', 'image', 'country_code', 'mobile', 'active',
            \DB::raw("CONCAT(clients.country_code,clients.mobile) AS full_mobile")
        ]);
        if ($client) {
            $client->active = 1;
            $saved = $client->save();
            if (!$saved) {
                return response()->json(['status' => false, 'message' => trans('lang.error')], 422);
            }
            return response()->json(['status' => true, 'message' => trans('lang.success'), 'data' => $client], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'الكود خطأ'], 422);
        }
    }
}
