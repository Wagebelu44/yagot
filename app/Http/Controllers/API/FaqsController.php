<?php

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Helpers\Helpers;
use App\Models\Favorites;
use App\Models\Faqs;

class FaqsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        
        $lang = \App::getLocale();
        $faqs = Faqs::where('status',1)->get(['id',"title_$lang as title","details_$lang as details"]);
        return response()->json(['status' => true , 'message' =>'','data'=> $faqs]); 
    }
}