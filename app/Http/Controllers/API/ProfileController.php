<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Clients;
use App\Models\BanksTransfer;
use App\Models\Subscriptions;
use App\Models\Favorites;
use App\Models\SubscriptionFeatures;
use App\Models\Products;
use Facade\FlareClient\Http\Client;

class ProfileController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $lang = \App::getLocale();
        $id = $request->get('id');
        $header = $request->header('Authorization');
        $lang = $request->header('lang');
        $z=0;
        $status = false;
        if($id != ''){
            $id = $id;
        }elseif($header != ''){
            $token  = Helpers::Token($header);
            if($token){
                $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                $id = $client->id;
                $status = true;
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401); 
        }

            $client =  Clients::leftJoin('zones as z', function($join) {
                            $join->on('z.id', '=', 'clients.zone_id')->whereNull('z.deleted_at')->whereNull('z.parent_id'); 
                        })->leftJoin('system_constants as s', function($join) {
                            $join->on('s.value', '=', 'clients.country_id')->Where('s.type','Country')->whereNull('s.deleted_at'); 
                        })->leftJoin('system_constants as sy', function($join) {
                            $join->on('sy.value', '=', 'clients.type')->where('sy.type','type')->whereNull('sy.deleted_at'); 
                        })->where('clients.id',$id)->select('clients.id','clients.name','clients.mobile','clients.email','clients.image','clients.type',
                        'clients.country_code',\DB::raw('CONCAT(clients.country_code,clients.mobile) AS full_mobile'),"sy.name_$lang as client_type",
                        "clients.zone_id","clients.country_id",'clients.passport','clients.commercial_photo','clients.identity','subscription_id','start_subscription','end_subscription',"z.name_$lang as zone_name","s.name_$lang as country_name",'s.value3 as country_image','last_login');
            $client = $client->first();
            if(!$client){
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }

            $subscription = Subscriptions::where('id',$client->subscription_id)->first(['id',"name_$lang as name",'price']);
            $subscription['start_subscription'] = $client->start_subscription;
            $subscription['end_subscription'] = $client->end_subscription;

            $end = strtotime($client->end_subscription);
            $start = strtotime($client->start_subscription);
            $datediff = $end - $start;
            $subscription['number_days'] = round($datediff / (60 * 60 * 24));

            $now = date('Y-m-d H:i:s');
            if($client->type == 2 and $client->subscription_id and $client->start_subscription <= $now and $client->end_subscription >= $now){
                $s_feature = SubscriptionFeatures::where('subscription_id',$client->subscription_id)->where('feature_id',4)->first();
                if($s_feature){
                    $client['certified'] = 1; 
                }else{
                    $client['certified'] = 0;
                }
            }else{
                $client['certified'] = 0;
            }

            $num_days = 0;
            $alert = '';
            if($subscription['end_subscription'] != '' and $subscription['end_subscription'] > date('Y-m-d')){
                $end = strtotime($subscription['end_subscription']);
                $start = strtotime(date('Y-m-d'));
                $datediff = $end - $start;
                $num_days  = round($datediff / (60 * 60 * 24));
                $alert = 'متبقي  على باقتك '.$num_days.' يوم';
            }elseif($subscription['end_subscription'] != '' and $subscription['end_subscription'] <= date('Y-m-d')){
                $alert = 'انتهت باقتك';
            }
            
            $products = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.client_id',$client->id)->where('products.status',1)
            ->select('products.id','products.title','products.image as image','products.price',"sys.name_$lang as currency_name"
                    ,'products.category_id','cl.name',"s.name_$lang as category_name",'products.currency_id','products.city_id',"z.name_$lang as city_name");

            if($status){
                $products = $products->leftJoin('favorites as f', function($join) use ($id){
                    $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$id)->whereNull('f.deleted_at'); 
                })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
            }else{
                $products = $products->selectRaw(\DB::raw('0  AS is_favorites'));
            }
            $products = $products->orderby('products.id','desc')->get();
        
     
        if($client){
            $data['product'] = $products;
            $data['client'] = $client;
            $data['subscription'] = $subscription;
            $data['alert'] = $alert;
            $data['num_days'] = $num_days;
            return response()->json(['status' => true,'data'=>$data],200);
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

    public function prouduct(Request $request){
        $header = $request->header('Authorization');
        $lang = $request->header('lang');

        $token  = Helpers::Token($header);
        if($token){
            $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
            $data['activated'] = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.client_id',$client->id)->where('products.status',1)
            ->select('products.id','products.title','products.image as image','products.price',"sys.name_$lang as currency_name"
                    ,'products.category_id','cl.name',"s.name_$lang as category_name",'products.currency_id',"z.name_$lang as city_name",'products.city_id');
            $data['activated'] = $data['activated']->orderby('products.id','desc')->get();

            $data['pending'] = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.client_id',$client->id)->where('products.status',2)
            ->select('products.id','products.title','products.image as image','products.price',"sys.name_$lang as currency_name"
                    ,'products.category_id','cl.name',"s.name_$lang as category_name",'products.currency_id',"z.name_$lang as city_name",'products.city_id');
            $data['pending'] = $data['pending']->orderby('products.id','desc')->get();

            $data['closed'] = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.client_id',$client->id)->where('products.status',3)
            ->select('products.id','products.title','products.image as image','products.price',"sys.name_$lang as currency_name"
                    ,'products.category_id','cl.name',"s.name_$lang as category_name",'products.currency_id',"z.name_$lang as city_name",'products.city_id');
            $data['closed'] = $data['closed']->orderby('products.id','desc')->get();

            return response()->json(['status' => true,'data'=>$data],200);
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401); 
        }
    }

    public function editProfile(Request $request){
        $header = $request->header('Authorization');
        $lang = $request->header('lang');
        
        
        $token  = Helpers::Token($header);
        if($token){
            $clients_id =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
            $client =  Clients::leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'clients.zone_id')->whereNull('z.deleted_at')->whereNull('z.parent_id'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'clients.country_id')->Where('s.type','Country')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sy', function($join) {
                $join->on('sy.value', '=', 'clients.type')->where('sy.type','type')->whereNull('sy.deleted_at'); 
            })->where('clients.id',$token->tokenable_id)->select('clients.id','clients.name','clients.mobile','clients.email','clients.image','clients.type',
            'clients.country_code',\DB::raw('CONCAT(clients.country_code,clients.mobile) AS full_mobile'),"sy.name_$lang as client_type",
            "clients.zone_id","clients.country_id",'clients.passport','clients.commercial_photo','clients.identity',"z.name_$lang as zone_name","s.name_$lang as country_name",'s.value3 as country_image','last_login');
            $client = $client->first();
            if(!$client){
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }
            $data['client'] = $client;
            return response()->json(['status' => true,'data'=>$data],200);
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401); 
        }
    }

    public function update(Request $request){
        $header = $request->header('Authorization');
        $lang = $request->header('lang');
        $token  =  Helpers::Token($header);
        $data['client'] = Clients::where('clients.id',$token->tokenable_id)->first();
        if($data['client']){
            $email = $request->get('email');
            $fname = $request->get('name');
            $mobile = $request->get('mobile');
            $zone_id = $request->get('zone_id');
            $country_code = $request->get('country_code');
            $country_id = $request->get('country_id');
            // $fcm_token = $request->get('fcm_token');
            $file = $request->file('file');

            // if($fcm_token){
            //     $token->fcm_token = $fcm_token;
            //     $token->save();
            // }
            $passport = $request->file('passport');
            $identity = $request->file('identity');
            $commercial_photo = $request->file('commercial_photo');

            if($email){
                $rules = [
                    'email' => 'email|unique:clients,email,' . $data['client']->id,
                ];
                $messages = [
                    'email.unique' => trans('lang.email_used'),
                    'email.email' => trans('lang.email_format'),
                ];
                $validator = \Validator::make([
                    'email' => $email,
                ],
                    $rules
                    ,
                    $messages
                );
                if ($validator->fails()) {
                    $all = collect($validator->errors()->getMessages())->map(function($item){
                        return $item[0];
                    });
                    $strs = [];
                    foreach ($all as $value) {
                        $strs[]=  $value;
                    }
                    return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>''],422);
                }
            }

            if($mobile){
                $rules = [
                    'mobile' => 'unique:clients,mobile,' . $data['client']->id,
                ];
                $messages = [
                    'mobile.unique' => trans('lang.mobile_used'),
                ];
                $validator = \Validator::make([
                    'mobile' => $mobile,
                ],
                    $rules
                    ,
                    $messages
                );
                if ($validator->fails()) {
                    $all = collect($validator->errors()->getMessages())->map(function($item){
                        return $item[0];
                    });
                    $strs = [];
                    foreach ($all as $value) {
                        $strs[]=  $value;
                    }
                    return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>''],422);
                }
            }

            if($file){
                $rules = [
                    'file' => 'nullable|mimes:jpeg,jpg,png',
                ];
                $messages = [
                    'file.mimes' => trans('lang.image_format'),
                ];
                $validator = \Validator::make([
                    'file' => $file,
                ],
                    $rules
                    ,
                    $messages
                );
                if ($validator->fails()) {
                    $all = collect($validator->errors()->getMessages())->map(function($item){
                        return $item[0];
                    });
                    $strs = [];
                    foreach ($all as $value) {
                        $strs[]=  $value;
                    }
                    return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>''],422);
                }
            }

        
                $image = '';
                if($request->hasFile('file') && $file->isValid())
                {
                    $image = 'profile_'.$data['client']->id.strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $image);
                }
                
                if($email){
                    $data['client']->email = $email;
                }
                if($fname){
                    $data['client']->name = $fname;
                }
                if($mobile){
                    $data['client']->mobile = $mobile;
                }
                if($country_id){
                    $data['client']->country_id = $country_id;
                }
                if($country_code){
                    $data['client']->country_code = $country_code;
                }
                if($image){
                    $data['client']->image = $image;
                }
                if($zone_id){
                    $data['client']->zone_id = $zone_id;
                }

                $pass_pic = '';
                if ($request->hasFile('passport') && $passport->isValid())
                {
                    $pass_pic = 'pass_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $passport->getClientOriginalExtension();
                    $passport->move(public_path('uploads'), $pass_pic);
                }
    
                $identity_pic = '';
                if ($request->hasFile('identity') && $identity->isValid())
                {
                    $identity_pic = 'identity_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $identity->getClientOriginalExtension();
                    $identity->move(public_path('uploads'), $identity_pic);
                }
    
                $commercial_photo_pic = '';
                if ($request->hasFile('commercial_photo') && $commercial_photo->isValid())
                {
                    $commercial_photo_pic = 'commercial_photo_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $commercial_photo->getClientOriginalExtension();
                    $commercial_photo->move(public_path('uploads'), $commercial_photo_pic);
                }

                if($pass_pic){
                    $data['client']->passport =$pass_pic ;
                }
                if($identity_pic){
                    $data['client']->identity =$identity_pic ;
                }
                if($commercial_photo_pic){
                    $data['client']->commercial_photo =$commercial_photo_pic ;
                }


                // $data['client']->fcm_token = $fcm_token;
                $saved = $data['client']->save();
                if($saved){
                    $client = Clients::leftJoin('zones as z', function($join) {
                        $join->on('z.id', '=', 'clients.zone_id')->whereNull('z.deleted_at')->whereNull('z.parent_id'); 
                    })->leftJoin('system_constants as s', function($join) {
                        $join->on('s.value', '=', 'clients.country_id')->Where('s.type','Country')->whereNull('s.deleted_at'); 
                    })->where('clients.id',$data['client']->id)->first(['clients.id','clients.mobile','clients.name','image','zone_id','clients.country_id','clients.country_code','s.value3 as flag',
                            'email',\DB::raw("CONCAT(clients.country_code,clients.mobile) AS full_mobile"),"s.name_$lang as country_name","z.name_$lang as zone_name"]);

                    return response()->json(['status' => true , 'message' => trans('lang.success') ,'data'=>['client' => $client]],200); 
                }
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }
       
    }

    public function update_password(Request $request){
        $old = $request->get('old_password');
        $password = $request->get('password');
        $confirm_password = $request->get('confirm_password');

        $rules = [
            'old' => 'required',
            'password' => 'required',
        ];

        $messages = [
            'old.required' => trans('lang.old_password'),
            'password.required' => trans('lang.password'),
            'confirm_password.required' => trans('lang.confirm_password'),
        ];

        $validator = \Validator::make([
            'old' => $old,
            'password' => $password,
            'confirm_password' => $confirm_password,
        ],
            $rules
            ,
            $messages
        );

        if ($validator->fails()) {
            $all = collect($validator->errors()->getMessages())->map(function($item){
                return $item[0];
              });
              $strs = [];
              foreach ($all as $value) {
                  $strs[]=  $value;
              }
            return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>''],422);
        }

        if($password != $confirm_password){
            return response()->json(['status' => false , 'message' => trans('lang.password_not_match')],422); 
        }

        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first(['id','password']);
        if($client){
            if(\Hash::check($old, $client->password)){
                $client->password = \Hash::make($password);
                $saved = $client->save();
                if($saved){
                    return response()->json(['status' => true , 'message' => trans('lang.success')],200); 
                }
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.old_password_wrong')],422); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }



    public function complete_registration(Request $request){
        $lang = $request->header('lang');
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $type = $request->get('type');
            if($type == ''){
                return response()->json(['status' => false , 'message' => trans('lang.type_required')],422); 
            }
            $company_name = $request->get('company_name');
            $commercial_no = $request->get('commercial_no');
            $lat = $request->get('lat');
            $lon = $request->get('lon');
            $area = $request->get('area');
            $street = $request->get('street');
            $office_no = $request->get('office_no');
            $subscription_id = $request->get('subscription_id');
            $payment_type = $request->get('payment_type');
            $name = $request->get('name');
            $account_no_from = $request->get('account_no_from');
            $account_no_to = $request->get('account_no_to');
            $bank_id = $request->get('bank_id');
            $file = $request->file('file');
            $transaction_id = $request->get('transaction_id');
            $passport = $request->file('passport');
            $identity = $request->file('identity');
            $commercial_photo = $request->file('commercial_photo');
          
            if($type == 2){
                if($company_name == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.company_required')],422); 
                }
                if($commercial_no == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.commercial_no_required')],422); 
                }

                $check_commercial = Clients::where('commercial_no',$commercial_no)->first();
                if($check_commercial){
                        return response()->json(['status' => false , 'message' => trans('lang.commercial_found')],422); 
                }
                // if($lat == ''){
                //     return response()->json(['status' => false , 'message' => trans('lang.location_required')],422); 
                // }
                // if($lon == ''){
                //     return response()->json(['status' => false , 'message' => trans('lang.location_required')],422); 
                // }
                if($area == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.area_required')],422); 
                }
                if($street == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.street_required')],422); 
                }
                if($office_no == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.office_no_required')],422); 
                }
                if($subscription_id == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.subscription_required')],422); 
                }

                if($payment_type == 2){
                    if($name == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.name_required'),'data'=>''],422); 
                    }
                    if($bank_id == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.bank_id_required'),'data'=>''],422); 
                    }
                    if($account_no_from == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.account_no_from_required'),'data'=>''],422); 
                    }
                    if($account_no_to == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.account_no_to_required'),'data'=>''],422); 
                    }
                    if($file == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.file_required'),'data'=>''],422); 
                    }
    
                    $ext = strtolower($file->getClientOriginalExtension());
                    if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                        return response()->json(['status' => false , 'message' => trans('lang.image_format'),'data'=>''],422); 
                    }
                    
                }
                if($payment_type == 1){
                    if($transaction_id == ''){
                        return response()->json(['status' => false , 'message' => trans('lang.transaction_id_required'),'data'=>''],422); 
                    }
                    // $headers = [
                    //  "x-Authorization:",
                    // ];
                    $fields = array(
                        "merchant_email" => "tejaratek@gmail.com",
                        "secret_key" => "Jz2VgKye5tQ4rxb2unLtMa6ASaq2mY96yc1PXA323U7vriyVGkotvv3nFup2ty81LaRILUKPORkgaTbRdAkI5n6KSvNl3WmO6dwR",
                        'transaction_id' => $transaction_id
                    );
                    $fields_string = http_build_query($fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,"https://www.paytabs.com/apiv2/verify_payment_transaction");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $server_output = curl_exec($ch);
                    curl_close($ch);
                    $server_output = json_decode($server_output,true);

                    if($server_output['response_code'] != "100" and $server_output['response_code'] != "6"  and $server_output['response_code'] != "11"){
                        return response()->json(['status' => false , 'message' => trans('lang.'.$server_output['response_code']),'data'=>''],422); 
                    }
                }
            }

            $pass_pic = '';
            if ($request->hasFile('passport') && $passport->isValid())
            {
                $pass_pic = 'pass_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $passport->getClientOriginalExtension();
                $passport->move(public_path('uploads'), $pass_pic);
            }

            $identity_pic = '';
            if ($request->hasFile('identity') && $identity->isValid())
            {
                $identity_pic = 'identity_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $identity->getClientOriginalExtension();
                $identity->move(public_path('uploads'), $identity_pic);
            }

            $commercial_photo_pic = '';
            if ($request->hasFile('commercial_photo') && $commercial_photo->isValid())
            {
                $commercial_photo_pic = 'commercial_photo_pic' . strtotime(date("Y-m-d H:i:s")) . '.' . $commercial_photo->getClientOriginalExtension();
                $commercial_photo->move(public_path('uploads'), $commercial_photo_pic);
            }

            \DB::beginTransaction();
            try {

                $client->type = $type; 
                if($type == 2){
                    $client->type = $type;
                    $client->company_name = $company_name;
                    $client->commercial_no = $commercial_no;
                    $client->area = $area;
                    $client->street = $street;
                    $client->office_no = $office_no;
                    $client->lat = $lat;
                    $client->lon = $lon;

                    $s = Subscriptions::where('id',$subscription_id)->first();
                    $start_subscription = date('Y-m-d H:i:s');

                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $start_subscription);
                    // $daysToAdd = $s->number_days;
                    if($s->number_days){
                        $end_subscription = $date->addDays($s->number_days);
                    }
                    $client->subscription_id = $subscription_id;
                    $client->start_subscription = $start_subscription;
                    $client->end_subscription  = $end_subscription;
                    if($pass_pic){
                        $client->passport =$pass_pic ;
                    }
                    if($identity_pic){
                        $client->identity =$identity_pic ;
                    }
                    if($commercial_photo_pic){
                        $client->commercial_photo =$commercial_photo_pic ;
                    }

                    $b = new BanksTransfer();
                    $b->order_id = $subscription_id;
                    $b->total_price = $s->price;
                    $b->date = date('Y-m-d');
                    $b->client_id = $client->id;
                    $b->action_source = 2;
                    $b->payment_type = $payment_type;
                    if($payment_type == 2){
                        $image = '';
                        if($request->hasFile('file') && $file->isValid())
                        {
                            $image = $subscription_id.\Str::random(8). '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('uploads'), $image);
                            $b->image = $image;
                        }
                        $b->name = $name;
                        $b->account_no_from = $account_no_from;
                        $b->account_no_to = $account_no_to;
                        $b->bank_id = $bank_id;
                    }
                    if($payment_type == 1){
                        $b->transaction_id = $transaction_id;
                    }
                    $saved = $b->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }
                }
                $saved = $client->save();
                if(!$saved){
                    return response()->json(['status' => true , 'message' => trans('lang.error')],422); 
                }

                $c = Clients::leftJoin('zones as z', function($join) {
                    $join->on('z.id', '=', 'clients.zone_id')->whereNull('z.deleted_at')->whereNull('z.parent_id'); 
                })->leftJoin('system_constants as s', function($join) {
                    $join->on('s.value', '=', 'clients.country_id')->Where('s.type','Country')->whereNull('s.deleted_at'); 
                })->where('clients.id',$client->id)->first(['clients.id','clients.mobile','clients.name','clients.type','image','zone_id','clients.country_id','country_code','s.value3 as country_image',
                        'email',\DB::raw("CONCAT(clients.country_code,clients.mobile) AS full_mobile"),"s.name_$lang as country_name","z.name_$lang as zone_name"]);
                        
            \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success'),'data'=>$c],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422); 


       

        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }





    }

    public function update_subscription(Request $request){
        
        $lang = $request->header('lang');
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){    

            $subscription_id = $request->get('subscription_id');
            $payment_type = $request->get('payment_type');
            $name = $request->get('name');
            $account_no_from = $request->get('account_no_from');
            $account_no_to = $request->get('account_no_to');
            $bank_id = $request->get('bank_id');
            $file = $request->file('file');
            $transaction_id = $request->get('transaction_id');
           

            if($subscription_id == ''){
                return response()->json(['status' => false , 'message' => trans('lang.subscription_required')],422); 
            }

            if($payment_type == 2){
                if($name == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.name_required'),'data'=>''],422); 
                }
                if($bank_id == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.bank_id_required'),'data'=>''],422); 
                }
                if($account_no_from == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.account_no_from_required'),'data'=>''],422); 
                }
                if($account_no_to == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.account_no_to_required'),'data'=>''],422); 
                }
                if($file == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.file_required'),'data'=>''],422); 
                }

                $ext = strtolower($file->getClientOriginalExtension());
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'message' => trans('lang.image_format'),'data'=>''],422); 
                }
                
            }

            if($payment_type == 1){
                if($transaction_id == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.transaction_id_required'),'data'=>''],422); 
                }
                // $headers = [
                //  "x-Authorization:",
                // ];
                $fields = array(
                    "merchant_email" => "tejaratek@gmail.com",
                    "secret_key" => "Jz2VgKye5tQ4rxb2unLtMa6ASaq2mY96yc1PXA323U7vriyVGkotvv3nFup2ty81LaRILUKPORkgaTbRdAkI5n6KSvNl3WmO6dwR",
                    'transaction_id' => $transaction_id
                );
                $fields_string = http_build_query($fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://www.paytabs.com/apiv2/verify_payment_transaction");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                curl_close($ch);
                $server_output = json_decode($server_output,true);

                if($server_output['response_code'] != "100" and $server_output['response_code'] != "6"  and $server_output['response_code'] != "11"){
                    return response()->json(['status' => false , 'message' => trans('lang.'.$server_output['response_code']),'data'=>''],422); 
                }
            }

            \DB::beginTransaction();
            try {

                    $s = Subscriptions::where('id',$subscription_id)->first();
                    $start_subscription = date('Y-m-d H:i:s');

                    $date = Carbon::createFromFormat('Y-m-d H:i:s', $start_subscription);
                    // $daysToAdd = $s->number_days;
                    if($s->number_days){
                        $end_subscription = $date->addDays($s->number_days);
                    }
                    $client->subscription_id = $subscription_id;
                    $client->start_subscription = $start_subscription;
                    $client->end_subscription  = $end_subscription;
                    $client->save();

                    $b = new BanksTransfer();
                    $b->order_id = $subscription_id;
                    $b->total_price = $s->price;
                    $b->date = date('Y-m-d');
                    $b->client_id = $client->id;
                    $b->action_source = 2;
                    $b->payment_type = $payment_type;
                    if($payment_type == 2){
                        $image = '';
                        if($request->hasFile('file') && $file->isValid())
                        {
                            $image = $subscription_id.\Str::random(8). '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('uploads'), $image);
                            $b->image = $image;
                        }
                        $b->name = $name;
                        $b->account_no_from = $account_no_from;
                        $b->account_no_to = $account_no_to;
                        $b->bank_id = $bank_id;
                    }
                    if($payment_type == 1){
                        $b->transaction_id = $transaction_id;
                    }
                    $saved = $b->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

             \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success')],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => true, 'message' => trans('lang.error')],422);
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

  
}