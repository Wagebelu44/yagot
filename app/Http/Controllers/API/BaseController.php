<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;
class BaseController extends Controller{

    public static $data = [];
    public function __construct(){
        self::$data['page'] = 10;
    }

}