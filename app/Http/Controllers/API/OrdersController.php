<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Addresses;
use App\Models\Company;
use App\Models\CompanyPrice;
use App\Models\OrderLogs;
use App\Models\Clients;
use App\Models\OrderDetails;
use App\Models\BanksTransfer;

class OrdersController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $lang = \App::getLocale();
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $page = $request->get('page') - 1;
        
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $data['orders'] =  Orders::leftJoin('system_constants as s', function($join) {
                                    $join->on('s.value', '=', 'orders.currency_id')->where('s.type','currency')->whereNull('s.deleted_at'); 
                                })->leftJoin('order_details as od', function($join) {
                                    $join->on('od.order_id', '=', 'orders.id')->whereNull('od.deleted_at')->where('od.type',1); 
                                })->leftJoin('products as p', function($join) {
                                    $join->on('p.id', '=', 'od.product_id')->where('od.type',1)->whereNull('p.deleted_at'); 
                                })->leftJoin('system_constants as sy', function($join) {
                                    $join->on('sy.value', '=', 'orders.status')->where('sy.type','order_status')->whereNull('sy.deleted_at'); 
                                })->where('orders.client_id',$client->id)->orderBy('orders.id','desc')
                                ->select('orders.id',"orders.order_no",'orders.price',"orders.date",'orders.status'
                                        ,"sy.name_$lang as order_status","s.name_$lang as currency",'p.title as product_title','p.image')
                                        ->where('orders.client_id',$client->id)->WhereNotIn('orders.status',[4,5,6])
                                        ->offset($page*parent::$data['page'])->take(parent::$data['page'])->get();

            $data['archived'] =  Orders::leftJoin('system_constants as s', function($join) {
                                            $join->on('s.value', '=', 'orders.currency_id')->where('s.type','currency')->whereNull('s.deleted_at'); 
                                        })->leftJoin('order_details as od', function($join) {
                                            $join->on('od.order_id', '=', 'orders.id')->whereNull('od.deleted_at')->where('od.type',1);  
                                        })->leftJoin('products as p', function($join) {
                                            $join->on('p.id', '=', 'od.product_id')->where('od.type',1)->whereNull('p.deleted_at'); 
                                        })->leftJoin('system_constants as sy', function($join) {
                                            $join->on('sy.value', '=', 'orders.status')->where('sy.type','order_status')->whereNull('sy.deleted_at'); 
                                        })->where('orders.client_id',$client->id)->orderBy('orders.id','desc')
                                        ->select('orders.id',"orders.order_no",'orders.price',"orders.date",'orders.status'
                                                ,"sy.name_$lang as order_status","s.name_$lang as currency",'p.title as product_title','p.image')
                                                ->where('orders.client_id',$client->id)->WhereNotIn('orders.status',[1,2,3])
                                                ->offset($page*parent::$data['page'])->take(parent::$data['page'])->get();
                                
                                return response()->json(['status' => true , 'message' => '','data'=>$data],200); 
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
      
    }

  

    public function add(Request $request){
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $product_id = $request->get('product_id');
            $price = $request->get('price');
            // $delivery_price = $request->get('delivery_price');
            $address_id = $request->get('address_id');
            $company_id = $request->get('company_id');
            $payment_type = $request->get('payment_type');
            

            $name = $request->get('name');
            $account_no_from = $request->get('account_no_from');
            $account_no_to = $request->get('account_no_to');
            $bank_id = $request->get('bank_id');
            $file = $request->file('file');
            $delivery = $request->get('delivery');
            $delivery_price = $request->get('delivery_price');
                // $city = $request->get('city');
            // $port = $request->get('port');
            // $notes = $request->get('notes');
            // $services = $request->get('services');
            // // $service2 = $request->get('service2');
            // $from_price = $request->get('from_price');
            // $to_price = $request->get('to_price');


            $rules = [
                'product_id' => 'required',
                'price' => 'required',
                'address_id' => 'required',
                // 'company_id' => 'required',
                'payment_type' => 'required',
                'delivery' => 'required',
                // 'delivery_price' => 'required',
            ];
    
            $messages = [
                'product_id.required' => trans('lang.product_required'),
                'price.required' => trans('lang.price_required'),
                'address_id.required' => trans('lang.address_required'),
                // 'company_id.required' => trans('lang.company_required'),
                'payment_type.required' => trans('lang.payment_type_required'),
                'delivery.required' => trans('lang.delivery_required'),
                // 'delivery_price.required' => trans('lang.delivery_price_required'),
            ];
    
            $validator = \Validator::make([
                'product_id' => $product_id,
                'price' => $price,
                'address_id' => $address_id,
                'delivery' => $delivery,
                'payment_type' => $payment_type,
                // 'delivery_price' => $delivery_price,
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

            if($delivery == 2){
                if($company_id == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.company_required'),'data'=>''],422); 
                }
                if($delivery_price == ''){
                    return response()->json(['status' => false , 'message' => trans('lang.delivery_price_required'),'data'=>''],422); 
                }
            }else{
                $delivery_price = 0;
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
            
            \DB::beginTransaction();
            try {

                    $p = Products::where('id',$product_id)->first();
                    if(!$p){
                        return response()->json(['status' => false , 'message' => trans('lang.product_not_found'),'data'=>''],422);  
                    }
                    $p->status = 3;
                    $saved = $p->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

                    $order_no = Orders::getNextOrderNo();
                    $order = new Orders();
                    // $order->product_id = $product_id;
                    $order->price = $price + $delivery_price;
                    $order->address_id = $address_id;
                    $order->company_id = $company_id;
                    $order->payment_type = $payment_type;
                    $order->status = 1;
                    $order->delivery = $delivery;
                    $order->order_no = $order_no;
                    $order->client_id = $client->id;
                    $order->date = date('Y-m-d');
                    $saved = $order->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

                    $d = new OrderDetails();
                    $d->order_id = $order->id;
                    $d->product_id = $product_id;
                    $d->type = 1;
                    $d->price = $price;
                    $saved = $d->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

                    if($delivery_price != 0){
                        $d = new OrderDetails();
                        $d->order_id = $order->id;
                        $d->product_id = -1;
                        $d->type = 2;
                        $d->price = $delivery_price;
                        $saved = $d->save();
                        if(!$saved){
                            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                        }
                    }


                    $s = new OrderLogs();
                    $s->order_id = $order->id;
                    $s->status = 1;
                    $s->client_id = $client->id;
                    $s->date = date('Y-m-d');
                    $saved = $s->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }

                    $b = new BanksTransfer();
                    $b->order_id = $order->id;
                    $b->total_price = $price;
                    $b->date = date('Y-m-d');
                    $b->client_id = $client->id;
                    $b->action_source = 1;
                    $b->payment_type = $payment_type;
                    if($payment_type == 2){
                        $image = '';
                        if($request->hasFile('file') && $file->isValid())
                        {
                            $image = $order->id.\Str::random(8). '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('uploads'), $image);
                            $b->image = $image;
                        }
                        $b->name = $name;
                        $b->account_no_from = $account_no_from;
                        $b->account_no_to = $account_no_to;
                        $b->bank_id = $bank_id;
                    }
                    $saved = $b->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
                    }
                \DB::commit();
                $txt = trans('lang.success').' '.trans('lang.order_no').' '.$order_no;
                return response()->json(['status' => true,'data'=> $order_no, 'message' =>$txt],200);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }

    }


    // public function update(Request $request){
    //     $lang = \App::getLocale();
    //     $header = $request->header('Authorization');
    //     $token  =  Helpers::Token($header);
    //     $client = Clients::where('id',$token->tokenable_id)->first();
    //     if($client){
    //         $category = $request->get('category');
    //         $zone = $request->get('zone');
    //         $city = $request->get('city');
    //         $port = $request->get('port');
    //         $notes = $request->get('notes');
    //         // $service1 = $request->get('service1');
    //         // $service2 = $request->get('service2');
    //         $services = $request->get('services');
    //         $from_price = $request->get('from_price');
    //         $order_id = $request->get('order_id');
    //         $to_price = $request->get('to_price');
    //         $delivery = $request->get('delivery');

    //         $order = Orders::where('id',$order_id)->where('client_id',$client->id)->first();
    //         if($order == ''){
    //             return response()->json(['status' => false , 'message' => trans('lang.error')]); 
    //         }

    //         // $service = $service1.','.$service2;
    //         $rules = [
    //             'category' => 'required',
    //             'zone' => 'required',
    //             'city' => 'required',
    //             'port' => 'required',
    //             // 'service' => 'required',
    //             'from_price' => 'required',
    //             'to_price' => 'required',
    //             'delivery' => 'required',
    //         ];
    
    //         $messages = [
    //             'category.required' => trans('lang.category_required'),
    //             'zone.required' => trans('lang.zone_required'),
    //             'city.required' => trans('lang.city_required'),
    //             'port.required' => trans('lang.port_required'),
    //             // 'service.required' => trans('lang.service_required'),
    //             'from_price.required' => trans('lang.from_price_required'),
    //             'to_price.required' => trans('lang.to_price_required'),
    //             'delivery.required' => trans('lang.delivery_required'),
    //         ];
    
    //         $validator = \Validator::make([
    //             'category' => $category,
    //             'zone' => $zone,
    //             'city' => $city,
    //             'port' => $port,
    //             // 'service' => $service,
    //             'from_price' => $from_price,
    //             'to_price' => $to_price,
    //         ],
    //             $rules
    //             ,
    //             $messages
    //         );
    
    //         if ($validator->fails()) {
    //             $all = collect($validator->errors()->getMessages())->map(function($item){
    //                 return $item[0];
    //               });
    //               $strs = [];
    //               foreach ($all as $value) {
    //                   $strs[]=  $value;
    //               }
    //             return response()->json(['status' => false , 'message' =>  implode(',',$strs), 'data'=>'']);
    //         }
            
    //         \DB::beginTransaction();
    //         try {
    //                 $order->zone_id = $zone;
    //                 $order->category_id = $category;
    //                 $order->port_id = $port;
    //                 $order->city_id = $city;
    //                 $order->service_id = $services;
    //                 $order->notes = $notes;
    //                 $order->price_from = $from_price;
    //                 $order->status = 0;
    //                 $order->price_to = $to_price;
    //                 $saved = $order->save();
    //             \DB::commit();

    //             $data['orders'] =  Orders::leftJoin('zones as z', function($join) {
    //                 $join->on('orders.zone_id', '=', 'z.id')->whereNull('z.deleted_at')->whereNull('z.parent_id');
    //             })->leftJoin('zones as zo', function($join) {
    //                 $join->on('orders.city_id', '=', 'zo.id')->whereNull('zo.deleted_at')->whereNotNull('zo.parent_id');
    //             })->where('client_id',$client->id)->orderBy('id','desc')->select('orders.id',"z.name_$lang as zone","zo.name_$lang as city",
    //             'price_from','price_to',"orders.created_at as date",'service_id')->where('orders.id',$order->id)->first();

    //             return response()->json(['status' => true, 'message' => trans('lang.success') ,'data'=>$data['orders']]);
    //         } catch (\Exception $e) {
    //             \DB::rollback();
    //         }
    //         return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>'']);  
            

    //     }else{
    //         return response()->json(['status' => false , 'message' => trans('lang.error')]); 
    //     }

    // }


    public function delete(Request $request){
        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $order_id = $request->get('order_id');
            if($order_id){
                $order = Orders::where('id',$order_id)->where('client_id',$client->id)->first();
                if($order){
                    $deleted = $order->delete();
                    if($deleted){
                        return response()->json(['status' => true, 'message' => trans('lang.success')]);
                    }else{
                        return response()->json(['status' => false , 'message' => trans('lang.error')]); 
                    }
                }else{
                    return response()->json(['status' => false , 'message' => trans('lang.error')]); 
                }
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.orders_required')]); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')]); 
        }
    }

    public function getOrder(Request $request){
        $lang = \App::getLocale();
        $header = $request->header('Authorization');
        $id = $request->get('id');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $data['orders'] =  Orders::leftJoin('system_constants as s', function($join) {
                                    $join->on('s.value', '=', 'orders.currency_id')->where('s.type','currency')->whereNull('s.deleted_at'); 
                                })->leftJoin('system_constants as sys', function($join) {
                                    $join->on('sys.value', '=', 'orders.delivery')->where('sys.type','delivery')->whereNull('sys.deleted_at'); 
                                })->leftJoin('system_constants as syst', function($join) {
                                    $join->on('syst.value', '=', 'orders.payment_type')->where('syst.type','payment_type')->whereNull('syst.deleted_at'); 
                                })->leftJoin('order_details as od', function($join) {
                                    $join->on('od.order_id', '=', 'orders.id')->whereNull('od.deleted_at'); 
                                })->leftJoin('products as p', function($join) {
                                    $join->on('p.id', '=', 'od.product_id')->where('od.type',1)->whereNull('p.deleted_at'); 
                                })->leftJoin('system_constants as sy', function($join) {
                                    $join->on('sy.value', '=', 'orders.status')->where('sy.type','order_status')->whereNull('sy.deleted_at'); 
                                })->orderBy('orders.id','desc')
                                ->where('orders.client_id',$client->id)
                                ->where('orders.id',$id)->with(['log','log.status_data','company','address','address.city'])
                                ->first(['orders.id',"orders.order_no",'orders.price','orders.company_id',"syst.name_$lang as payment_name",'orders.address_id',"orders.date",'orders.status','orders.payment_type'
                                        ,"sy.name_$lang as order_status","s.name_$lang as currency","sys.name_$lang as type_delivery",'p.title as product_title','p.image']);
                                        
                                
                                return response()->json(['status' => true , 'message' => '','data'=>$data['orders']],200); 
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
        }
    }

    public function delivery_price(Request $request){
        $company_id = $request->get('company_id');
        $address_id = $request->get('address_id');
        $product_id = $request->get('product_id');

        $header = $request->header('Authorization');
        $token  =  Helpers::Token($header);
        $client = Clients::where('id',$token->tokenable_id)->first();

        $p = Products::where('id',$product_id)->first();
        if(!$p){
            return response()->json(['status' => false , 'message' => trans('lang.product_not_found')],422); 
        }

        $a = Addresses::where('id',$address_id)->where('client_id',$client->id)->first();
        if(!$a){
            return response()->json(['status' => false , 'message' => trans('lang.address_not_found')],422);
        }

        $c = CompanyPrice::where('company_id',$company_id)->where('city_id',$a->city_id)->where(function ($q) use ($p) {
                $q->where('from', '<=', $p->price);
                $q->where('to', '>=', $p->price);
            })->first();
            
        if($c){
            if($c->type == 'fixed'){
                $delivery_price = $c->price;
            }else{
                $delivery_price = $p->price * $c->price;
            }
            return response()->json(['status' => true , 'message' => '','data'=>$delivery_price],200); 
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.city_no_listed')],422);
        }
    }
}