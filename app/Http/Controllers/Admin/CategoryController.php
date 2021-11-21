<?php



namespace App\Http\Controllers\Admin;

use App\Models\System_Constants  as MyModel;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Terms;
use Lang;

class CategoryController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////
    public function index(Request $request){
        $lang = Lang::getLocale();
        $name  = $request->get('name');
        $data['category'] = MyModel::orderBy('id','desc');
        if($name != ''){
            $data['category'] = $data['category']->Where('system_constants.name_ar', 'like', '%' .  $name . '%')
                                        ->orWhere('system_constants.name_en', 'like', '%' .  $name . '%');
        }
        $data['category'] = $data['category']->where('system_constants.type','=','category')
                            ->select(['system_constants.id',"system_constants.name_$lang as name",'system_constants.status'])
                            ->paginate(15);
        if ($request->ajax()) {
            return view('admin.category.table-data', compact('data'))->render();
        }
        return view('admin.category.index',compact('data'));
    }

    public function add(Request $request){

        $hidden = $request->get('hidden');
        if($hidden == 0){
            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            $type = 'category';
            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
                'type' => 'required',
            ];
    
            $validator = \Validator::make([
                'name_ar' => $name_ar,
                'name_en' => $name_en,
                'type' => $type,
            ],
                $rules
            
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }
    
            $item = new MyModel();
            $item->name_ar = $name_ar;
            $item->name_en = $name_en;
            $item->type = $type;
            $item->user_id = \Auth::user()->id;
            $item->status = 1;
            $value = MyModel::where('type',$type)->max('value');
            $item->value = $value + 1;
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
    $id = $request->get('id');
    $item = MyModel::find($id);
    if($item != ''){
        return response()->json(['status' => true , 'data' => $item]);
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

        $hidden = $request->get('hidden');

        if($hidden != 0){
            $item = MyModel::find($hidden);
            if($item == ''){
                return response()->json(['status' => false , 'data' => trans("lang.error")]);
            }

            $name_ar = $request->get('name_ar');
            $name_en = $request->get('name_en');
            if(isset($request['status'])){
                $status = 1;
            }else{
                $status = 0;
            }

            $rules = [
                'name_ar' => 'required',
                'name_en' => 'required',
            ];
    
            $validator = \Validator::make([
                'name_ar' => $name_ar,
                'name_en' => $name_en,
            ],
                $rules
            
            );
    
            if ($validator->fails()) {
                return response()->json(['status' => false , 'data' => trans("lang.required")]);
            }

                $item->name_ar = $name_ar;
                $item->name_en = $name_en;
                // $item->status = $status;
                $saved = $item->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }
                return response()->json(['status' => true , 'data' => trans("lang.success")]);
        }
    }


    public function delete(Request $request){
        $id = $request->get('id');
        $item = MyModel::find($id);
        if($item != ''){
            $p = Products::Where('category_id',$item->value)->first();
            if($p){
                return response()->json(['status' => false , 'data' => trans("lang.can_delete")]);
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