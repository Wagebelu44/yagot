<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Notification as MyModel;

use App\Models\Settings;
use App\Models\Clients;
use App\Models\User;

use App\Notifications\ProjectNotification;
use App\Models\MobileNotification;

use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as Notifiy;
use Kreait\Firebase\Messaging\AndroidConfig;


class NotificationsController extends AdminController

{

    public function index(){
        $notifications_unread = \Auth::user()->notifications()->where('read_at',null)->count();
        $notifications =  \Auth::user()->notifications()->orderBy('created_at','desc')->limit(10)->get();
        return response()->json(['status'=>true,'data'=>$notifications, 'unread' => $notifications_unread]);

    }

    public function check()

    {

        $data = [];

        $notifications = \Auth::user()->notifications()->where('read_at',null)->get();

        $notifications_unread = \Auth::user()->notifications()->where('read_at',null)->count();

        \Auth::user()->notifications()->where('read_at',null)->update(['read_at'=>date('y-m-d H:i:s')]);

        if (count($notifications)>0) {

            $data['status'] = true;

            $data['notifications'] = $notifications;

            return response()->json(['status'=>true,'data'=>$data, 'unread' => $notifications_unread]);

        }

        return response()->json(['status' => false, 'data' => '' , 'unread' => $notifications_unread]);

    }
    
    
    public function notifications(){
        return view('admin.dashboard.notifications');
    }
    
    public function send(Request $request){
        $name = $request->get('name');
        $details = $request->get('details');
        $os = $request->get('os');
        
        if($name == ''){
            return response()->json(['status' => false, 'message' => 'عنوان الاشعار مطلوب']);
        }
        
        if($details == ''){
            return response()->json(['status' => false, 'message' => 'تفاصيل الاشعار مطلوب']);
        }
        
        
                
                $cls = Clients::whereNull('deleted_at');
                 $cls = $cls->get();
        
                    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase_Credentials.json');

                    $firebase = (new Factory)

                    ->withServiceAccount($serviceAccount)
    
                        ->withDatabaseUri('https://majlabah.firebaseio.com/')
    
                        ->createMessaging();
                        
                        
                           
                           $AndroidConfig = AndroidConfig::fromArray([
                                'priority' => 1,
                                'notification' => [
                                     'title' =>  $name,
                                    'body' => $details,
                                    'color' => '#2e4b69',
                                     "sound"=> "default"
                                ],
                           ]);
                           
                        
                        $config = ApnsConfig::fromArray([
                                'headers' => [
                                    'apns-priority' => '10',
                                ],
                                'payload' => [
                                    'aps' => [
                                        'alert' => [
                                             'title' =>  $name,
                                            'body' => $details,
                                              
                                        ],
                                        'sound' => 'default',
                                        'badge' => 42,
                                    ],
                                ],
                            ]);
                            
                            
                        foreach( $cls as $cl){  
                        if($cl->fcm_token){
                          
                            try {
                                     
                                if($cl->os == 'android'){
                                        $message = CloudMessage::withTarget('token',$cl->fcm_token)->withAndroidConfig($AndroidConfig);
                                }else  {
                                       
                                        $message = CloudMessage::withTarget('token',$cl->fcm_token)->withApnsConfig($config); 
                                }
                               
                               $firebase->send($message);
                          

                            } catch (\Exception $e) {
// 
                                 $e;

                            }
                            
                    }

                        }
                        
                       return response()->json(['status' => true, 'message' => 'تم الإرسال بنجاح']);
    }
        
        
     public function send_client(Request $request){
        $name = $request->get('name');
        $details = $request->get('details');
        $client_id = $request->get('client_id');
        if($name == ''){
            return response()->json(['status' => false, 'message' => 'عنوان الاشعار مطلوب']);
        }
        
        if($details == ''){
            return response()->json(['status' => false, 'message' => 'تفاصيل الاشعار مطلوب']);
        }

        $cls = Clients::whereNull('deleted_at')->whereIn('id',$client_id);
                 $cls = $cls->get();
        
                    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/Firebase_Credentials.json');

                    $firebase = (new Factory)

                    ->withServiceAccount($serviceAccount)
    
                        ->withDatabaseUri('https://yagot-ad659.firebaseio.com')
    
                        ->createMessaging();
                        
                        
                           
                           $AndroidConfig = AndroidConfig::fromArray([
                                'priority' => 1,
                                'notification' => [
                                     'title' =>  $name,
                                    'body' => $details,
                                    'color' => '#2e4b69',
                                     "sound"=> "default"
                                ],
                           ]);
                           
                        
                        $config = ApnsConfig::fromArray([
                                'headers' => [
                                    'apns-priority' => '10',
                                ],
                                'payload' => [
                                    'aps' => [
                                        'alert' => [
                                             'title' =>  $name,
                                            'body' => $details,
                                              
                                        ],
                                        'sound' => 'default',
                                    ],
                                ],
                            ]);
                            
                            
                        foreach( $cls as $cl){  
                        if($cl->fcm_token){
                          
                            try {
                                     
                                if($cl->os == 'android'){
                                    $message = CloudMessage::withTarget('token', $cl->fcm_token)->withNotification(['title' => $name, 'body' => $details]);
                                    //$message = CloudMessage::withTarget('token',$cl->fcm_token)->withAndroidConfig($AndroidConfig);
                                }else{  
                                    $message = CloudMessage::withTarget('token',$cl->fcm_token)->withApnsConfig($config); 
                                }
                               
                               $firebase->send($message);

                               $n  = new MobileNotification();
                               $n->title = $name;
                               $n->message = $details;
                               $n->client_id = $cl->id;
                               $n->type = 1;
                               $n->save();
                               
                            } catch (\Exception $e) {
// 
                                 $e;

                            }
                            
                    }

                        }
                        
                       return response()->json(['status' => true, 'message' => 'تم الإرسال بنجاح']);

     }   
   

  

}