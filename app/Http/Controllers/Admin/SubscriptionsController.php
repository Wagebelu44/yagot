<?php



namespace App\Http\Controllers\Admin;



use App\Models\Subscriptions as MyModel;

use App\Models\Partners;
use App\Models\SubscriptionFeatures;
use App\Models\StaticPage;
use App\Models\System_Constants;

use Illuminate\Http\Request;





class SubscriptionsController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////

    public function index(Request $request)

    {

       $lang  = \App::getLocale();
       $data['static'] = MyModel::orderBy('id','desc')->leftJoin('system_constants as s', function($join) {
                            $join->on('s.value', '=', 'subscriptions.currency_id')->where('s.type','currency')->whereNull('s.deleted_at'); 
                        })->select(['subscriptions.id',"subscriptions.name_$lang as name",'price'
                        ,'number_products','number_days','currency_id',"s.name_$lang as currency_name"])->paginate(15);
        $data['all_tplan']=System_Constants::where('status',1)->where('type','subscriptions')->select("value as id","name_$lang as name")->get();
        if ($request->ajax()) {
            return view('admin.subscriptions.table-data', compact('data'))->render();
        }
        return view('admin.subscriptions.index',compact('data'));

    }

  /***********************************************************************************************************************/

    public function add(Request $request){

    //    return $request;

        $hidden = $request->get('hidden');

        if($hidden == 0){

            $user_id = \Auth::user()->id;
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $all_tplan =$request->get('all_tplan');
            $price=$request->get('price');
            $number_products = $request->get('number_products');
            $number_days = $request->get('number_days');
            $number_slider= $request->number_slider;
            
            $rules = [

                'name_ar' => 'required',
                'name_en' => 'required',
                'price' => 'required',
                // 'number_days' => 'required',
            ];

            $validator = \Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => $validator->errors()]);
            }
         

            \DB::beginTransaction();
            try {
                
            $item = new MyModel();
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->price = $price;
            $item->number_slider = $number_slider;
            $item->number_days = $number_days;
            $item->number_products = $number_products;
            $saved = $item->save();
           
            if (!$saved) {
                return response()->json(['status' => false , 'data' =>  trans('lang.error')]);
            }
           
            if($all_tplan){
                foreach($all_tplan as $terms){
                    $terms_service = new SubscriptionFeatures();
                    $terms_service->subscription_id =$item->id;
                    $terms_service->feature_id = $terms;
                    $saved = $terms_service->save();
                    if(!$saved){
                         return response()->json(['status' => false , 'data' =>  trans('lang.error')]);
                    }
                }
               
            }
           

            \DB::commit();
            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            \DB::rollback();
         }
         return response()->json(['status' => false , 'data' => trans('lang.error')]);
        }else{

            return response()->json(['status' => false , 'data' => trans('lang.error')]);

        }

        



    }

/***********************************************************************************************************************/

    public function edit(Request $request){
            $lang = \App::getLocale();
            $id = $request->get('id');
            $item = MyModel::where('id',$id)->with('features')->first();
            $arr = $item->features->pluck('feature_id')->ToArray();
            if($item != ''){
                $options = '';
                $data['all_tplan']=System_Constants::where('status',1)->where('type','subscriptions')->select("value as id","name_$lang as name")->get();
                foreach($data['all_tplan'] as $b){
                    if(in_array($b->id,$arr)){
                        $checked = 'checked';
                    }else{
                        $checked = '';  
                    }
                    $options .= ' <div class="col-md-4 ">
                                    <label for="checkboxRule'.$b->id.'">
                                            <input value="'.$b->id.'" type="checkbox" '.$checked.' name="all_tplan[]" class="zt-control all_tplan" id="checkboxRule'.$b->id.'">
                                            '.$b->name.'
                                    </label>
                                </div>';
                }


                return response()->json(['status' => true , 'data' => $item ,'options' => $options]);
            }else{
                return response()->json(['status' => false , 'data' => trans('lang.error')]);
            }
    }


    /***********************************************************************************************************************/



    public function UpdateStats(Request $request){

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

                    return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

                }

                return response()->json(['status' => true , 'data' => trans('lang.success')]);

            }else{

                return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

            }

    }

/***********************************************************************************************************************/

    public function update(Request $request){
        $hidden = $request->get('hidden');
        if($hidden != 0){
            $user_id = \Auth::user()->id;
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $all_tplan =$request->get('all_tplan');
            $price=$request->get('price');
            $number_products = $request->get('number_products');
            $number_days = $request->get('number_days');
            $number_slider= $request->number_slider;
            
            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'price' => 'required',
                // 'number_days' => 'required',
            ];

            $validator = \Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => $validator->errors()]);
            }
         
            \DB::beginTransaction();
            try {

    
            $item = MyModel::find($hidden); 

            if($item != ''){
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->price = $price;
            $item->number_slider = $number_slider;
            $item->number_days = $number_days;
            $item->number_products = $number_products;
                $saved = $item->save();
                if(!$saved){

                    return response()->json(['status' => false , 'data' => trans('lang.error')]);

                }

                if($all_tplan){
                    $terms_deleted = SubscriptionFeatures::where('subscription_id',$hidden)->get();
                    if($terms_deleted){
                        foreach($terms_deleted as $t_deleted){
                            $deleted = $t_deleted->delete();
                        }
                    }
                    foreach($all_tplan as $terms){
                        $terms_service = new SubscriptionFeatures();
                        $terms_service->subscription_id =$item->id;
                        $terms_service->feature_id = $terms;
                        $saved = $terms_service->save();

                        if(!$saved){
                            return response()->json(['status' => false , 'data' => trans('lang.error')]);

                        }
                    }
                   
                }

                    }else{

                        return response()->json(['status' => false , 'data' => trans('lang.error')]);

                    }
                \DB::commit();
                return response()->json(['status' => true, 'data' => trans('lang.success')]);
            } catch (\Exception $e) {
                \DB::rollback();
            }
            return response()->json(['status' => false , 'data' =>  trans('lang.error')]);
        }else{

            return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

        }

    }



    public function delete(Request $request){


        $id = $request->get('id');
        if($id == 4){
            return response()->json(['status' => false , 'data' => trans("lang.can_delete")]);
        }
        $item = MyModel::find($id);

        if($item != ''){
            $deleted = $item->delete();
            $terms_deleted = SubscriptionFeatures::where('subscription_id',$id)->get();
            if($terms_deleted){
                foreach($terms_deleted as $t_deleted){
                    $deleted = $t_deleted->delete();
                }
            }
            if(!$deleted){

                return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

            }

            return response()->json(['status' => true , 'data' => trans('lang.success')]);

        }else{

            return response()->json(['status' => false , 'data' =>  trans('lang.error')]);

        }



    }

}