<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Banks;
use App\Models\Clients;
use App\Models\BanksTransfer;
use App\Models\Messages;
use App\Models\Zones;
use App\Models\StaticPage;
use App\Models\Slider;
use App\Models\StonesImages;
use App\Models\Setting;
use App\Models\System_Constants;
use App\Models\Social;
use App\Models\Company;
use App\Models\Lists;
use App\Models\Faqs;
use App\Models\MobileNotification;
use App\Models\Subscriptions;
use App\Models\SubscriptionFeatures;
use App\Models\Notify;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as Notifiy;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\RawMessageFromArray;
use Kreait\Firebase\Messaging;

class ConstantController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function getSetting(){
        $lang = \App::getLocale();
        $data['setting'] = Setting::where('id',1)->first(['site_commission']);
        // $data['shipping_company'] = Company::get(['id',"name_$lang as name",'image']);
        $data['about_us'] = StaticPage::where('slug','about-us')->first(['id',"title_$lang as title","details_$lang as details"]);
        $data['alqism'] = StaticPage::where('slug','alqism')->first(['id',"title_$lang as title","details_$lang as details"]);
        $data['policy_privacy'] = StaticPage::where('slug','policy-privacy')->first(['id',"title_$lang as title","details_$lang as details"]);
        $data['terms_ohbbyist'] = StaticPage::where('slug','terms-ohbbyist')->first(['id',"title_$lang as title","details_$lang as details"]);
        $data['terms_company'] = StaticPage::where('slug','terms-company')->first(['id',"title_$lang as title","details_$lang as details"]);
        $data['account_type'] = System_Constants::where('status',1)->where('type','type')->get(['value as id',"name_$lang as name"]);
        $data['category'] = System_Constants::where('status',1)->where('type','category')->get(['value as id',"name_$lang as name"]);
        $data['product_status'] = System_Constants::where('status',1)->where('type','product_status')->get(['value as id',"name_$lang as name"]);
        $data['country'] = System_Constants::where('status',1)->where('value',1)->where('type','Country')->whereNotNull("name_$lang")->orderBy('value','asc')->take(10)->get(['value as id',"name_$lang as name",'value2 as country_code','value3 as flag']);
        $data['social'] = Social::where('status',1)->get(['id',"file as image","url"]);
        $data['currency'] = System_Constants::where('status',1)->where('type','currency')->get(['value as id',"name_$lang as name"]);
        $data['zones'] = Zones::where('status',1)->whereNull('parent_id')->get(['id',"name_$lang as name",'country_id']);
        $data['banks']  = Banks::where('status',1)->get(['id',"name_$lang as name",'account_no','iban']);
        $data['subscriptions'] = Subscriptions::with('features')->with('features.feature')->leftJoin('system_constants as s', function($join) {
                                        $join->on('s.value', '=', 'subscriptions.currency_id')->where('s.type','currency')->whereNull('s.deleted_at'); 
                                    })->get(['subscriptions.id',"subscriptions.name_$lang",'price','number_slider','number_products','number_days','currency_id',"s.name_$lang as currency_name"]);

