<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Zones;
use App\Http\Helpers\Helpers;
use App\Models\Clients;
use App\Models\Addresses;

class AddressController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request){
        $header =  $request->header('Authorization');
        $lang =  $request->header('lang');
        $token  =  Helpers::Token($header);
        $client =  Clients::where('id',$token->tokenable_id)->first();
        if($client){
           $data['addresses'] = Addresses::leftJoin('clients as c', function($join) {
                                    $join->on('c.id', '=', 'addresses.client_id')->whereNull('c.deleted_at');
                                })->leftJoin('zones as z', function($join) {
                                    $join->on('z.id', '=', 'addresses.city_id')->whereNull('z.deleted_at');
                                })->where('client_id',$client->id)->get(['addresses.id',"z.name_$lang as city_name",'addresses.city_id','addresses.area','addresses.street',
                                        'addresses.lat','addresses.lon','addresses.home_no','addresses.client_id','c.name as client_name']);
           return response()->json(['status' => true , 'data' => $data],200);

        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422);
        }
    }

    public function getAddress(Request $request){
        $id = $request->get('id');
        $header =  $request->header('Authorization');
        $lang =  $request->header('lang');
        $token  =  Helpers::Token($header);
        $client =  Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $data['addresses'] = Addresses::where('client_id',$client->id)->where('id',$id)->first(['id','city','area','street','lat','lon','home_no','client_id']);
            if( $data['addresses']){
                return response()->json(['status' => true , 'data' => $data],200);
            }else{
                return response()->json(['status' => false , 'message' => trans('lang.no_data')],422); 
            }
        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422);
        }
    }

    public function add(Request $request){
        $header =  $request->header('Authorization');
        $lang =  $request->header('lang');
        $token  =  Helpers::Token($header);
        $city = $request->get('city');
        $area = $request->get('area');
        $street = $request->get('street');
        $home_no = $request->get('home_no');
        $lon = $request->get('lon');
        $lat = $request->get('lat');
        $client =  Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $rules = [
                'city' => 'required',
                'area' => 'required',
                'street' => 'required',
                'home_no' => 'required',
            ];

            $messages = [
                'city.required' => trans('lang.city_required'),
                'area.required' => trans('lang.area_required'),
                'street.required' => trans('lang.street_required'),
                'home_no.required' =>  trans('lang.home_no_required'),
            ];

            $validator = \Validator::make([
                'city' => $city,
                'area' => $area,
                'street' => $street,
                'home_no' => $home_no,
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

            $a = new Addresses();
            $a->city_id = $city;
            $a->area = $area;
            $a->street = $street;
            $a->home_no = $home_no;
            $a->lon = $lon;
            $a->lat = $lat;
            $a->client_id = $client->id;
            $saved = $a->save();
            if(!$saved){
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }
            $z = Zones::where('status',1)->whereNull('parent_id')->Where('id',$city)->first("name_$lang as name");
            $a['clinet_name'] = $client->name;
            $a['city_name'] = $z->name;
            return response()->json(['status' => true ,'data' => $a, 'message' => trans('lang.success')],200);

        }else{
            return response()->json(['status' => false , 'message' => trans('lang.error')],422);
        }
    }

    public function update(Request $request){
        $header =  $request->header('Authorization');
        $lang =  $request->header('lang');
        $token  =  Helpers::Token($header);
        $city = $request->get('city');
        $area = $request->get('area');
        $street = $request->get('street');
        $home_no = $request->get('home_no');
        $lon = $request->get('lon');
        $lat = $request->get('lat');
        $id = $request->get('id');
        $client =  Clients::where('id',$token->tokenable_id)->first();
        if($client){
            $a = Addresses::where('client_id',$client->id)->where('id',$id)->first(['id','city','area','street','lat','lon','home_no','client_id']);
            if(!$a){
                return response()->json(['status' => false , 'message' => trans('lang.no_data')],422);
            }
            $rules = [
                'city' => 'required',
                'area' => 'required',
                'street' => 'required',
                'home_no' => 'required',
            ];

            $messages = [
                'city.required' => trans('lang.city_required'),
                'area.required' => trans('lang.area_required'),
                'street.required' => trans('lang.street_required'),
                'home_no.required' =>  trans('lang.home_no_required'),
            ];

            $validator = \Validator::make([
                'city' => $city,
                'area' => $area,
                'street' => $street,
                'home_no' => $home_no,
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

            $a->city = $city;
            $a->area = $area;
            $a->street = $street;
            $a->home_no = $home_no;
            $a->lon = $lon;
            $a->lat = $lat;
            $saved = $a->save();
            if(!$saved){
                return response()->json(['status' => false , 'message' => trans('lang.error')],422); 
            }
            $z = Zones::where('status',1)->whereNull('parent_id')->Where('id',$city)->first("name_$lang as name");
            $a['clinet_name'] = $client->name;
            $a['city_name'] = $z->name;
            return response()->json(['status' => true ,'data' => $a, 'message' => trans('lang.success')],200);

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
            $a = Addresses::where('id',$id)->where('client_id',$client->id)->first();
            if($a){
            \DB::beginTransaction();
            try {
             
                $deleted = $a->delete();
                if(!$deleted){
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
}