<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Http\Requests\RegisterRequest;
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
use App\Models\User;
//use App\Models\UserDetails;
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
       }
*/
    }

    public function checklogin(Request $request) {

        //$input = $request->all();dd($input);
        $field = filter_var($request['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials = [$field =>$request['username'], 'password' => $request['password'],'status'=>'Active'];

        if (Auth::attempt($credentials,$request->has('remember_me'))) {
            $user = Auth::user();
            //$userDetails = UserDetails::where('user_id','=',$user->id)->get()->first();
            $user_session=[ 'user_id'=>$user->id,'username'=>$user->username,'email'=>$user->email ];
            Session::put('user',$user_session);

            if($user->hasRole('admin')){
                return redirect('/admin/admin-dashboard');

            }/*elseif($user->hasRole('doctor')){
                return redirect('/admin/doctor-dashboard');

            }elseif ($user->hasRole('clinic_attendant')){
                return redirect('/admin/agent-dashboard');

            }elseif ($user->hasRole(['pharmacy_admin','pharmacy_attendant'])){
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

   /* public function registerStore(RegisterRequest $request){

        //$myrequest=$request->all();
        //dd($myrequest);

        $date = Carbon::now()->format('Ymd');

        $getSeqNo = User::selectRaw('MAX(CAST(SUBSTRING(username, 10, 4) AS unsigned)) AS maxuser')
            ->where('username', 'like', $date . "P%")
            ->get()
            ->first();
        if ($getSeqNo->maxuser == NULL) {
            $username = $date . "P0001";
        } elseif ($getSeqNo->maxuser < 9) {
            $username = $date . "P000" . ++$getSeqNo->maxuser;
        } elseif ($getSeqNo->maxuser < 99) {
            $username = $date . "P00" . ++$getSeqNo->maxuser;
        } elseif ($getSeqNo->maxuser < 999) {
            $username = $date . "P0" . ++$getSeqNo->maxuser;
        } else {
            $username = $date . "P" . ++$getSeqNo->maxuser;
        }
        // echo $username;

        $obj = new User();
        $obj->email = $request['email'];
        $obj->username = $username;
        $obj->user_type = 'patient';
        $obj->password = Hash::make($request['dob']);
        // $obj->status = $request['status'];
        $obj->save();
        $id = $obj->id;


        $obj1= new UserDetails();
        $obj1->user_id = $id;
        $obj1->name=$request['name'];
        $obj1->email=$request['email'];
        $obj1->mobile=$request['mobile'];
        $obj1->sex=$request['sex'];
        $obj1->dob=$request['dob'];
        $obj1->address=$request['address'];
        $obj1->save();

        DB::table('cn_role_user')
            ->insert(['user_id' => $id, 'role_id' => 4]);
        Session::flash('msg', $username);
        return redirect('user-welcome');


    }*/



}
