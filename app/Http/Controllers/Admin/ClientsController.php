<?php

namespace App\Http\Controllers\Admin;

use App\Models\Clients as MyModel;
use App\Models\Clients;
use App\Models\Favorites;
use App\Models\Partners;
use App\Models\Party;
use App\Models\PartyPoet;
use App\Models\PoetType;
use App\Models\System_Constants;
use App\Models\Zones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientsController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        if(\Auth::user()->cant('clients')){
            return response('العملية ممنوعة');
        }
        $lang = \App::getLocale();
        $data['clients'] = MyModel::select("*");
        if($request->name){
            $data['clients'] = $data['clients']->where('name' ,'like' , '%' .  $request->name . '%');
        }
        if($request->email){
            $data['clients'] = $data['clients']->where('email','like','%'.$request->email.'%');
        }
        if($request->phone){
            $data['clients'] = $data['clients']->where('mobile' ,'like','%'.$request->phone.'%');
        }      
        if($request->zone){
            $data['clients'] =  $data['clients']->where('zone_id',$request->zone);
        }
        if($request->city){
            $data['clients'] =  $data['clients']->where('city_id',$request->city);
        }
        if($request->type_search){
            $data['clients'] =  $data['clients']->where('type',$request->type_search);
        }
        $data['clients'] =  $data['clients']->orderBy('clients.id','desc')->with('zone')->with('city')->paginate(15);
        $data['party_type'] = System_Constants::where('type', 'party_type')->get(["name_$lang as name",'value','type']);
        $data['country_code'] = System_Constants::where('type', 'country')->where('value',1)->get(["name_$lang as name",'value','value2','type']);
        $data['zones'] = Zones::where('status',1)->whereNull('parent_id')->orderBy('id','desc')->get(['id',"name_$lang as name"]);

        if ($request->ajax()) {
            return view('admin.clients.table-data', compact('data'))->render();
        }
        
         return view('admin.clients.index',compact('data'));
    }
  /***********************************************************************************************************************/
    public function add(Request $request){
       
        $hidden = $request->get('hidden');
        $fname = $request->get('fname');
        $mobile = $request->get('mobile');
        $zone_id = $request->get('zone_id');
        $password = $request->get('password');
        $cpassword = $request->get('cpassword');
        $country_code = $request->get('country_code');
        $email = $request->get('email');
        $image = $request->file('image');
        $type = $request->get('type');

        $passport = $request->file('passport');
        $identity = $request->file('identity');
        $commercial_photo = $request->file('commercial_photo');

        if($hidden == 0){
            $rules = [
                'fname' => 'required',
                'mobile' => ['required','unique:clients,mobile'],
                'zone_id' => 'required',
                'password' => 'required',
                'cpassword' => 'required',
                'type' => 'required',
                'country_code' => 'required',
            ];
            $messages = [
                'fname.required'=>'الاسم مطلوب',
                'mobile.required'=>'رقم الجوال مطلوب',
                'mobile.unique'=>'رقم الجوال مستخدم من قبل',
                'password.required'=>'كلمة المرور مطلوبة',
                'cpassword.required'=>'تاكيد كلمة المرور مطلوب',
                'zone_id.required'=>' المنطقه  مطلوب',
                'type.required'=>'نوع العميل  مطلوب',
                'country_code.required'=>'مقدمة الدولة  مطلوبة',
            ];
            $validator = \Validator::make([
                'fname' => $fname,
                'mobile' => $mobile,
                'password' => $password,
                'zone_id' => $zone_id,
                'cpassword' => $cpassword,
                'type' => $type,
                'country_code' => $country_code,
            ],
        
                $rules
                ,
                $messages
            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => $validator->messages()]);
            }
            if($password != $cpassword){
                return response()->json(['status' => false , 'data' => 'كلمة المرور غير متطابقة']);
            }
           
            $pic = '';
            if ($request->hasFile('image') && $image->isValid())
            {
                $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $pic);
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
            $client = new Clients();
            $client->name = $fname;
            $client->zone_id = $zone_id;
            $client->user_id = \Auth::user()->id;
            $client->mobile = $mobile;
            $client->country_code = $country_code;
            $client->email = $email;
            $client->type = $type;
            if($pic){
                $client->image =$pic ;
            }else{
                $client->image ='profile.png';
            }
            if($pass_pic){
                $client->passport =$pass_pic ;
            }
            if($identity_pic){
                $client->identity =$identity_pic ;
            }
            if($commercial_photo_pic){
                $client->commercial_photo =$commercial_photo_pic ;
            }
            $client->password = \Hash::make($password);
            $client->save();
           
            \DB::commit();
            return response()->json(['status' => true, 'data' =>' تمت العملية بنجاح']);
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return response()->json(['status' => false , 'data' => 'حدث خطأ في العملية ']);  
    

    }
          
}
/***********************************************************************************************************************/
    public function edit(Request $request){

        $id = $request->get('id');
            $item = MyModel::find($id);
            if($item != ''){
                $html ='';
                $html .= '<table class="table table-bordered" id="html_table" width="100%">';

                if($item->type == 1){
                $html .= '<tr class="m-datatable__row">
                                <td class="text-center" style="padding-top: 24px;font-weight: bold;">صورة الهوية</td>
                                <td class="text-center">';
                                if($item->identity){
                                    $html .=  '<a  data-fancybox="gallery" href ="'.$item->identity.'"  >
                                        <img src="'.$item->identity.'" width="50px" style="height:50px" alt="">
                                    </a>';
                                }
                $html .=  '</td></tr>';
                $html .= '<tr class="m-datatable__row">
                <td class="text-center" style="padding-top: 24px;font-weight: bold;">جواز السفر </td>
                <td class="text-center">';
                if($item->passport){
                    $html .=  '<a  data-fancybox="gallery" href ="'.$item->passport.'"  >
                        <img src="'.$item->passport.'" width="50px" style="height:50px" alt="">
                    </a>';
                }
                $html .=  '</td></tr>';}

                if($item->type == 2){
                $html .= '<tr class="m-datatable__row">
                <td class="text-center" style="padding-top: 24px;font-weight: bold;">السجل التجاري</td>
                <td class="text-center">';
                if($item->commercial_photo){
                    $html .=  '<a  data-fancybox="gallery" href ="'.$item->commercial_photo.'"  >
                        <img src="'.$item->commercial_photo.'" width="50px" style="height:50px" alt="">
                    </a>';
                }
                $html .=  '</td></tr>';
            }

                $html .= '</table>';
                return response()->json(['status' => true , 'data' => $item ,'html'=>$html]);
            }else{
                return response()->json(['status' => false , 'data' => 'حدث خطأ أثناء العملية']);
            }
    }


    /***********************************************************************************************************************/
    public function UpdateStats(Request $request){
        if(\Auth::user()->cant('change_status_clients')){
            return response()->json(['status'=>0,'data'=>'العملية ممنوعة']);
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
            if($item != ''){
                if($item->status == 0){
                    $item->status = 1;
                }else{
                    $item->status = 0;
                }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => 'حدث خطأ أثناء العملية']);
                }
                return response()->json(['status' => true , 'data' => 'تم تعديل الحالة']);
            }else{
                return response()->json(['status' => false , 'data' => 'حدث خطأ أثناء العملية']);
            }
    }
