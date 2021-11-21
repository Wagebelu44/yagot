<?php



namespace App\Http\Controllers\Admin;



use App\Models\Messages as MyModel;
use App\Models\Setting;
use Illuminate\Http\Request;

use App\Mail\send_reply;

use Lang;



class ContactUsController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
        \App::setLocale(\Session::get('lang_id')); 
    }
    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $lang = Lang::getLocale();
        $data['message'] =  MyModel::select(['id','name','email','details','mobile','created_at','response'])->orderBy('id','desc');
        if($request->name){
            $data['message'] =  $data['message']->where('name','LIKE', '%' .  $request->name . '%');
        }
        $data['message'] = $data['message']->paginate(15);
        if ($request->ajax()) {
            return view('admin.contact.table-data', compact('data'))->render();
        }
        return view('admin.contact.index',compact('data'));
    }

  /***********************************************************************************************************************/

    public function view(Request $request){
        $id = $request->get('id');
        $item = MyModel::where('id',$id)->first(['id','name','email','mobile','details','admin_view']);
        if($item != ''){
            $item->admin_view = 1;
            $saved = $item->save();
            if(!$saved){
                return response()->json(['status' => false , 'message' => trans("lang.required")]);
            }
            return response()->json(['status' => true , 'data' => $item]);
        }else{
            return response()->json(['status' => false , 'message' => trans("lang.error")]);
        }
    }


    public function reply(Request $request){
        $id = $request->get('sender_id');
        $response_title = $request->get('response_title');
        $response = $request->get('response');
        if($response == '' or $response_title == ''){
            return response()->json(['status' => false , 'message' => trans("lang.required")]);
        }
        $email = Setting::where('id',1)->first('email')->email;
        $item = MyModel::find($id);
        if($item != ''){
            $item->response_title = $response_title;
            $item->response = $response;
            $saved = $item->save();
            if(!$saved){
                return response()->json(['status' => false , 'message' => trans("lang.error")]);
            }
            \Mail::to($item->email)->send(new send_reply($request,$email));
            return response()->json(['status' => true , 'message' => trans("lang.success")]);
        }else{
            return response()->json(['status' => false , 'message' => trans("lang.error")]);
        }
    }
/***********************************************************************************************************************/

    public function updateStatus(Request $request){

        $id = $request->get('id');

        $item = MyModel::find($id);

            if($item != ''){

                if($item->status == 0){

                    $item->status = 1;

                }else{

                    $item->status = 0;

                }

                $item->user_id = \Auth::user()->id;

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