<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Models\Email;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use Eloquent;
use DB;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\DoctorDetails;
use App\Models\RoleUser;
use Zizaco\Entrust\Entrust;

class LoginController extends Controller
{
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

    use AuthenticatesUsers;

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
        //$this->middleware('guest')->except('logout');
    }


    public function index() {

        $user = Auth::user();
        //$id = Auth::id();
        //return $id;

        if(!isset($user->user_type)){
            return view('auth.login');
            exit;
        }
        if($user->hasRole(['admin','patient','doctor'])){
            $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
            //dd($userDetails);die;
           // $doctorDetails = DoctorDetails::where('user_id','=',$user->id)->get()->first();
            //dd($doctorDetails);die;
            $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'user_type'=>$user->user_type];
            Session::put('user',$user_session);

            return redirect('/admin/admin-dashboard');
        }else{
            //Session::flush();
            //return redirect('/');
        }

/*
       if($user->hasRole(['admin', 'doctor', 'clinic_attendant', 'pharmacy_admin', 'pharmacy_attendant'])){
            $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
            $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'company'=>$user->company_id, 'user_type'=>$user->user_type ];
            Session::put('user',$user_session);
            return redirect('/client/doctor');
        }elseif($user->hasRole('patient')){
           $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
           $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'company'=>$user->company_id, 'user_type'=>$user->user_type ];
           Session::put('user',$user_session);
       }else{
           //Session::flush();
           //return redirect('/');
       }*/

    }

    public function checklogin(Request $request) {

        //$input = $request->all();dd($input);
        $field = filter_var($request['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$field =>$request['username'], 'password' => $request['password'],'status'=>'Active'];

        if (Auth::attempt($credentials,$request->has('remember_me'))) {
            $user = Auth::user();
            $userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
            $doctorDetails = DoctorDetails::where('user_id','=',$user->id)->get()->first();
            $user_session=[ 'user_id'=>$user->id,'name'=>$userDetails->name,'username'=>$user->username,'email'=>$user->email, 'user_type'=>$user->user_type ];
            Session::put('user',$user_session);

            if($user->hasRole('admin')){
                return redirect('/admin/admin-dashboard');

            }elseif($user->hasRole('patient')){
                return redirect('/my-dashboard');

            }elseif ($user->hasRole('doctor')){
                return redirect('/admin/admin-dashboard');

            }/*elseif ($user->hasRole(['pharmacy_admin','pharmacy_attendant'])){
                return redirect('/admin/pharmacy-dashboard');

            }elseif ($user->hasRole('patient')){
                return redirect('/patient/appointment');

            }*/else{
                $request->session()->flush();
                return redirect('/');
            }
        }
        else{
            $request->session()->flush();
            return redirect('/');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

  public function registration(){
        return view('auth.registration');
    }

     /*public function registerStore(RegisterRequest $request){

        //$myrequest=$request->all();
        //dd($myrequest);

        //$date = Carbon::now()->format('Ymd');



        // echo $username;

        $obj = new User();
        $obj->email = $request['email'];
        $obj->username = $request['email'];
        $obj->user_type = 'patient';
        $obj->otp = $randomid = mt_rand(100000,999999);


        // $obj->status = $request['status'];
        $obj->save();
        $id = $obj->id;


        $obj1= new UserDetails();
        $obj1->user_id = $id;
        $obj1->name=$request['name'];
        $obj1->email=$request['email'];
        $obj1->phone=$request['phone'];

        $obj1->address=$request['address'];
        $obj1->save();

        DB::table('role_user')
            ->insert(['user_id' => $id, 'role_id' => 2]);
        //Session::flash('msg', $username);
        return redirect('/');


    }*/

    public function otpMail(RegisterRequest $request)
    {
        $obj = User::where('email','=',$request['email'])->get()->first();
        $otp = mt_rand(100000,999999);
        if(!isset($obj->email)) {
            $obj = new User();
            $obj->email = $request['email'];
            $obj->username = $request['email'];
            $obj->user_type = 'patient';
            $obj->password = '$2y$10$USeFoOOaZir8KiyMcj3LKe78V8lrM.VeDIEk3MVniQOQ3RHDLarE.';
            $obj->otp = $otp;
            $obj->save();

            $id = $obj->id;
            $obj1 = new UserDetails();
            $obj1->user_id = $id;
            $obj1->name = $request['name'];
            $obj1->email = $request['email'];
            $obj1->phone = $request['phone'];

            $obj1->address = $request['address'];
            $obj1->save();

            DB::table('role_user')
                ->insert(['user_id' => $id, 'role_id' => 2]);

            //$url=url('otp-validate'."/".$request['email']."/".$otp);
            //$urlencode=urlencode($url);
            $to_email = $obj->email;
            $subject = 'OTP Generate';
            $message = $contents = view('frontend.mail.otpMail', ['name' => $request['name'], 'email' => $request['email'], 'otp' => $otp])->render();
            $headers = 'From:' . \Config::get('env.service_mail');
            mail($to_email, $subject, $message, $headers);

            return redirect('/otp-form')
                ->with('email', $obj->email);
            //email to subscriber
            /*
             *  $data = ['name'=>$request['name'],'email'=>$request['subscribe_mail']];
             * Mail::send('frontend.mail.subscription', $data, function($message) use ($data) {
                $message->to($data['email'],'Subscriber')->subject('Subscription');
                $message->from('support@biopedclinic.com','Bioped Clinic');
            });
            echo 'Success';
            exit(0);
        }else{
            echo 'duplicate';
            exit(0);
        }

        echo 'failure';
        exit(0);*/

        }
    }

    public function otpValidate(){
        return view('auth.otpValidate');
    }
    public function otpValidation(){


    }


}
