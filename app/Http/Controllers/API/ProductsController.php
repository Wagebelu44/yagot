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

class ProductsController extends BaseController
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
        $order = $request->get('order');
        $lang =  $request->header('lang');
        $from_price = $request->get('from_price');
        $to_price = $request->get('to_price');

        if($order == '' or $order == 1){
            $order = 'desc';
        }else{
            $order = 'asc';
        }

        $slider = Slider::leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'slider.reference_id')->where('slider.type',3)->where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('products as p', function($join) {
            $join->on('p.id', '=', 'slider.reference_id')->where('slider.type',2)->whereNull('p.deleted_at'); 
        })->where('slider.status',1)->orderBy('slider.id','desc')->take(self::$data['page'])
       
        ->select('slider.id','slider.type','slider.url','slider.reference_id','slider.image');
        $slider = $slider->selectRaw("CASE
                                        WHEN slider.type = 3 THEN s.name_$lang
                                        WHEN slider.type = 2 THEN p.title
                                        ELSE null
                                END  as title");
        $slider = $slider->get();

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
            $products = $products->orderby('products.order','desc')->orderby('products.id','desc')->orderBy('price',$order)->paginate(self::$data['page']);
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

        if($title){
            $more_visit = $more_visit->where('products.title','Like','%' .  $title . '%');
        }
        if($city_id){
            $more_visit = $more_visit->where('products.city_id',$city_id);
        }

        if($from_price){
            $more_visit = $more_visit->where('products.price','>=',$from_price);
        }

        if($to_price){
            $more_visit = $more_visit->where('products.price','<=',$to_price);
        }

        $more_visit = $more_visit->orderby('products.view_no','desc')->orderby('products.order','desc')->paginate(self::$data['page']);

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
        if($header){
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

        if($title){
            $certificated_products = $certificated_products->where('products.title','Like','%' .  $title . '%');
        }
        if($city_id){
            $certificated_products = $certificated_products->where('products.city_id',$city_id);
        }

        if($from_price){
            $certificated_products = $certificated_products->where('products.price','>=',$from_price);
        }

        if($to_price){
            $certificated_products = $certificated_products->where('products.price','<=',$to_price);
        }

        $certificated_products = $certificated_products->orderby('products.order','desc')->orderby('products.id','desc')->orderBy('price',$order)->paginate(self::$data['page']);
    
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

        if($title){
            $last_added = $last_added->where('products.title','Like','%' .  $title . '%');
        }
        if($city_id){
            $last_added = $last_added->where('products.city_id',$city_id);
        }

        if($from_price){
            $last_added = $last_added->where('products.price','>=',$from_price);
        }

        if($to_price){
            $last_added = $last_added->where('products.price','<=',$to_price);
        }

        $last_added = $last_added->orderby('products.id','desc')->orderby('products.order','desc')->orderBy('price',$order)->paginate(self::$data['page']);

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

            if($category_id){
                $search_products = $search_products->orderby('products.id','desc')->orderBy('price',$order)->paginate(self::$data['page']);
            }else{
                $search_products = $search_products->orderby('products.id','desc')->orderBy('price',$order)->paginate(self::$data['page']);
                $count = count($search_products);
                $data['count'] = $count;
            }
            $data['products'] = $search_products;
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

        return response()->json(['status' => true , 'message' => '', 'data'=> $data ],200);  
    }

    public function getProduct(Request $request){
        $lang =  $request->header('lang');
        $id = $request->get('id');
        $p = Products::leftJoin('clients as cl', function($join) {
            $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
        })->leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'products.category_id')->where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('system_constants as sy', function($join) {
            $join->on('sy.value', '=', 'cl.type')->where('sy.type','type')->whereNull('sy.deleted_at'); 
        })->leftJoin('system_constants as sys', function($join) {
            $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
        })->leftJoin('zones as z', function($join) {
            $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
        })->with('images')->with('certified_images')
            ->select('products.id',"products.title",'products.details','cl.country_code','cl.mobile','products.category_id',
                        'products.image as image',"products.created_at as date",'products.price','products.currency_id','products.city_id'
                        ,'cl.name as client_name','cl.type',"sy.name_$lang as client_type","sys.name_$lang as currency_name",
                        \DB::raw('CONCAT(cl.country_code,cl.mobile) AS full_mobile'),"s.name_$lang as category_name",
                        'cl.id as client_id','products.notes','cl.image as image_clinet',"z.name_$lang as city_name",'products.view_no');
                        
        $header =  $request->header('Authorization');
        if($header){
            $token  =  Helpers::Token($header);
            if($token){
                $clients =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                if($clients){
                    $p = $p->leftJoin('favorites as f', function($join) use ($clients){
                                $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$clients->id)->whereNull('f.deleted_at'); 
                            })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                }else{
                    $p = $p->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }else{
                $p = $p->selectRaw(\DB::raw('0 AS is_favorites'));
            }
        }

        $p = $p->where('products.id',$id)->first();
        if($p){
          if($p['client_id']){
              $client['id'] = $p['client_id'];
              unset($p["client_id"]); 
          }
          if($p['client_name']){
              $client['name'] = $p['client_name'];
          }
      
          if($p['mobile']){
              $client['full_mobile'] = $p['full_mobile'];
              $client['mobile'] = $p['mobile'];
              $client['country_code'] = $p['country_code'];
              unset($p["mobile"]); 
              unset($p["full_mobile"]);
          }else{
            unset($p["full_mobile"]); 
            unset($p["country_code"]); 
            unset($p["mobile"]);
          }

        if($p['image_clinet']){
            $client['image'] = \URL::to('/').'/uploads/'.$p['image_clinet'];
            unset($p["image_clinet"]); 
        }else{
            $client['image'] = \URL::to('/').'site/assets/images/user.png';
            unset($p["image_clinet"]);   
        }

        if($p['type']){
            $client['type'] = $p['type'];
            unset($p["type"]); 
        }else{
             unset($p["type"]); 
        }

        if($p['client_type']){
            $client['client_type'] = $p['client_type'];
            unset($p["client_type"]); 
        }else{
             unset($p["client_type"]); 
        }


        $others = Products::leftJoin('clients as cl', function($join) {
            $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
        })->leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('system_constants as sys', function($join) {
            $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
        })->leftJoin('zones as z', function($join) {
            $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
        })->where('products.status',1)
        ->select('products.id','products.title','products.image as image','products.price','products.city_id','products.created_at as date','products.currency_id'
                ,'products.category_id','cl.name',"s.name_$lang as category_name","sys.name_$lang as currency_name","z.name_$lang as city_name");

        $header =  $request->header('Authorization');
        if($header){
            $token  =  Helpers::Token($header);
            if($token){
                $clients =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
                if($clients){
                    $others = $others->leftJoin('favorites as f', function($join) use ($clients){
                                $join->on('f.favorite_id', '=', 'products.id')->where('f.type',2)->where('f.client_id',$clients->id)->whereNull('f.deleted_at'); 
                            })->selectRaw(\DB::raw('(CASE WHEN f.id IS NOT NULL  THEN 1 ELSE 0 END) AS is_favorites'));
                }else{
                    $others = $others->selectRaw(\DB::raw('0 AS is_favorites'));
                }
            }else{
                $others = $others->selectRaw(\DB::raw('0 AS is_favorites'));
            }
        }
        $others = $others->orderby('products.id','desc')->where('products.category_id',$p->category_id)->where('products.id','!=',$p->id)
                            ->inRandomOrder()->take(4)->get();

        $p->view_no = $p->view_no + 1;
        $p->save();
        unset($p["view_no"]); 
        $data['product_details'] = $p;
        $data['others'] = $others;
        $data['client'] = $client;
        return response()->json(['status' => true , 'message' => '', 'data'=> $data ],200);  

        }else{
            return response()->json(['status' => false , 'message' => trans('lang.no_data'), 'data'=> '' ],422);  
        }
    }


    public function addProduct(Request $request){

        $header =  $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
        if($client){

            if($client->type == 1){
                $p = Products::where('client_id',$client->id)->orderBy('id','desc')->first();
                if($p){
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d H:s:i'));
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $p->created_at);
                    $diff_in_hours = $to->diffInHours($from);
                    if($diff_in_hours < 24){
                        return response()->json(['status' => false , 'message' => trans('lang.cannot_added_product'), 'data'=> '' ],422);  
                    }
                }
            }

            if($client->type == 2){
                $now = date('Y-m-d H:i:s');
                if($client->start_subscription <= $now and $client->end_subscription >= $now){
                    $s = Subscriptions::where('id',$client->subscription_id)->first();
                    $count = Products::where('client_id',$client->id)->where('created_at','<=',$client->start_subscription)
                            ->where('created_at','>=',$client->end_subscription)->count();
                    if($count >= $s->number_products){
                        return response()->json(['status' => false , 'message' => trans('lang.cannot_added_product'), 'data'=> '' ],422); 
                    }
                }else{
                    return response()->json(['status' => false , 'message' => trans('lang.subscription_expired'), 'data'=> '' ],422); 
                }
            }

            $title = $request->get('title');
            $main_image = $request->file('main_image');
            $images = $request->file('images');
            $details = $request->get('details');
            $certified_images = $request->file('certified_images');
            $category_id = $request->get('category_id');
            $city_id = $request->get('city_id');
            $price = $request->get('price');
            $currency_id = $request->get('currency_id');
            $notes = $request->get('notes');
           
            $rules = [
                'title' => 'required',
                'details' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'city_id' => 'required',
                'main_image' => 'required|mimes:jpeg,jpg,png',
                'images.*' => 'nullable|mimes:jpeg,jpg,png',
                'certified_images.*' => 'nullable|mimes:jpeg,jpg,png',
            ];

            $messages = [
                'title.required' => trans('lang.title_required'),
                'details.required' =>  trans('lang.details_required'),
                'main_image.required' => trans('lang.image_required'),
                'price.required' => trans('lang.price_required'),
                'main_image.mimes' => trans('lang.image_format'),
                'images.*.mimes' => trans('lang.image_format'),
                'category_id.required' =>   trans('lang.category_required'),
                'city_id.required' =>   trans('lang.city_required'),
                'certified_images.*.mimes' => trans('lang.image_format'),
            ];

            $validator = \Validator::make([
                'title' => $title,
                'details' => $details,
                'main_image'=> $main_image,
                'category_id' => $category_id,
                'images' => $images,
                'price' => $price,
                'city_id' => $city_id,
                'certified_images' => $certified_images,
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

            if($main_image){
                if ($main_image->isValid())
                {
                    $main_image_file = 'main_image_' . \Str::random(8) . '.' . $main_image->getClientOriginalExtension();
                    $main_image->move(public_path('uploads'), $main_image_file);
                }
            }

            \DB::beginTransaction();
            try {
                $p = new Products();
                $p->client_id = $client->id;
                $p->title = $title;
                $p->details = $details;
                $p->category_id = $category_id;
                $p->currency_id = $currency_id;
                $p->city_id = $city_id;
                $p->price = $price;
                $p->notes = $notes;
                $p->image = $main_image_file;
                if($client->subscription_id){
                    $s_feature = SubscriptionFeatures::Where('subscription_id',$client->subscription_id)->where('feature_id',5)->first();
                    if($s_feature){
                        $p->order = 1;
                    }

                }
                $saved = $p->save();
                if(!$saved){
                    return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                }
               
               

                $p_attach = new ProductAttachments();
                $p_attach->product_id = $p->id;
                $p_attach->attachment = $main_image_file;
                $p_attach->type = 1;
                $p_attach->client_id =$client->id;
                $saved_img  = $p_attach->save();
                if(!$saved_img){
                    return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                }
                $i=0;

                if($images){
                    foreach($images as $image){
                        $i++;
                        $pic = '';
                        if ($image->isValid()){
                            $pic = 'pic_'.$i . \Str::random(8) . '.' . $image->getClientOriginalExtension();
                            $image->move(public_path('uploads'), $pic);
                            $p_attach = new ProductAttachments();
                            $p_attach->product_id = $p->id;
                            $p_attach->attachment = $pic;
                            $p_attach->type = 1;
                            $p_attach->client_id =$client->id;
                            $saved_img  = $p_attach->save();
                            if(!$saved_img){
                                return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                            }
                        }
                    }
                }

                
                if($certified_images){
                    foreach($certified_images as $c){
                        $i++;
                        $pic = '';
                        if ($c->isValid()){
                            $pic = 'pic_'.$i . \Str::random(8) . '.' . $c->getClientOriginalExtension();
                            $c->move(public_path('uploads'), $pic);
                            $p_attach = new ProductAttachments();
                            $p_attach->product_id = $p->id;
                            $p_attach->attachment = $pic;
                            $p_attach->type = 2;
                            $p_attach->client_id =$client->id;
                            $saved_img  = $p_attach->save();
                            if(!$saved_img){
                                return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                            }
                        }
                    }
                }

                \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success'),'data'=>$p->id],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }


    public function update(Request $request){
        $header =  $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
        if($client){

            $title = $request->get('title');
            $main_image = $request->file('main_image');
            $images = $request->file('images');
            $details = $request->get('details');
            $certified_images = $request->file('certified_images');
            $category_id = $request->get('category_id');
            $price = $request->get('price');
            $currency_id = $request->get('currency_id');
            $notes = $request->get('notes');
            $remove_image = $request->get('remove_image');
            if($remove_image){
                $remove_image = explode(',',$remove_image); 
            }
            $city_id = $request->get('city_id');
          

            $id = $request->get('id');
            $p = Products::where('id',$id)->where('client_id',$client->id)->first();
            if($p == ''){
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }

            $rules = [
                'title' => 'required',
                'details' => 'required',
                'city_id' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'main_image' => 'nullable|mimes:jpeg,jpg,png',
                'images.*' => 'nullable|mimes:jpeg,jpg,png',
                'certified_images.*' => 'nullable|mimes:jpeg,jpg,png',
                
            ];

            $messages = [
                'title.required' => trans('lang.title_required'),
                'details.required' =>  trans('lang.details_required'),
                'price.required' => trans('lang.price_required'),
                'main_image.mimes' => trans('lang.image_format'),
                'images.*.mimes' => trans('lang.image_format'),
                'category_id.required' =>   trans('lang.category_required'),
                'certified_images.*.mimes' => trans('lang.image_format'),
                'city_id.required' =>   trans('lang.city_required'),
            ];

            $validator = \Validator::make([
                'title' => $title,
                'details' => $details,
                'main_image'=> $main_image,
                'category_id' => $category_id,
                'images' => $images,
                'price' => $price,
                'certified_images' => $certified_images,
                'city_id' => $city_id,
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

         
            $main_image_file = '';
            if($main_image){
                if($main_image->isValid()){
                    $main_image_file = 'main_image_' . \Str::random(8) . '.' . $main_image->getClientOriginalExtension();
                    $main_image->move(public_path('uploads'), $main_image_file);
                }
            }

            \DB::beginTransaction();
            try {
                $p->client_id = $client->id;
                $p->title = $title;
                $p->details = $details;
                $p->category_id = $category_id;
                $p->currency_id = $currency_id;
                $p->price = $price;
                $p->notes = $notes;
                $p->city_id = $city_id;
                if($main_image_file){
                    $p->image = $main_image_file;
                }
                $saved = $p->save();
                if(!$saved){
                    return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                }


                if($main_image_file){
                    $old_main_image = ProductAttachments::where('product_id',$p->id)->where('type',1)->first();
                    if($old_main_image){
                        $old_main_image->delete();
                    }
                    $p_attach = new ProductAttachments();
                    $p_attach->product_id = $p->id;
                    $p_attach->attachment = $main_image_file;
                    $p_attach->type = 1;
                    $p_attach->client_id =$client->id;
                    $saved_img  = $p_attach->save();
                    if(!$saved_img){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }
                }

                if($remove_image){
                    foreach($remove_image as $removeImage){
                        $removable_images = ProductAttachments::where('id',$removeImage)->where('product_id',$p->id)->first();
                        if($removable_images){
                            $deleted_image = $removable_images->delete();
                        }
                    }
                }

                $i=0;

                if($images){
                    foreach($images as $image){
                        $i++;
                        $pic = '';
                        if ($image->isValid()){
                            $pic = 'pic_'.$i . \Str::random(8) . '.' . $image->getClientOriginalExtension();
                            $image->move(public_path('uploads'), $pic);
                            $p_attach = new ProductAttachments();
                            $p_attach->product_id = $p->id;
                            $p_attach->attachment = $pic;
                            $p_attach->type = 1;
                            $p_attach->client_id =$client->id;
                            $saved_img  = $p_attach->save();
                            if(!$saved_img){
                                return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                            }
                        }
                       
                    }
                }

                if($certified_images){
                    foreach($certified_images as $c){
                        $i++;
                        $pic = '';
                        if ($c->isValid()){
                            $pic = 'pic_'.$i . \Str::random(8) . '.' . $c->getClientOriginalExtension();
                            $c->move(public_path('uploads'), $pic);
                            $p_attach = new ProductAttachments();
                            $p_attach->product_id = $p->id;
                            $p_attach->attachment = $pic;
                            $p_attach->type = 2;
                            $p_attach->client_id =$client->id;
                            $saved_img  = $p_attach->save();
                            if(!$saved_img){
                                return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                            }
                        }
                      
                    }
                }


                \DB::commit();
                return response()->json(['status' => true, 'message' => trans('lang.success'),'data'=>$p->id],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  

        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 

        }

    }


    public function delete(Request $request){
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $id = $request->get('id');
            $p = Products::where('id',$id)->where('client_id',$client->id)->first();
            if($p){
            \DB::beginTransaction();
            try {
                $attachments = ProductAttachments::where('product_id',$id)->get();
                if($attachments){
                    foreach($attachments as $attachment){
                        $deleted = $attachment->delete();
                    }
                }
              
                $deleted = $p->delete();
                if($deleted){
                }else{
                    return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
                }
            \DB::commit();
            return response()->json(['status' => true, 'message' => trans('lang.success')],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.no_data')],422); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

   public function update_status(Request $request){
       $id = $request->get('id');
       $status = $request->get('status');

       $header =  $request->header('Authorization');
       $token  =  Helpers::Token($header);
       $client =  \App\Models\Clients::where('id',$token->tokenable_id)->first();
       if($client){
            $p = Products::where('id',$id)->first();
            if($p){
                $p->status = $status;
                $saved = $p->save();
                if(!$saved){
                    return response()->json(['status' => false , 'message' => trans('lang.no_data')],422); 
                }
                return response()->json(['status' => true, 'message' => trans('lang.success')],200);
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }
        
       }else{
           return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
       }


   }
}