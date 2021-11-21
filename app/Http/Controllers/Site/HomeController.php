<?php
namespace App\Http\Controllers\Site;
use App\Models\StaticPage;

class HomeController extends BaseController
{

    public function __construct(){
        parent::__construct();
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index(){
        return view('site.index');
    }

    public function static($lang = ''){
        if($lang != 'ar' and $lang != 'en'){
            $lang = 'ar';
        }
        \App::setLocale($lang);
        $data['static'] = StaticPage::where('slug','policy-privacy')->first(['id',"title_$lang as title","details_$lang as details"]);
        return view('site.static',compact('data'));
    }
}   