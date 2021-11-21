<?php



namespace App\Http\Controllers\Admin;



use App\Models\Slider as MyModel;
use App\Models\Products;
use App\Models\System_Constants;
use App\Models\HomeOrder;
use Illuminate\Http\Request;

use Lang;



class SliderController extends AdminController

{

    public function __construct()

    {
        parent::__construct();
    }

    //////////////////////////////////////////////

    public function index(Request $request)

    {

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('view_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $lang = Lang::getLocale();
        $data['category'] = System_Constants::where('status',1)->where('type','category')->select("value as id","name_$lang as name")->get();
        $data['slider_type'] = System_Constants::where('status',1)->where('type','slider_type')->select("value as id","name_$lang as name")->get();
        
        $data['slider'] = MyModel::orderBy('id','desc')->whereNull('parent_id')->select('id',"title_$lang as title",'status');
        // $slider = MyModel::leftJoin('system_constants as s', function($join) {
        //     $join->on('s.value', '=', 'slider.reference_id')->where('slider.type',3)->where('s.type','category')->whereNull('s.deleted_at'); 
        // })->leftJoin('products as p', function($join) {
        //     $join->on('p.id', '=', 'slider.reference_id')->where('slider.type',2)->whereNull('p.deleted_at'); 
        // })->orderBy('slider.id','desc')
       
        // ->select('slider.id','slider.type','slider.url','slider.reference_id','slider.image','slider.status');
        // $slider = $slider->selectRaw("CASE
        //                                 WHEN slider.type = 3 THEN s.name_$lang
        //                                 WHEN slider.type = 2 THEN p.title
        //                                 ELSE null
        //                         END  as title");
        $data['slider'] = $data['slider']->paginate(8);

        if ($request->ajax()) {

            return view('admin.slider.table-data', compact('data'))->render();

        }

        return view('admin.slider.index',compact('data'));

    }

  /***********************************************************************************************************************/

    public function add(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('add_slider');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }

        $hidden = $request->get('hidden');
        if($hidden == 0){
            $user_id = \Auth::user()->id;
            if(isset($request['activeValue'] )){
                $status = 1;
            }else{
                $status = 0;
            }

            $file = $request->file('photo');
            $type = $request->get('type');
            $category = $request->get('category');
            $product = $request->get('product');
            $url = $request->get('url');
            $parent_id = $request->get('parent_id');

            $rules = [
                'photo' => 'required',
                'type' => 'required',
            ];

            $validator = \Validator::make([
                'type' => $type,
                'photo' => $file,
            ],
                $rules
            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            if($type == 1){
                if($url == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.url_required")]);
                }
            }
            if($type == 2){
                if($product == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.product_required")]);
                }
            }
            if($type == 3){
                if($category == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.category_required")]);
                }
            }

            $pic = '';
            if ($request->hasFile('photo') && $file->isValid())
            {
                $ext = $file->getClientOriginalExtension();
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                }
                $pic = 'pic_' .strtotime(date("Y-m-d H:i:s")).\Str::random(5). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
            }
            $item = new MyModel();
            $item->user_id = $user_id;
            $item->image = $pic;
            $item->type = $type;
            $item->parent_id = $parent_id;
            $item->status = $status;
            if($type == 1){
                $item->url = $url;
            }
            if($type == 2){
                $item->reference_id = $product;
            }
            if($type == 3){
                $item->reference_id = $category;
            }
            $saved = $item->save();

            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
    }
/***********************************************************************************************************************/

    public function edit(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('update_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $id = $request->get('id');

            $item = MyModel::find($id);

            if($item != ''){
                $p = '';
                if($item->type == 2){
                    $p = Products::Where('id',$item->reference_id)->first();
                }
                return response()->json(['status' => true , 'data' => $item ,'product'=>$p]);

            }else{

                return response()->json(['status' => false , 'data' => trans("lang.error")]);

            }

    }



    /***********************************************************************************************************************/



    public function UpdateStats(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('change_status_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

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

            if (!$saved) {

                return response()->json(['status' => false , 'data' => trans("lang.error")]);

            }

                return response()->json(['status' => true , 'data' => trans("lang.success")]);

            }else{

                return response()->json(['status' => false , 'data' => trans("lang.error")]);

            }

    }

/***********************************************************************************************************************/

    public function update(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('update_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $hidden = $request->get('hidden');
        if($hidden != 0){
            $user_id = \Auth::user()->id;
            if(isset($request['activeValue'] )){
                $status = 1;
            }else{
                $status = 0;
            }

            $file = $request->file('photo');
            $type = $request->get('type');
            $category = $request->get('category');
            $product = $request->get('product');
            $url = $request->get('url');

            $rules = [
                'type' => 'required',
            ];

            $validator = \Validator::make([
                'type' => $type,
            ],
                $rules
            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            if($type == 1){
                if($url == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.url_required")]);
                }
            }
            if($type == 2){
                if($product == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.product_required")]);
                }
            }
            if($type == 3){
                if($category == ''){
                    return response()->json(['status' => false , 'data' => trans("lang.category_required")]);
                }
            }

            $pic = '';
            if ($request->hasFile('photo') && $file->isValid())
            {
                $ext = $file->getClientOriginalExtension();
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                }
                $pic = 'pic_' .strtotime(date("Y-m-d H:i:s")).\Str::random(5). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
            }



            $item = MyModel::find($hidden); 
            if($item != ''){
                if($pic != ''){
                    $item->image = $pic;
                }
                $item->type = $type;
                $item->status = $status;
                if($type == 1){
                    $item->url = $url;
                }
                if($type == 2){
                    $item->reference_id = $product;
                }
                if($type == 3){
                    $item->reference_id = $category;
                }
                $saved = $item->save();

                if (!$saved) {

                    return response()->json(['status' => false , 'data' => trans("lang.error")]);

                }

                    return response()->json(['status' => true , 'data' => trans("lang.success")]);

                }else{

                    return response()->json(['status' => false , 'data' => trans("lang.error")]);

                }



        }

    }



    public function delete(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('delete_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $id = $request->get('id');

        $item = MyModel::find($id);

        if($item != ''){

            $deleted = $item->delete();

            if(!$deleted){

                return response()->json(['status' => false , 'data' => trans("lang.error")]);

            }

            return response()->json(['status' => true , 'data' => trans("lang.success")]);

        }else{

            return response()->json(['status' => false , 'data' => trans("lang.error")]);

        }



    }

    public function GetImages(Request $request){
        $lang = \App::getLocale();
        $id  = $request->get('id');
         $slider = MyModel::leftJoin('system_constants as s', function($join) {
            $join->on('s.value', '=', 'slider.reference_id')->where('slider.type',3)->where('s.type','category')->whereNull('s.deleted_at'); 
        })->leftJoin('products as p', function($join) {
            $join->on('p.id', '=', 'slider.reference_id')->where('slider.type',2)->whereNull('p.deleted_at'); 
        })->orderBy('slider.id','desc')
       
        ->where('parent_id',$id)->select('slider.id','slider.type','slider.url','slider.reference_id','slider.image','slider.status');
        $slider = $slider->selectRaw("CASE
                                        WHEN slider.type = 3 THEN s.name_$lang
                                        WHEN slider.type = 2 THEN p.title
                                        ELSE null
                                END  as title");
        $data['slider'] = $slider->paginate(8);
        $view = view('admin.slider.image-table', compact('data'))->render();
        return response()->json(['status' => true , 'data' => $view]);

    }

    public function add_parent(Request $request){
        $title_ar = $request->get('title_ar');
        $title_en = $request->get('title_en');
        $hidden = $request->get('hidden');
        if($hidden == 0){
            $user_id = \Auth::user()->id;
            $rules = [
                'title_ar' => 'required',
                'title_en' => 'required',
            ];

            $validator = \Validator::make([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
            ],
                $rules
            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            \DB::beginTransaction();
    try {
 
            $item = new MyModel();
            $item->user_id = $user_id;
            $item->status = 1;
            $item->title_ar = $title_ar;
            $item->title_en = $title_en;
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            $o = HomeOrder::max('order_no');
            $h = new HomeOrder();
            $h->order_no = $o+1;
            $h->type = 1;
            $h->reference_id = $item->id;
            $h->title = $title_ar;
            $h->title_en = $title_en;
            $saved = $h->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            \DB::commit();
            return response()->json(['status' => true, 'data' => trans("lang.success")]);
            } catch (Exception $e) {
            \DB::rollback();
            return response()->json(['status' => false, 'data' => trans("lang.error")]);
            }
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
    }


    public function update_parent(Request $request){

        $userhasper = \Auth::user();

        $true = $userhasper->hasPermissionTo('update_slider');

        if(!$true){

            return 'عذرا ليس لديك صلاحية';

        }

        $hidden = $request->get('hidden');
        if($hidden != 0){
            $title_ar = $request->get('title_ar');
            $title_en = $request->get('title_en');

            $rules = [
                'title_ar' => 'required',
                'title_en' => 'required',
            ];

            $validator = \Validator::make([
                'title_ar' => $title_ar,
                'title_en' => $title_en,
            ],
                $rules
            );

            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

            $item = MyModel::find($hidden); 
            if($item != ''){
                $item->title_ar = $title_ar;
                $item->title_en = $title_en;
                $saved = $item->save();
                if (!$saved) {
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                    return response()->json(['status' => true , 'data' => trans("lang.success")]);
                }else{
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
        }
    }

    public function delete_parent(Request $request){
        $userhasper = \Auth::user();
        $true = $userhasper->hasPermissionTo('delete_slider');
        if(!$true){
            return 'عذرا ليس لديك صلاحية';
        }
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){
            $o = HomeOrder::where('type',1)->where('reference_id',$id)->first();
            if($o){
                $o->delete();
            }
            $deleted = $item->delete();
            if(!$deleted){
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
            return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
    }

}