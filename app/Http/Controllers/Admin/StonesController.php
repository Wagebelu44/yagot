<?php



namespace App\Http\Controllers\Admin;

use App\Models\System_Constants  as MyModel;
use Illuminate\Http\Request;
use App\Models\StonesImages;
use App\Models\Products;
use App\Models\Terms;
use Lang;

class StonesController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////
    public function index(Request $request){
        $lang = Lang::getLocale();
        $name  = $request->get('name');
        $data['category'] = MyModel::orderBy('id','desc')->where('system_constants.type','stones');
        // if($name != ''){
        //     $data['category'] = $data['category']->Where('system_constants.name_ar', 'like', '%' .  $name . '%')
        //                                 ->orWhere('system_constants.name_en', 'like', '%' .  $name . '%');
        // }
        $data['category'] = $data['category']
                            ->select(['system_constants.id',"system_constants.name_$lang as name",'photo','system_constants.status'])
                            ->paginate(15);
        if ($request->ajax()) {
            return view('admin.stones.table-data', compact('data'))->render();
        }
        return view('admin.stones.index',compact('data'));
    }

    public function add(Request $request){

        $hidden = $request->get('hidden');
        if($hidden == 0){
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $details_ar = $request->get('details_ar');
            $details_en = $request->get('details_en');
            $file = $request->file('photo');
            $images = $request->file('images');
            

            $type = 'stones';
            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'details_ar' => 'required',
                'details_en' => 'required',
                'type' => 'required',
            ];
    
            $validator = \Validator::make([
                'name_ar' => $name_ar,
                'name_en' => $name_en,
                'details_ar' => $details_ar,
                'details_en' => $details_en,
                'type' => $type,
            ],
                $rules
            
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }
            

            $pic = '';
            if ($request->hasFile('photo') && $file->isValid())
            {
                $ext = $file->getClientOriginalExtension();
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                }
                $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
            }

            
            \DB::beginTransaction();
    try {

            $item = new MyModel();
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->details_ar = $details_ar;
            $item->details_en = $details_en;
            $item->type = $type;
            if($pic){
                $item->photo = $pic;
            }
            $item->user_id = \Auth::user()->id;
            $item->status = 1;
            $value = MyModel::where('type',$type)->max('value');
            $item->value = $value + 1;
            $saved = $item->save();
            if (!$saved) {
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            $n_images = new StonesImages();
            $n_images->stone_id = $item->value;
            $n_images->image = $pic;
            $n_images->save();
             
            if($images){
                foreach($images as $i){
                    $pic = '';
                    if ($i->isValid())
                    {
                        $ext = $i->getClientOriginalExtension();
                        if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                            return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                        }
                        $pic = 'pic_' . \Str::random(10) . '.' . $i->getClientOriginalExtension();
                        $i->move(public_path('uploads'), $pic);

                        $n_images = new StonesImages();
                        $n_images->stone_id = $item->value;
                        $n_images->image = $pic;
                        $n_images->save();
                    }
                }
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

/***********************************************************************************************************************/
public function edit(Request $request){
    $id = $request->get('id');
    $item = MyModel::with('images_stones')->where('id',$id)->first();
    if($item != ''){
        $html ='';

        if($item->images_stones){
            $html .= '<table class="table table-bordered" id="html_table" width="100%">
            <tr><td class="text-center  font-weight-bold">الصور</td><td class="text-center  font-weight-bold">حذف</td></tr>';
            foreach($item->images_stones->skip(1) as $s){
             
                $html .= '<tr class="m-datatable__row">
                                <td class="text-center">';
                                    $html .=  '<a  data-fancybox="gallery" href ="'.$s->image.'"  >
                                        <img src="'.$s->image.'" width="50px" style="height:50px" alt="">
                                    </a></td>';
                $html .= '<td class="text-center" >
                            <a href="javascript:void(0);" data-id="'.$s->id.'" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
							delete_image"> <i class="fa fa-trash"></i> </a></td>';
                $html .=  '</tr>';
               
            }
            $html .= '</table>';
        }

        return response()->json(['status' => true , 'data' => $item ,'html'=>$html]);
    }else{
        return response()->json(['status' => false , 'data' => trans("lang.error")]);
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
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
            }else{
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }
    }
/***********************************************************************************************************************/

    public function update(Request $request){

        $hidden = $request->get('hidden');

        if($hidden != 0){
            $item = MyModel::find($hidden);
            if($item == ''){
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $details_ar = $request->get('details_ar');
            $details_en = $request->get('details_en');
            $file = $request->file('photo');
            $remove_images = $request->get('remove_images');
            $images = $request->file('images');

            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'details_ar' => 'required',
                'details_en' => 'required',
            ];
    
            $validator = \Validator::make([
                'name_ar' => $name_ar,
                'name_en' => $name_en,
                'details_ar' => $details_ar,
                'details_en' => $details_en,
            ],
                $rules
            
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

                $pic = '';
                if ($request->hasFile('photo') && $file->isValid())
                {
                    $ext = $file->getClientOriginalExtension();
                    if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                        return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                    }
                    $pic = 'pic_' . strtotime(date("Y-m-d H:i:s")) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $pic);
                }

                \DB::beginTransaction();
                try {

                $item->name_ar = $name_ar;
                $item->name_en = $name_en;
                $item->details_ar = $details_ar;
                $item->details_en = $details_en;
                // $item->status = $status;
                if($pic){
                    $item->photo = $pic;
                }
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }

                $s = StonesImages::where('stone_id',$item->value)->first();
                if($s){
                    $s->image = $item->photo;
                    $s->save();
                }
                      
                if($remove_images){
                    $arr = explode(',',$remove_images);
                    if($arr){
                        $ss = StonesImages::whereIn('id',$arr)->get();
                        if($ss){
                            foreach($ss as $s){
                                $s->delete();
                            }
                        }
                    }
                }
                
                if($images){
                    foreach($images as $i){
                        $pic = '';
                        if ($i->isValid())
                        {
                            $ext = $i->getClientOriginalExtension();
                            if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                                return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                            }
                            $pic = 'pic_' . \Str::random(10) . '.' . $i->getClientOriginalExtension();
                            $i->move(public_path('uploads'), $pic);
                            $n_images = new StonesImages();
                            $n_images->stone_id = $item->value;
                            $n_images->image = $pic;
                            $n_images->save();
                        }
                    }
                }

            
              \DB::commit();
                  return response()->json(['status' => true, 'data' => trans("lang.success")]);
                } catch (Exception $e) {
                  \DB::rollback();
                  return response()->json(['status' => false, 'data' =>  trans("lang.error")]);
                }     
                
        }
    }


    public function delete(Request $request){
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

}