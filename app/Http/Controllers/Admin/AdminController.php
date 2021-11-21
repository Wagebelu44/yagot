<?php

namespace App\Http\Controllers\Admin;
use App\Models\System_Constants;
use App\Models\Seasons;
use App\Models\Setting;
use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController

{
    public static $data = [];
    public function __construct() 
    {
        $this->middleware(function ($request, $next) {
            \App::setLocale(\Session::get('lang_id'));
            return $next($request);
        });
    }
}