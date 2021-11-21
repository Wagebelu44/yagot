<?php

namespace App\Http\Middleware;
use Closure;
class CheckApi 
{
 
    public function handle($request,Closure $next)
    {
        $header = $request->header('Authorization');
        if(isset($header) and $header != 'null' and $header != ''){
            $header = substr($header, 7);
            $token = \App\Models\Tokens::where('token',$header)->first();   
            if (!$token) {
                return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401);
            }else{
                $client = \App\Models\Clients::where('id',$token->tokenable_id)->first(['id','last_login']);
                if($client){
                    $client->last_login = date('Y-m-d H:i:s');
                    $client->save();
                }
                return $next($request);
            }
          
        }
        return response()->json(['status' => false , 'message' => trans('lang.Unauthorized')], 401);
       
    }
}
