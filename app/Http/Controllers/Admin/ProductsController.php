<?php

namespace App\Http\Controllers\Admin;

use App\Models\System_Constants;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductAttachments;
use App\Models\Zones;

class ProductsController extends AdminController
{

  public function __construct()
  {
      parent::__construct();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // if (\Auth::user()->cant('view_news')) {
    //   return response(__('lang.no_permission'), 403);
    // }
    $title = $request->get('title');
    $name_search = $request->get('name_search');
    $category_search = $request->get('category_search');
    $zone_search = $request->get('zone_search');
    $status_search = $request->get('status_search');

    $lang = \App::getLocale();
    $data['system'] = System_Constants::where('status',1)->where('type','lang')->select("value2","name_$lang as name")->get();
    $data['product'] = Products::leftJoin('system_constants as s', function($join) {
                        $join->on('s.value', '=', 'products.category_id')->where('type','category');
                    })->leftJoin('clients as cl', function($join) {
                      $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
                    })->leftJoin('system_constants as sys', function($join) {
                      $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
                    })->leftJoin('zones as z', function($join) {
                      $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
                    });
    
    if($title != ''){
        $data['product'] = $data['product']->Where('products.title', 'like', '%' .  $title . '%');
    }
    if($name_search != ''){
      $data['product'] = $data['product']->Where('cl.name', 'like', '%' .  $name_search . '%');
    }
    if($category_search != ''){
      $data['product'] = $data['product']->Where('products.category_id',$category_search);
    }
    if($zone_search != ''){
      $data['product'] = $data['product']->Where('products.city_id',$zone_search);
    }
    if($status_search != ''){
      $data['product'] = $data['product']->Where('products.status',$status_search);
    }

    $data['category'] = System_Constants::where('type','category')->where('status',1)->get(['value as id',"name_$lang as name"]);

    $data['product'] = $data['product']->select(['products.id','products.status','products.city_id','products.category_id',"sys.name_$lang as curreny_name","z.name_$lang as city_name","cl.name as client_name"
                                              ,"products.title",'products.certified',"products.details as description",'products.price',"s.name_$lang as category",'products.image'])
                        ->orderBy('products.id','desc')->paginate(15);

    $data['zones'] = Zones::where('status',1)->whereNull('parent_id')->get(['id',"name_$lang as name",'country_id']);
    $data['product_status'] = System_Constants::where('type', 'product_status')->get(['value as id',"name_$lang as name"]);

    
    if ($request->ajax()) {
      return view('admin.news.table-data', compact('data'))->render();
    }
    return view('admin.news.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $title = $request->get('title');
    $main_image = $request->file('main_image');
    $images = $request->file('additional_image');
    $details = $request->get('details');
    $certified_images = $request->file('certified_images');
    $category_id = $request->get('category_id');
    $city_id = $request->get('city_id');
    $price = $request->get('price');
    $currency_id = 1;
    $client_id = $request->get('client_id');
   
    $rules = [
        'title' => 'required',
        'client_id' => 'required',
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
        'client_id.required' => 'العميل مطلوب',
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
        'client_id' => $client_id,
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
        return response()->json(['status' => false , 'data' =>  implode(',',$strs)]);
    }



    \DB::beginTransaction();
    try {
    
      $main_image_file = '';
      if($main_image){
          if ($main_image->isValid())
          {
              $main_image_file = 'main_image_' . \Str::random(8) . '.' . $main_image->getClientOriginalExtension();
              $main_image->move(public_path('uploads'), $main_image_file);
          }
      }
        
        $p = new Products();
        $p->client_id = $client_id;
        $p->title = $title;
        $p->details = $details;
        $p->category_id = $category_id;
        $p->currency_id = $currency_id;
        $p->city_id = $city_id;
        $p->price = $price;
        if($main_image_file){
          $p->image = $main_image_file;
        }
        $saved = $p->save();
        if(!$saved){
            return response()->json(['status' => false , 'message' => trans('lang.error'),'data'=>''],422);  
        }

        $p_attach = new ProductAttachments();
        $p_attach->product_id = $p->id;
        $p_attach->attachment = $main_image_file;
        $p_attach->type = 1;
        $p_attach->client_id =$client_id;
        $saved_img  = $p_attach->save();
        if(!$saved_img){
            return response()->json(['status' => false , 'message' => trans('lang.error')]);  
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
                    $p_attach->client_id =$client_id;
                    $saved_img  = $p_attach->save();
                    if(!$saved_img){
                        return response()->json(['status' => false , 'data' => trans('lang.error')]);  
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
                    $p_attach->client_id =$client_id;
                    $saved_img  = $p_attach->save();
                    if(!$saved_img){
                        return response()->json(['status' => false , 'data' => trans('lang.error')]);  
                    }
                }
            }
        }


      \DB::commit();
      return response()->json(['status' => true, 'data' => 'تمت عملية الإضافة']);
    } catch (Exception $e) {
      \DB::rollback();
      return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء عملية الإضافة']);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $lang = \App::getLocale();
    $products = Products::leftJoin('system_constants as s', function($join) {
      $join->on('s.value', '=', 'products.category_id')->where('type','category');
  })->leftJoin('clients as cl', function($join) {
    $join->on('cl.id', '=', 'products.client_id')->whereNull('cl.deleted_at'); 
  })->leftJoin('system_constants as sys', function($join) {
    $join->on('sys.value', '=', 'products.currency_id')->where('sys.type','currency')->whereNull('sys.deleted_at'); 
  })->leftJoin('zones as z', function($join) {
    $join->on('z.id', '=', 'products.city_id')->whereNull('z.deleted_at'); 
  })->leftJoin('system_constants as sy', function($join) {
    $join->on('sy.value', '=', 'products.status')->where('sy.type','product_status')->whereNull('sy.deleted_at'); 
  });

  $products = $products->with('images')->with('certified_images')->where('products.id', $id)->select(['products.id','products.status',"sys.name_$lang as curreny_name","z.name_$lang as city_name","cl.name as client_name"
                            ,"products.title",'products.certified',"products.details","sy.name_$lang as status_name",'products.price',"s.name_$lang as category",'products.image'])->first();

    if ($products) {
      return response()->json(['data' => $products, 'status' => true]);
    }
    return response()->json(['status' => false, 'data' => 'لم يتم ايجاد شيئ']);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $item = Products::where('id',$id)->with('images')->with('client')->with('certified_images')->get()->first();
    if ($item) {
      return response()->json(['status' => true, 'data' => $item]);
    } else {
      return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    
    $p = Products::find($id);
    $title = $request->get('title');
    $main_image = $request->file('main_image');
    $images = $request->file('additional_image');
    $details = $request->get('details');
    $certified_images = $request->file('certified_images');
    $category_id = $request->get('category_id');
    $city_id = $request->get('city_id');
    $price = $request->get('price');
    $currency_id = 1;
    $client_id = $request->get('client_id');
   
    $rules = [
        'title' => 'required',
        'client_id' => 'required',
        'details' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        'city_id' => 'required',
        'main_image' => 'nullable|mimes:jpeg,jpg,png',
        'images.*' => 'nullable|mimes:jpeg,jpg,png',
        'certified_images.*' => 'nullable|mimes:jpeg,jpg,png',
    ];

    $messages = [
        'title.required' => trans('lang.title_required'),
        'client_id.required' => 'العميل مطلوب',
        'details.required' =>  trans('lang.details_required'),
        'price.required' => trans('lang.price_required'),
        'main_image.mimes' => trans('lang.image_format'),
        'images.*.mimes' => trans('lang.image_format'),
        'category_id.required' =>   trans('lang.category_required'),
        'city_id.required' =>   trans('lang.city_required'),
        'certified_images.*.mimes' => trans('lang.image_format'),
    ];

    $validator = \Validator::make([
        'title' => $title,
        'client_id' => $client_id,
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
        return response()->json(['status' => false , 'data' =>  implode(',',$strs)]);
    }


    \DB::beginTransaction();
    try {
    
      $removedImages = $request->input('remove_additional_image');
      if ($removedImages) {
        for ($i = 0; $i < count($removedImages); $i++) {
          $newsImage = ProductAttachments::find($removedImages[$i]);
          $newsImage->delete();
        }
      }

      $main_image_file = '';
      if($main_image){
        if ($main_image->isValid())
        {
            $main_image_file = 'main_image_' . \Str::random(8) . '.' . $main_image->getClientOriginalExtension();
            $main_image->move(public_path('uploads'), $main_image_file);
        }
    }
      
      $p->client_id = $client_id;
      $p->title = $title;
      $p->details = $details;
      $p->category_id = $category_id;
      $p->currency_id = $currency_id;
      $p->city_id = $city_id;
      $p->price = $price;
      if($main_image_file){
        $p->image = $main_image_file;
      }
      $saved = $p->save();
      if(!$saved){
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
                    $p_attach->client_id =$client_id;
                    $saved_img  = $p_attach->save();
                    if(!$saved_img){
                        return response()->json(['status' => false , 'data' => trans('lang.error')]);  
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
                  $p_attach->client_id =$client_id;
                  $saved_img  = $p_attach->save();
                  if(!$saved_img){
                      return response()->json(['status' => false , 'data' => trans('lang.error')]);  
                  }
              }
          }
      }



      \DB::commit();
      return response()->json(['status' => true, 'data' => 'تمت عملية التعديل']);
    } catch (Exception $e) {
      \DB::rollback();
      return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء عملية التعديل']);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $news = Products::find($id);
    $news->delete();
    return response()->json(['status' => true, 'data' => 'تمت عملية الحذف']);
  }

  public function updateStatus(Request $request)
    {

        // if (\Auth::user()->cant('change_status_applications')) {
        //     return response(__('lang.no_permission'), 403);
        // }
        $id = $request->id;
        $item = Products::find($id);
        if ($item) {
            $item->status = $request->status;
            if ($item->save()) {
                return response()->json(['status' => true, 'data' => 'تم تعديل الحالة']);
            }
        }
        return response()->json(['status' => false, 'data' => 'حدث خطأ أثناء العملية']);
    }

    /***********************************************************************************************************************/
    public function UpdateCertificated(Request $request){
      
      $id = $request->get('id');
      $item = Products::find($id);
          if($item != ''){
              if($item->certified == 0){
                  $item->certified = 1;
              }else{
                  $item->certified = -1;
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

    public function search(Request $request)
    {
        $name=$request->name;
        $items = Products::where(function ($query) use($name) {
            $query->Where('title', 'like', '%' .  $name . '%');
        })->select('id','title as name')->limit(10)->get();
        return response()->json(['status' => true , 'data' =>$items]);
    }
}
