<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Favorites;
use App\Models\TripImages;
use App\Models\Products;
use App\Models\DateTrip;
use App\Models\Clients;
use App\Models\Terms;
use App\Models\TripTerms;

class FavoritesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index(Request $request){
        $lang   =  \App::getLocale();
        $header =  $request->header('Authorization');
        $lang =  $request->header('lang');
        $token  =  Helpers::Token($header);
        $client =  Clients::where('id',$token->tokenable_id)->first();
        $type = $request->get('type');
        if($client){
            if($type == 1){
               
            }elseif($type == 2){
                $fav =  Favorites::leftJoin('products', function($join) {
                    $join->on('favorites.favorite_id', '=', 'products.id')->whereNull('products.deleted_at'); 
                })->leftJoin('clients as cl', function($join) {
                    $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
                })->leftJoin('system_constants as s', function($join) {
                    $join->on('s.value', '=', 'products.category_id')->Where('s.type','category')->whereNull('s.deleted_at'); 
                })->leftJoin('system_constants as sys', function($join) {
                    $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
                })->where('favorites.type',2)->where('favorites.client_id',$client->id)->orderBy('favorites.id','desc')
                ->select('products.id','products.title','products.image as image','products.price','products.created_at as date'
                    ,'products.category_id','cl.name',"s.name_$lang as category_name",'products.currency_id',"sys.name_$lang as currency_name");
            }

            $fav = $fav->paginate(self::$data['page']);  
            return response()->json(['status' => true , 'data' => $fav],200); 
            // $party_users = $party_users->paginate(self::$data['page']); 
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

    public function AddFavorite(Request $request){
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $favorite_id = $request->get('favorite_id');
            $action = $request->get('action');
            $type = $request->get('type');
            if($favorite_id){
               
            \DB::beginTransaction();
            try {
                if($action == 'add'){
                    $favorites = Favorites::where('favorite_id',$favorite_id)->where('type',$type)->where('client_id',$client->id)->first();
                    if($favorites){
                        return response()->json(['status' => false , 'message' => trans('lang.already_exist')],422);  
                    }
                    $favorites = new Favorites();
                    $favorites->client_id =  $client->id;
                    $favorites->favorite_id =  $favorite_id;
                    $favorites->date =  date('Y-m-d');
                    $favorites->type =  $type;
                    $saved = $favorites->save();
                }else{
                    $favorites = Favorites::where('favorite_id',$favorite_id)->where('type',$type)->where('client_id',$client->id)->first();
                    if($favorites){
                        $favorites->delete();
                        $client->save();
                    }else{
                        return response()->json(['status' => false , 'message' => trans('lang.no_data')],422);  
                    }
                  
                }
             
            \DB::commit();
            return response()->json(['status' => true, 'message' => trans('lang.success')],200);

            } catch (\Exception $e) {
                \DB::rollback();
            }
                return response()->json(['status' => false , 'message' => trans('lang.error')],422);  
            }else{
                return response()->json(['status' => false , 'message' => 'الرجاء تحديد العنصر المفضل']); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }
}