        if($data['subscriptions']){
            foreach($data['subscriptions'] as $subs){
                if($subs->features){
                    for($i=0; $i<count($subs->features);$i++){
                        if($subs->features[$i]['feature_id'] == 1){
                            $subs->features[$i]['value'] = "$subs->number_slider";
                            $subs->features[$i]['name'] = $subs->features[$i]['feature']['name'];
                            unset($subs->features[$i]['feature']);
                        }
                        if($subs->features[$i]['feature_id'] == 2){
                            $subs->features[$i]['value'] = "$subs->number_products";
                            $subs->features[$i]['name'] = $subs->features[$i]['feature']['name'];
                            unset($subs->features[$i]['feature']);
                        }
                        if($subs->features[$i]['feature_id'] == 3){
                            if($subs->number_days == 1){
                                $num_day = $subs->number_days.' يوم';
                            }
                            if($subs->number_days >= 3 and $subs->number_days <= 10){
                                $num_day = $subs->number_days.' أيام';
                            }
                            if($subs->number_days >= 11){
                                $num_day = $subs->number_days.' يوم';
                            }
                            $s['feature']['value'] = $num_day;
                            $subs->features[$i]['value'] = $num_day;
                            $subs->features[$i]['name'] = $subs->features[$i]['feature']['name'];
                            unset($subs->features[$i]['feature']);
                        }
                        if($subs->features[$i]['feature_id'] == 4){
                            $subs->features[$i]['value'] = 'نعم';
                            $subs->features[$i]['name'] = $subs->features[$i]['feature']['name'];
                            unset($subs->features[$i]['feature']);
                        }
                        if($subs->features[$i]['feature_id'] == 5){
                            $subs->features[$i]['value'] = 'نعم';
                            $subs->features[$i]['name'] = $subs->features[$i]['feature']['name'];
                            unset($subs->features[$i]['feature']);
                        }
                    }
                    
                }
               
            }
        }
     
    //     $subscriptions  = array();
    //     if($data['subscriptions']){
    //     for($i=0; $i< count($data['subscriptions']) ;$i++){
    //         $num_day = '';
    //         $sub  = array();
    //         $sub = $data['subscriptions'][$i];
    //         if($data['subscriptions'][$i]->features){
    //             foreach($sub->features as $s){
    //                 if($s->feature_id == 4){
    //                     if($s->feature){
    //                         $s->feature->value = 'نعم';
    //                     }
    //                 }

    //                 if($s->feature_id == 5){
    //                     if($s->feature){
    //                         $s->feature->value = 'نعم';
    //                     }
    //                 }

    //                 if($s->feature_id == 3){
    //                     if($s->feature){
    //                         if($sub->number_days == 1){
    //                             $num_day = $sub->number_days.' يوم';
    //                         }
    //                         if($sub->number_days >= 3 and $sub->number_days <= 10){
    //                             $num_day = $sub->number_days.' أيام';
    //                         }
    //                         if($sub->number_days >= 11){
    //                             $num_day = $sub->number_days.' يوم';
    //                         }
    //                         $s['feature']['value'] = $num_day;
    //                     }
    //                 }

    //                 if($s->feature_id == 2){
    //                     if($s->feature){
    //                         $s->feature->value = "$sub->number_products";
    //                     }
    //                 }

    //                 if($s->feature_id == 1){
    //                     if($s->feature){
    //                         $s->feature->value = ''.$sub->number_slider.'';
    //                     }
    //                 }
    //         }
            
    //     }
        
    //     $subscriptions[] = $sub;
    //     // return $sub;
    //     if($i == 1){
    //         return $subscriptions[0];
    //     }
    //  }
    //  return $subscriptions;
    // }   


