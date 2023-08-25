<?php
namespace App\Http\Controllers\Auth;

use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\OtpFormRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetMailRequest;
use App\Models\User;
use App\Models\Employeepersonal;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Datetime;

use Hash;
use Mail;
use Session;
use Redirect;
use Alert;

use Eloquent;
use DB;

use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
public $successStatus = 200;
  
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //  use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');

    }

    public function index() {
        $user = Auth::user();
         if(!isset($user->id)){
            return view('auth.login');
            exit;
        }
      if(!empty($user)){
        $user_session=[ 'user_id'=>$user->id,'email'=>$user->email,'employee_id'=>$user->employee_id,'role_id'=>$user->role_id];
        Session::put('user',$user_session);        
        return redirect('/admin/admin-dashboard');
      }
      else{
        $request->session()->flush();
        return redirect('/');
      }
    }

    public function checklogin(Request $request) {
		$input = $request->all();  
        if(Auth::attempt(['username'=>$input['username'],'password'=>$input['password']])){
			    $user = Auth::user(); 

          $userRoll = User::select('users.*') 
                            ->where('username','=',$input['username'])        
                            ->where('role_id','=',$input['role_id'])
                            ->get()->first();
                                        
            if(!empty($userRoll)){        
              $userDetails = Employeepersonal::select('master_employee.*')         
                                              ->where('emp_no','=',$user->username)
                                              ->get()->first();
        
              $user_session=[ 'user_id'=>$user->id,'email'=>$user->email,'employee_name'=>$userDetails['name'],'role_id'=>$input['role_id'],
                              'emp_id'=>$userDetails['emp_no']];
                  
              Session::put('user',$user_session);
              //Update last login time and login from post login
              date_default_timezone_set('Asia/Kolkata');
              $currentDatetime = new DateTime();
              $userRoll->last_logged_in = $currentDatetime->format('Y-m-d H:i:s'); 
              $userRoll->log_in_from = "WEB";
              $userRoll->update(); 
              return redirect('/admin/admin-dashboard');
              return redirect('/admin/admin-dashboard');    
            }else{
              $request->session()->flush();
              return redirect('/login')->with('msg',"You have selected wrong role");
            }
        }else{
          $request->session()->flush();
          return redirect('/login')->with('msg',"User credentials mismatch");
      } 
    }

    public function logout(Request $request){
        $request->session()->flush();
        // dd($request);
        Auth::logout();
        return redirect('/login');
        
// then redirect to login
//return redirect()->route('login');
    }
	
    public function forgotPassword(){  
        return view('auth.forgotPassword');
    }
	
    public function forget(Request $request){
       $obj = User::where('email', '=', $request['email'])->get()->first();
      // dd( $obj);
        if (isset($obj->email)) {
          //dd($obj->email);
             $matchemail=$obj->email = $request['email'];
            $pass= $obj->password = Hash::make('123456');
           // dd($pass);
             $obj->save();           
//dd($request);
        $url=url('/');
        $mailsend=User::where('email','=',$request['email'])->get()->first(); 
        $data=['subject'=>'Incident-Reporting','email'=>$mailsend['email'],'name'=>$mailsend['employee_name'],'url'=>$url];
		
		Mail::send('admin.mail.forgetmail', $data, function($message) use ($data) {
            $message->to($data['email'])->subject($data['subject']);
			//dd($message);
		   // $message->from(env('service_mail'),'Incident-Reporting');
			$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
         });
			return redirect('/reset')
			->with('msg',"Please Check Email For Reset Link");//sesssion msg
       }else{
            return redirect('/forgotpass')
                ->with('message',"Email does not exist");
        } 
    }
	
     public function reset(){
        $msg=Session::get('msg');//get session msg
        return view('auth.reset')
            ->with('msg',$msg);
    }
    

    
}
