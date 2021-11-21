<?php

namespace App\Http\Controllers\Admin;

use App\Models\Social as MyModel;
use Illuminate\Http\Request;

class SocialLinksController extends AdminController
{
	public function __construct()
	{
		parent::__construct();
		// $this->middleware(['permission:setting|edit_setting']);
	}
	//////////////////////////////////////////////
	public function index(Request $request)
	{
		$data['social'] = MyModel::paginate(15);
		if ($request->ajax()) {
			return view('admin.social.table-data', compact('data'))->render();
		}
		return view('admin.social.index',compact('data'));
	}
	/***********************************************************************************************************************/
	public function add(Request $request){
		   
			$url = $request->get('url');
			$social = $request->get('social');
			$file = $request->file('file');
			if(isset($request['activeValue'])){
				$status = 1;
			}else{
				$status = 0;
			}

			$rules = [
				'url' => 'required',
				// 'social' => 'required',
			];
	
			$validator = \Validator::make([
				'url' => $url,
				// 'social' => $social,
			],
				$rules
			);
	
			if ($validator->fails()) {
				return response()->json(['status' => false , 'data' => $validator->errors()->first()]);
			}

			$pic = '';
            if ($request->hasFile('file') && $file->isValid())
            {
                $ext = $file->getClientOriginalExtension();
                if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
                    return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
                }
                $pic = 'social_' .strtotime(date("Y-m-d H:i:s")).\Str::random(5). '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $pic);
			}
			
			$item = new MyModel();
			$item->url = $url;
			$item->file = $pic;
			$item->class_icon = $social;
			$item->status = $status;
			$item->user_id = \Auth::user()->id;
			$saved = $item->save();
			if(!$saved){
				return response()->json(['status' => false , 'data' => __('lang.error')]);
			}
			return response()->json(['status' => true , 'data' => __('lang.success')]);
			

		}

		public function edit(Request $request){
			
				$id = $request->get('id');
				$item = MyModel::find($id);
				if($item != ''){
					return response()->json(['status' => true , 'data' => $item]);
				}else{
					return response()->json(['status' => false , 'data' => __('lang.error')]);
				}
		}


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
						return response()->json(['status' => false , 'data' => __('lang.error')]);
					}
					return response()->json(['status' => true , 'data' => __('lang.success')]);
				}else{
					return response()->json(['status' => false , 'data' => __('lang.error')]);
				}
		}


		public function update(Request $request){
		   
			$hidden = $request->get('hidden');
	
			if($hidden != 0){
				$url = $request->get('url');
				$social = $request->get('social');
				$file = $request->file('file');
				if(isset($request['activeValue'])){
					$status = 1;
				}else{
					$status = 0;
				}
	
	
				$rules = [
					'url' => 'required',
					// 'social' => 'required',
				];
		
				$validator = \Validator::make([
					'url' => $url,
					// 'social' => $social,
				],
					$rules
				 
				);
		
				if ($validator->fails()) {
					return response()->json(['status' => false , 'data' => $validator->errors()->first()]);
				}
			   
				
				$pic = '';
				if ($request->hasFile('file') && $file->isValid())
				{
					$ext = $file->getClientOriginalExtension();
					if($ext != 'png' and $ext != 'jpg' and $ext != 'jpeg'){
						return response()->json(['status' => false , 'data' => trans("lang.file_format")]);
					}
					$pic = 'social_' .strtotime(date("Y-m-d H:i:s")).\Str::random(5). '.' . $file->getClientOriginalExtension();
					$file->move(public_path('uploads'), $pic);
				}
				

				$item = MyModel::find($hidden); 
				if($item != ''){
					$item->url = $url;
					if($pic){
						$item->file = $pic;
					}
					$item->class_icon = $social;
					$item->status = $status;
					$item->user_id = \Auth::user()->id;
					$saved = $item->save();
					if(!$saved){
						return response()->json(['status' => false , 'data' => __('lang.error')]);
					}
					return response()->json(['status' => true , 'data' => __('lang.success')]);
				}else{
					return response()->json(['status' => false , 'data' => __('lang.error')]);
				}
	
			}
		}


		public function delete(Request $request){
			$id = $request->get('id');
			$item = MyModel::find($id);
			if($item != ''){
				$deleted = $item->delete();
				if(!$deleted){
					return response()->json(['status' => false , 'data' => __('lang.error')]);
				}
				return response()->json(['status' => true , 'data' => __('lang.deleted_successfully')]);
			}else{
				return response()->json(['status' => false , 'data' => __('lang.error')]);
			}
		}
}