        return response()->json(['status' => true , 'message' => '','data'=>$data],200); 
    }


    public function category(){
        $lang = \App::getLocale();
        $category = System_Constants::where('status',1)->where('type','category')->select('value as id',"name_$lang as name")->paginate(self::$data['page']);
        return response()->json(['status' => true , 'message' => '','data'=>$category],200); 
    }

    public function zones(Request $request){
        $lang = \App::getLocale();
        $country_id = $request->get('country_id');
        $data['zones'] = Zones::where('status',1)->where('country_id',$country_id)->whereNull('parent_id')->get(['id',"name_$lang as name",'country_id']);
        return response()->json(['status' => true , 'message' => '','data'=>$data['zones']],200); 
    }

    public function city(Request $request){
        $lang = \App::getLocale();
        $id = $request->get('id');
        $data['city'] = Zones::where('status',1)->where('parent_id',$id)->get(['id',"name_$lang as name",'parent_id']);
        return response()->json(['status' => true , 'message' => '','data'=>$data['city']],200); 
    }
 
    public function contact_us(Request $request){
        $name = $request->get('name');
        $country_code = $request->get('country_code');
        $mobile = $request->get('mobile');
        $email = $request->get('email');
        $details = $request->get('details');

            $rules = [
                'name' => 'required',
                'email' => 'required',
                'country_code' => 'required',
                'details' => 'required',
                'mobile' => 'required',
            ];

            $messages = [
                'name.required' =>  trans('lang.name_required'),
                'email.required' => trans('lang.email_required'),
                'details.required' => trans('lang.details_required'),
                'country_code.required' =>  trans('lang.country_code_required'),
                'mobile.required' => trans('lang.mobile_required'),
            ];

            $validator = \Validator::make([
                'name' => $name,
                'email' => $email,
                'details' => $details,
                'country_code' => $country_code,
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
            
            \DB::beginTransaction();
            try {
                    $m = new Messages();
                    $m->name = $name;
                    $m->email = $email;
                    $m->details = $details;
                    $m->country_code = $country_code;
                    $m->mobile = $mobile;
                    $saved = $m->save();
                \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success')],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
    }


    public function site_commission(Request $request){
        $ammount = $request->get('ammount');
        if($ammount == ''){
            return response()->json(['status' => true, 'message' => trans('lang.amount_required')],422);
        }
        
        $num='';
        $num.= self::convertPersianNumbersToEnglish($ammount);
        
        $site_commission = Setting::where('id',1)->first('site_commission')->site_commission;
        $z = $num * $site_commission;
        $data['commission'] = number_format($z,2);
        $data['ammount'] = $ammount;
        return response()->json(['status' => true , 'message' =>'','data'=>$data],200);
    }
    
    
    public static function convertPersianNumbersToEnglish($string){
        
        $newNumbers = range(0, 9);
       $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
       $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
       // 3. Arabic Numeric
       $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
       // 4. Persian Numeric
       $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string =  str_replace($persianDecimal, $newNumbers, $string);
        $string =  str_replace($arabicDecimal, $newNumbers, $string);
        $string =  str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
        
    }
    // public function uploads(Request $request){
    //     $header =  $request->header('Authorization');
    //     if($header){
    //         $token  =  Helpers::Token($header);
    //         $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();

    //         $file = $request->file('file');
    //         $rules = [
    //             'file' => 'required',
    //         ];

    //         $messages = [
    //             'file.required' => trans('lang.audio_required'),
    //             // 'file.mimes' => trans('lang.audio_format'),
    //         ];

    //         $validator = \Validator::make([
    //             'file' => $file,
    //         ],
    //             $rules
    //             ,
    //             $messages
    //         );

    //         if ($validator->fails()) {
    //             $all = collect($validator->errors()->getMessages())->map(function($item){
    //                 return $item[0];
    //             });
    //             $strs = [];
    //             foreach ($all as $value) {
    //                 $strs[]=  $value;
    //             }
    //             return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>'']);
    //         }

    //         if ($file->isValid()){
    //             $audio = 'audio_'.$client->id. strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
    //             $file->move(public_path('uploads'), $audio);
    //         }

    //         return response()->json(['status' => true , 'message' => '' , 'data' => \URL::to('/').'/uploads/'.$audio ]); 
    //     }else{
    //         return response()->json(['status' => false , 'message' => trans('lang.error')]); 
    //     }

    // }

    public function getNotification(Request $request){
        // MobileNotification
        $header =  $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $data['notification'] = MobileNotification::where('client_id',$client->id)->orderBy('id','desc')->select('id','title','message','product_id','type','read_at','created_at')->paginate(20);
            foreach($data['notification']->whereNull('read_at') as $notify){
                $notify->read_at = date('Y-m-d H:i:s');
                $saved = $notify->save();
            }
            return response()->json(['status' => true , 'message' => '','data'=>$data['notification']],200); 
        }else{
            return response()->json(['status' => false , 'message' => 'لا يوجد بيانات للعميل'],422); 
        }
    }
    
    public function getRandomCategory(Request $request){
        $lang = \App::getLocale();
        $data['category'] = System_Constants::where('status',1)->where('type','stones')->inRandomOrder()->select('value as id',"name_$lang as name","details_$lang as details",'photo')->first();
        $data['category']['stones_images'] = StonesImages::Where('stone_id',$data['category']->id)->get(['id','image']);
        return response()->json(['status' => true , 'message' => '','data'=>$data['category']],200); 
    }
  

    public function verify_payment(Request $request){
        $transaction_id = $request->get('transaction_id');
        if($transaction_id == ''){
            return response()->json(['status' => false , 'message' => trans('lang.transaction_id_required'),'data'=>''],422); 
        }
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
        }else{
            return response()->json(['status' => true , 'message' => trans('lang.success'),'data'=>$server_output],200); 
        }
    }


    public function payment(Request $request){
        
        $lang = $request->header('lang');
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){    

            $price = $request->get('price');
            $payment_type = $request->get('payment_type');
            $name = $request->get('name');
            $account_no_from = $request->get('account_no_from');
            $account_no_to = $request->get('account_no_to');
            $bank_id = $request->get('bank_id');
            $file = $request->file('file');
            // $transaction_id = $request->get('transaction_id');
           

            // if($subscription_id == ''){
            //     return response()->json(['status' => false , 'message' => trans('lang.subscription_required')],422); 
            // }
            if($payment_type == ''){
                $payment_type = 2;
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

                if($price == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.price_required'),'data'=>''],422); 
                }

                $ext = strtolower($file->getClientOriginalExtension());
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'message' => trans('lang.image_format'),'data'=>''],422); 
                }
                
            }

            // if($payment_type == 1){
            //     if($transaction_id == ''){
            //         return response()->json(['status' => false , 'message' => trans('lang.transaction_id_required'),'data'=>''],422); 
            //     }
            //     // $headers = [
            //     //  "x-Authorization:",
            //     // ];
            //     $fields = array(
            //         "merchant_email" => "tejaratek@gmail.com",
            //         "secret_key" => "Jz2VgKye5tQ4rxb2unLtMa6ASaq2mY96yc1PXA323U7vriyVGkotvv3nFup2ty81LaRILUKPORkgaTbRdAkI5n6KSvNl3WmO6dwR",
            //         'transaction_id' => $transaction_id
            //     );
            //     $fields_string = http_build_query($fields);
            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL,"https://www.paytabs.com/apiv2/verify_payment_transaction");
            //     curl_setopt($ch, CURLOPT_POST, 1);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //     $server_output = curl_exec($ch);
            //     curl_close($ch);
            //     $server_output = json_decode($server_output,true);

            //     if($server_output['response_code'] != "100" and $server_output['response_code'] != "6"  and $server_output['response_code'] != "11"){
            //         return response()->json(['status' => false , 'message' => trans('lang.'.$server_output['response_code']),'data'=>''],422); 
            //     }
            // }

            \DB::beginTransaction();
            try {
                    $b = new BanksTransfer();
                    $b->total_price = $price;
                    $b->date = date('Y-m-d');
                    $b->client_id = $client->id;
                    $b->action_source = 2;
                    $b->payment_type = $payment_type;
                    if($payment_type == 2){
                        $image = '';
                        if($request->hasFile('file') && $file->isValid())
                        {
                            $image = $client->id.\Str::random(8). '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('uploads'), $image);
                            $b->image = $image;
                        }
                        $b->name = $name;
                        $b->account_no_from = $account_no_from;
                        $b->account_no_to = $account_no_to;
                        $b->bank_id = $bank_id;
                    }
                    // if($payment_type == 1){
                    //     $b->transaction_id = $transaction_id;
                    // }
                    $saved = $b->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

             \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success')],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

}
