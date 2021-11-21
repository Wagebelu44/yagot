<?php

namespace App\Http\Controllers\Admin;
use App\Models\BanksTransfer as MyModel;
use App\Models\System_Constants;
use Illuminate\Http\Request;
use Lang;
use App\Models\FinancialMovements;

class BanksTransferController extends AdminController
{

    public function __construct(){
        parent::__construct();
    }

    public function index(Request $request){
        $lang = \App::getLocale();
        $data['transfer'] = MyModel::leftJoin('clients as c', function($join) {
                                $join->on('banks_transfer.client_id', '=', 'c.id')->whereNull('c.deleted_at');
                            })->leftJoin('system_constants as s', function($join) {
                                $join->on('banks_transfer.payment_type', '=', 's.value')->where('s.type','payment_type')->whereNull('s.deleted_at');
                            })->leftJoin('system_constants as sys', function($join) {
                                $join->on('banks_transfer.status', '=', 'sys.value')->where('sys.type','transfer_status')->whereNull('sys.deleted_at');
                            })->leftJoin('system_constants as sy', function($join) {
                                $join->on('banks_transfer.currency_id', '=', 'sy.value')->where('sy.type','currency')->whereNull('sy.deleted_at');
                            })->select('banks_transfer.id','c.name as client_name','banks_transfer.date','banks_transfer.name as name_tranfer','c.mobile as mobile'
                                        ,"s.name_$lang as fees_type","sy.name_$lang as currency_name",'banks_transfer.transaction_id',"sys.name_$lang as status_sys",'banks_transfer.status')->orderBy('banks_transfer.id','desc')->paginate(15);
        if ($request->ajax()) {
            return view('admin.transfer.table-data', compact('data'))->render();
        }
        return view('admin.transfer.index',compact('data'));
    }



    public function details(Request $request){
        $lang = \App::getLocale();
        $id = $request->get('id');
      
       $data['details'] = MyModel::leftJoin('clients as c', function($join) {
                                $join->on('banks_transfer.client_id', '=', 'c.id')->whereNull('c.deleted_at');
                            })->leftJoin('system_constants as s', function($join) {
                                $join->on('banks_transfer.payment_type', '=', 's.value')->where('s.type','payment_type')->whereNull('s.deleted_at');
                            })->leftJoin('system_constants as sy', function($join) {
                                $join->on('banks_transfer.currency_id', '=', 'sy.value')->where('sy.type','currency')->whereNull('sy.deleted_at');
                            })->leftJoin('system_constants as sys', function($join) {
                                $join->on('banks_transfer.status', '=', 'sys.value')->where('sys.type','transfer_status')->whereNull('sys.deleted_at');
                            })->leftJoin('banks as b', function($join) {
                                $join->on('banks_transfer.bank_id', '=', 'b.id')->whereNull('b.deleted_at');
                            })->where('banks_transfer.id',$id)->select('banks_transfer.id','c.name as client_name','banks_transfer.name as name_tranfer','c.mobile as mobile_tranfer'
                                        ,"s.name_$lang as fees_type","sy.name_$lang as currency_name","sys.name_$lang as status_sys",'banks_transfer.status',
                                        'b.iban',
                                        'b.tax_number',
                                        "b.name_$lang as bank_name",
                                        'banks_transfer.total_price',
                                        'banks_transfer.date',
                                        'banks_transfer.image')->first();

        $view = view('admin.transfer.table-details', compact('data'))->render();
        return response()->json(['status' => true , 'data' => $view]);

    }

    public function status_transfer(Request $request){
        $id = $request->get('id');
        $status = $request->get('status');
        $trnasfer = MyModel::find($id);
        if($trnasfer){

            \DB::beginTransaction();
            try {

                $trnasfer->status = $status;
                $saved = $trnasfer->save();
                if(!$saved){
                    return response()->json(['status' => false , 'data' => trans("lang.error")]);
                }

                if($status == 1){
                    $move_no = new FinancialMovements();
                    $move_no  = $move_no->getMoveNo();

                    $financial = new FinancialMovements();
                    $financial->depit = $trnasfer->total_price;
                    $financial->payment_type = $trnasfer->payment_type;
                    $financial->client_id = $trnasfer->client_id;
                    $financial->total_price = $trnasfer->total_price;
                    $financial->currency_id = $trnasfer->currency_id;
                    $financial->action_source = $trnasfer->action_source;
                    $financial->transfer_id =  $trnasfer->id;
                    $financial->move_no =  $move_no;
                    $financial->user_id =  \Auth::user()->id;
                    $saved = $financial->save();
                    if(!$saved){
                        return response()->json(['status' => false , 'data' => trans("lang.error")]);
                    }
    
                }

            \DB::commit();
            return response()->json(['status' => true, 'data' => trans('lang.success')]);

            } catch (\Exception $e) {
                \DB::rollback();
            }

            return response()->json(['status' => false , 'data' => trans('lang.error')]);  

        }else{
            return response()->json(['status' => false , 'data' => trans("lang.error")]);
        }
    }

}