/***********************************************************************************************************************/
    public function update(Request $request){
        $hidden = $request->get('hidden');
        if($hidden != 0){

        $client = MyModel::find($hidden);
        if(!$client){
            return response()->json(['status' => false , 'data' => 'العضو غير موجود']);
        }
     
        $fname = $request->get('fname');
        $mobile = $request->get('mobile');
        $zone_id = $request->get('zone_id');
        $password = $request->get('password');
        $cpassword = $request->get('cpassword');
        $country_code = $request->get('country_code');
        $email = $request->get('email');
        $image = $request->file('image');
        $type = $request->get('type');
        
        $passport = $request->file('passport');
        $identity = $request->file('identity');
        $commercial_photo = $request->file('commercial_photo');

        $rules = [
            'fname' => 'required',
            'mobile' => ['required','unique:clients,mobile,'.$hidden],
            'zone_id' => 'required',
            'type' => 'required',
            'country_code' => 'required',
        ];
        $messages = [
            'fname.required'=>'الاسم مطلوب',
            'mobile.required'=>'رقم الجوال مطلوب',
            'mobile.unique'=>'رقم الجوال مستخدم من قبل',
            'zone_id.required'=>' المنطقه  مطلوب',
            'type.required'=>'نوع العميل  مطلوب',
            'country_code.required'=>'مقدمة الدولة  مطلوبة',
        ];
        $validator = \Validator::make([
            'fname' => $fname,
            'mobile' => $mobile,
            'zone_id' => $zone_id,
            'type' => $type,
            'country_code' => $country_code,
        ],
    
            $rules
            ,
            $messages
        );

        if ($validator->fails()) {
            return response()->json(['status' => false , 'data' => $validator->messages()]);
        }

        if($password != $cpassword){
            return response()->json(['status' => false , 'data' => 'كلمة المرور غير متطابقة']);
        }
       
        $pic = '';
        if ($request->hasFile('image') && $image->isValid())
        {
            $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $pic);
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
        $client->name = $fname;
        $client->zone_id = $zone_id;
        $client->mobile = $mobile;
        $client->country_code = $country_code;
        $client->email = $email;
        $client->type = $type;
        if($pic){
            $client->image =$pic ;
        }
        if($pass_pic){
            $client->passport =$pass_pic ;
        }
        if($identity_pic){
            $client->identity =$identity_pic ;
        }
        if($commercial_photo_pic){
            $client->commercial_photo =$commercial_photo_pic ;
        }
        if($password){
            $client->password = \Hash::make($password);
        }
        $client->save();
       
        \DB::commit();
        return response()->json(['status' => true, 'data' =>' تمت العملية بنجاح']);
    } catch (\Exception $e) {
        \DB::rollback();
    }
    return response()->json(['status' => false , 'data' => 'حدث خطأ في العملية ']);  
    

    }

        }
    public function delete(Request $request){
        if(\Auth::user()->cant('delete_clients')){
            return response()->json(['status'=>0,'data'=>'العملية ممنوعة']);
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){

            $deleted = $item->delete();
            if($deleted){
                return response()->json(['status' => true , 'data' => 'تم الحذف بنجاح']);
            }else{
                return response()->json(['status' => false , 'data' => 'حدث خطأ أثناء العملية']);
            }
          
        }else{
            return response()->json(['status' => false , 'data' => 'حدث خطأ أثناء العملية']);
        }

    }

    public function search(Request $request)
    {
        $name=$request->name;
        $items = MyModel::where(function ($query) use($name) {
            $query->Where('name', 'like', '%' .  $name . '%');
        })->select('id','name')->limit(10)->get();
        return response()->json(['status' => true , 'data' =>$items]);
    }
    
}