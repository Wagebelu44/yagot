<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeOrder as MyModel;
use App\Models\Setting;
use Illuminate\Http\Request;
use Lang;


class RearrangeController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $data['home_order'] = MyModel::orderBy('order_no','asc')->get();
        if ($request->ajax()) {
            return view('admin.home_order.table-data', compact('data'))->render();
        }
        return view('admin.home_order.index',compact('data'));
    }

    public function save_order(Request $request){
        $type = $request->get('type');
        $title = $request->get('title');
        $title_en = $request->get('title_en');
        $reference_id = $request->get('reference_id');

        $homes = MyModel::get();
        if($homes){
            foreach($homes as $h){
                $h->delete();
            }
        }

        $i=0;
        $order_no=1;
        if($type){
            foreach($type as $t){
                $x = new MyModel();
                $x->type = $t;
                $x->title = $title[$i];
                $x->title_en = $title_en[$i];
                $x->reference_id = $reference_id[$i];
                $x->order_no = $order_no;
                $saved = $x->save();
                if(!$saved){
                    return response()->json(['status' => false , 'message' => trans("lang.error")]);
                }
                $i++;
                $order_no++;
            }
        }
        return response()->json(['status' => true , 'message' => trans("lang.success")]);
    }

}