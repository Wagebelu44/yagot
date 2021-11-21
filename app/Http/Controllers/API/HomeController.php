<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Products;
use App\Models\Subscriptions;
use App\Models\ProductAttachments;
use App\Models\Notify;
use App\Models\Setting;
use App\Models\Favorites;
use App\Models\SubscriptionFeatures;
use App\Models\Slider;
use App\Models\Clients;
use App\Models\HomeOrder;
use App\Models\System_Constants;
use App\Models\User;
use App\Models\MobileNotification;
use Notification;
use App\Notifications\UserNotify;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as Notifiy;

class HomeController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $data = array();

        $category_id = $request->get('category_id');
        $city_id = $request->get('city_id');
        $title = $request->get('title');
        $lang =  $request->header('lang');
        $from_price = $request->get('from_price');
        $to_price = $request->get('to_price');

        $orders = HomeOrder::orderBy('order_no','asc')->get();

        $slider = Slider::whereNull('parent_id')->orderBy('id','desc')->whereNull('parent_id')->select('id',"title_$lang as title",'status')->get();

        // $slider = Slider::leftJoin('system_constants as s', function($join) {
        //     $join->on('s.value', '=', 'slider.reference_id')->where('slider.type',3)->where('s.type','category')->whereNull('s.deleted_at'); 
        // })->leftJoin('products as p', function($join) {
        //     $join->on('p.id', '=', 'slider.reference_id')->where('slider.type',2)->whereNull('p.deleted_at'); 
        // })->where('slider.status',1)->orderBy('slider.id','desc')->take(self::$data['page'])
       
        // ->select('slider.id','slider.type','slider.url','slider.reference_id','slider.image');
        // $slider = $slider->selectRaw("CASE
        //                                 WHEN slider.type = 3 THEN s.name_$lang
        //                                 WHEN slider.type = 2 THEN p.title
        //                                 ELSE null
        //                         END  as title");
        // $slider = $slider->get();


        $category = System_Constants::where('status',1)->where('type','category')->take(self::$data['page'])->get(['value as id',"name_$lang as name"]);

        $z = 0;
        if($title == '' and $category_id == '' and $city_id == '' and $from_price == '' and $to_price == ''){
            
            $products = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.status',1)
            ->select('products.id','products.title','products.image as image','products.price','products.created_at as date',"sys.name_$lang as currency_name"
                    ,'products.category_id','products.currency_id','cl.name',"s.name_$lang as category_name","z.name_$lang as city_name");
            
            $header =  $request->header('Authorization');
            if($header and $header != null and $header != 'null'){
                $token  =  Helpers::Token($header);
                if($token){
                    $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                    if($client){
                        $z = 1;
                        $products = $products->where('products.client_id',$client->id)->leftJoin('favorites as f', function($join) use ($client){
                                    $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$client->id)->whereNull('f.deleted_at'); 
                                })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                    }else{
                        $products = $products->selectRaw(\DB::raw('0 AS is_favorites'));
                    }
                }else{
                    $products = $products->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }
            $products = $products->orderby('products.order','desc')->orderby('products.id','desc')->take(7)->get();
        }   
        // ->offset(self::$data['page']*($request->page - 1))

       
        if(($category_id == '' or  $category_id == 1000)){
            // return 22;
        $more_visit = Products::leftJoin('clients as cl', function($join) {
            $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
        })->leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('system_constants as sys', function($join) {
            $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
        })->leftJoin('zones as z', function($join) {
            $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
        })->where('products.status',1)
        ->select('products.id','products.title','products.image as image','products.price','products.created_at as date',"sys.name_$lang as currency_name"
                ,'products.category_id','products.currency_id','cl.name',"s.name_$lang as category_name","z.name_$lang as city_name");
        $header =  $request->header('Authorization');
        if($header and $header != null and $header != 'null'){
            $token  =  Helpers::Token($header);
            if($token){
                $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                if($client){
                    $more_visit = $more_visit->leftJoin('favorites as f', function($join) use ($client){
                                $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$client->id)->whereNull('f.deleted_at'); 
                            })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                }else{
                    $more_visit = $more_visit->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }else{
                $more_visit = $more_visit->selectRaw(\DB::raw('0 AS is_favorites'));
            }
        }
        $more_visit = $more_visit->orderby('products.view_no','desc')->orderby('products.order','desc')->take(7)->get();

        }

        if(($category_id == '' or  $category_id == 1002)){
            
        $certificated_products = Products::leftJoin('clients as cl', function($join) {
            $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
        })->leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('system_constants as sys', function($join) {
            $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
        })->leftJoin('zones as z', function($join) {
            $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
        })->where('products.status',1)->where('products.certified',1)
        ->select('products.id','products.title','products.image as image','products.price','products.created_at as date',"sys.name_$lang as currency_name"
                ,'products.category_id','products.currency_id','cl.name',"s.name_$lang as category_name","z.name_$lang as city_name");
        $header =  $request->header('Authorization');
        if($header and $header != null and $header != 'null'){
            $token  =  Helpers::Token($header);
            if($token){
                $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                if($client){
                    $certificated_products = $certificated_products->leftJoin('favorites as f', function($join) use ($client){
                                $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$client->id)->whereNull('f.deleted_at'); 
                            })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                }else{
                    $certificated_products = $certificated_products->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }else{
                $certificated_products = $certificated_products->selectRaw(\DB::raw('0 AS is_favorites'));
            }
        }
        $certificated_products = $certificated_products->orderby('products.order','desc')->orderby('products.id','desc')->take(7)->get();
    
        }

        if(($category_id == '' or  $category_id == 1001)){

        $last_added = Products::leftJoin('clients as cl', function($join) {
            $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
        })->leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('system_constants as sys', function($join) {
            $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
        })->leftJoin('zones as z', function($join) {
            $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
        })->where('products.status',1)
        ->select('products.id','products.title','products.image as image','products.price','products.created_at as date',"sys.name_$lang as currency_name"
                ,'products.category_id','products.currency_id','cl.name',"s.name_$lang as category_name","z.name_$lang as city_name");
        $z = 0;
        $header =  $request->header('Authorization');
        if($header and $header != null and $header != 'null'){
            $token  =  Helpers::Token($header);
            if($token){
                $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                if($client){
                    $z = 1;
                    $last_added = $last_added->leftJoin('favorites as f', function($join) use ($client){
                                $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$client->id)->whereNull('f.deleted_at'); 
                            })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                }else{
                    $last_added = $last_added->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }else{
                $last_added = $last_added->selectRaw(\DB::raw('0 AS is_favorites'));
            }
        }
        $last_added = $last_added->orderby('products.id','desc')->orderby('products.order','desc')->take(7)->get();

        }
        $w = 0;

        if(($title != '' or $category_id != '' or $city_id != '' or $from_price != '' or $to_price != '' ) and ($category_id != 1000 and $category_id != 1001 and $category_id != 1002)){
            $w=1;  
            $search_products = Products::leftJoin('clients as cl', function($join) {
                $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
            })->leftJoin('system_constants as s', function($join) {
                $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
            })->leftJoin('system_constants as sys', function($join) {
                $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
            })->leftJoin('zones as z', function($join) {
                $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
            })->where('products.status',1)
            ->select('products.id','products.title','products.image as image','products.price','products.created_at as date',"sys.name_$lang as currency_name"
                    ,'products.category_id','products.currency_id','cl.name',"s.name_$lang as category_name","z.name_$lang as city_name");
            $z = 0;
            $header =  $request->header('Authorization');
            if($header and $header != null and $header != 'null'){
                $token  =  Helpers::Token($header);
                if($token){
                    $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                    if($client){
                        $z = 1;
                        $search_products = $search_products->leftJoin('favorites as f', function($join) use ($client){
                                    $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$client->id)->whereNull('f.deleted_at'); 
                                })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                    }else{
                        $search_products = $search_products->selectRaw(\DB::raw('0 AS is_favorites'));
                    }
                }else{
                    $search_products = $search_products->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }
        
       
            if($title){
                $search_products = $search_products->where('products.title','Like','%' .  $title . '%');
            }
            if($category_id){
                $search_products = $search_products->where('products.category_id',$category_id);
            }
            if($city_id){
                $search_products = $search_products->where('products.city_id',$city_id);
            }
            if($from_price){
                $search_products = $search_products->where('products.price','>=',$from_price);
            }
            if($to_price){
                $search_products = $search_products->where('products.price','<=',$to_price);
            }

            $search_products = $search_products->orderby('products.id','desc')->paginate(self::$data['page']);
            $count = count($search_products);
            $data['products'] = $search_products;
            $data['count'] = $count;
        }

        


        if($w == 0 and $category_id == ''){
            $x = array();
            $x['type'] = 1;
            $x['id'] = null;
            $x['title'] = 'Slider';
            $x['slider'] = $slider;
            $x['category'] = null;
            $x['products'] = null;
            array_push($data, $x);
        }
        
        if($w == 0 and $category_id == ''){
            $x = array();
            $x['type'] = 2;
            $x['id'] = null;
            $x['title'] = trans('lang.category');
            $x['slider'] = null;
            $x['category'] = $category;
            $x['products'] = null;
            array_push($data, $x);
        }

        if($z == 1 and $category_id == '' and $w==0){
            $x = array();
            $x['type'] = 3;
            $x['id'] = null;
            $x['title'] = trans('lang.my_products');
            $x['slider'] = null;
            $x['category'] = null;
            if($z == 1){
                $x['products'] = $products;
            }else{
                $x['products'] = null;
            }
            array_push($data, $x);
        }

        if($category_id == '' and $w == 0){
            $x = array();
            $x['type'] = 4;
            $x['id'] = 1000;
            $x['title'] = trans('lang.more_visit');
            $x['slider'] = null;
            $x['category'] = null;
            $x['products'] = $more_visit;
            array_push($data, $x);
        }else{
            if($category_id == 1000){
                $data['products'] = $more_visit;
            }
        }

        if($category_id == '' and $w == 0){
            $x = array();
            $x['type'] = 4;
            $x['id'] = 1001;
            $x['title'] = trans('lang.recently_added');
            $x['slider'] = null;
            $x['category'] = null;
            $x['products'] = $last_added;
            array_push($data, $x);
        }else{
            if($category_id == 1001){
                $data['products'] = $last_added;
            }
        }

        if($category_id == '' and $w == 0){
            $x = array();
            $x['type'] = 4;
            $x['id'] = 1002;
            $x['title'] = trans('lang.certificated_products');
            $x['slider'] = null;
            $x['category'] = null;
            $x['products'] = $certificated_products;
            array_push($data, $x);
        }else{
            if($category_id == 1002){
                $data['products'] = $certificated_products;
            }
        }

        $data = collect($data);
        $last_array = array();
        foreach($orders as $o){
            if($o->type == 1){
                foreach($slider->where('id',$o->reference_id) as $s){
                    $images = Slider::leftJoin('system_constants as s', function($join) {
                        $join->on('s.value', '=', 'slider.reference_id')->where('slider.type',3)->where('s.type','category')->whereNull('s.deleted_at'); 
                    })->leftJoin('products as p', function($join) {
                        $join->on('p.id', '=', 'slider.reference_id')->where('slider.type',2)->whereNull('p.deleted_at'); 
                    })->where('slider.parent_id',$s->id)->where('slider.status',1)->orderBy('slider.id','desc')->take(self::$data['page'])
                    ->select('slider.id','slider.type','slider.url','slider.reference_id','slider.image');
                    $images = $images->selectRaw("CASE
                                                    WHEN slider.type = 3 THEN s.name_$lang
                                                    WHEN slider.type = 2 THEN p.title
                                                    ELSE null
                                            END  as title");
                    $images = $images->get();
                    $img_arr = array();
                    $img_arr['type'] = 1;
                    $img_arr['id'] = null;
                    $img_arr['title'] = 'Slider';
                    $img_arr['slider'] = $images;
                    $img_arr['category'] = null;
                    $img_arr['products'] = null;
                    array_push($last_array, $img_arr);
                }
            }
            if($o->type == 2){
                foreach($data->where('type',2) as $s){
                    array_push($last_array, $s);
                }
            }
            if($o->type == 3){
                foreach($data->where('type',3) as $s){
                    array_push($last_array, $s);
                }
            }
            if($o->type == 4){
                foreach($data->where('type',4)->where('id',$o->reference_id) as $s){
                    array_push($last_array, $s);
                }
            }
        }
        
        return response()->json(['status' => true , 'message' => '', 'data'=> $last_array ],200);  
    }

}