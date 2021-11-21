<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Favorites;
use App\Models\Social;

class SocialLinksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $social = Social::where('status',1)->get(['id',"class_icon","url",'icon']);
        return response()->json(['status' => true , 'message' =>'','data'=> $social]); 
    }
}