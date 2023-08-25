<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Laravel\Passport\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\RedirectResponse;

use App\Helpers\UserHelper;

use App\Branch;

use App\AdminKPI_last_month;

use App\AdminKPI_Backlog_Tabular;

use App\AdminKPI_Backlog_Tabular_LastMonth;

use App\AdminKPI_lastQuarter_Financial;

use Lcobucci\JWT\Parser;
use App\Models\Incident;
use App\Models\User;
use App\Models\Employeepersonal;
use App\Activities;
use App\Models\Reportingm;
use App\Models\Zonalad;
use App\Models\Date_range_picker;
use App\Models\SHcomment;
use App\Models\AHcomment;

use Session;
use JWTAuth;
use File;
use Hash;
use Eloquent;

use Mail;
use Input;

use DB;

use DataTables;
use App\Models\District;
use App\Models\State;
use App\Models\City;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\Role;


use Carbon\Carbon ;

class ApiController extends Controller 
{
public $successStatus = 200;

/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
        if($request['forgot_password']==1)
        {
            $obj = User::where('email', '=', $request['email'])->get()->first();
			if (isset($obj->email)) {

				$matchemail=$obj->email = $request['email'];
				$pass= $obj->password = Hash::make('123456');
				$obj->save();
           
				$url=url('/login');
				$mailsend=User::where('email','=',$request['email'])->get()->first();
				$data=['subject'=>'Incident-Reporting','email'=>$mailsend['email'],'name'=>$mailsend['employee_name'],'url'=>$url];


				/*Mail::send('admin.mail.forgetmail', $data, function($message) use ($data) {

					$message->to($data['email'])->subject($data['subject']);
					//dd($message);
				   // $message->from(env('service_mail'),'Incident-Reporting');
					$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
				});*/

				return response()->json(['status'=>200,'message'=>'Your new password has been sent to your mail Successfully.'],200);
			}else{
				
				return response()->json(['status'=>401,'data'=>null,'message'=>'Sorry, Email does not exist.'], 401); 
			}


        }
        else{
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
				$user = Auth::user(); 
				$successStatus = 200;
				$all=User::select('*')
					->where('id','=',$user->parent_id)
					->first();
				$zonal=User::select('*')
					->where('role_id','=','3' )
					->where('zone_id','=',$user->zone_id)
					->first();
				$success =  $user->createToken('incident')-> accessToken; 
				$shInfo = User::select('*')
					->where('role_id','=','4')
					->first();
				$ahInfo = User::select('*')
					->where('role_id','=','5')
					->first();
				$post_data=null;
				
				$post_data =array('user' => $user,'reportingmanager'=>$all,'zonalmanager'=>$zonal,'SHinfo'=>$shInfo,'AHinfo'=>$ahInfo);
         
				return response()->json(['status'=>$successStatus,'message'=>'You have been successfully logged in.',"data"=> $post_data,'access_token' => $success], $this-> successStatus); 
			} 
			else{ 
				return response()->json(['status'=>401,'data'=>null,'message'=>'Sorry, User credentials mismatch.'], 401); 
			} 

        }
    }
	
	public function logout(Request $request){

        Auth::logout();
		$response = ['message' => 'You have been successfully logged out!'];
		return response($response, 200);

    }

    public function information(){
        
         $user = Auth::user();
		 //dd($user);
			$post_data=null;
            $Count=null;
            $Open=null;
            $Close=null;
            $opentable=null;
            $closetable=null;
         //meta table
         //type
          $incident=Incident_type::select('*')->get();
          //dd($incident);
          //status
           $status_type=Status_type::select('*')->get();
         // dd($user);
           //state
            $state=State::select('*')->get();
            //city
            $city=City::select('*')->get();
            //district
            $district=District::select('*')->get();
            //designation
             $designation=Role::select('*')->get();
			 
        $meta_obj =array('type_of_incident' => $incident,'status_type'=>$status_type,'state'=>$state,'city'=>$city,'district'=>$district,'designation'=>$designation);
       // dd($meta_obj);
         //Personal Info and Health info
          $personal_info=Employeepersonal::select('employee_personal_information.*')
            ->where('user_id','=',$user['id'])
          ->get()->first();
         
           $reportingManager=Employeepersonal::select('users.employee_name as reportingManager')
          ->join('users','users.id','=','employee_personal_information.employee_reportingmanager')
            ->where('user_id','=',$user['id'])
          ->get()->first();
		  //dd($reportingManager);

          $zonalManager=Employeepersonal::select('users.employee_name as zonalManager')
          ->join('users','users.id','=','employee_personal_information.zonal_manager')
            ->where('user_id','=',$user['id'])
          ->get()->first();

           $admin=Employeepersonal::select('users.employee_name as adminhead')
          ->join('users','users.id','=','employee_personal_information.admin_head')
            ->where('user_id','=',$user['id'])
          ->get()->first();

            $safety=Employeepersonal::select('users.employee_name as safety')
          ->join('users','users.id','=','employee_personal_information.safety_head')
            ->where('user_id','=',$user['id'])
          ->get()->first();
            $personal_info['employee_reportingmanager']=$reportingManager['reportingManager'];
            $personal_info['zonal_manager']=$zonalManager['zonalManager'];
            $personal_info['admin_head']=$admin['adminhead'];
            $personal_info['safety_head']=$safety['safety'];

        $datePicker = Date_range_picker::get()->first();
		//saheli
		$sh_need_info=SHcomment::select('comment_id','incident_id','flag')->get();
		$ah_need_info=AHcomment::select('comment_id','incident_id','flag')->get();
		
		//SH table
		$shedit=Incident::select('incident.id as in_id','sh_comment.*')
         ->join('sh_comment', 'sh_comment.incident_id', '=', 'incident.id')
          //->where('incident.id','=',$id)
          ->whereNotNull('sh_comment.comment_name')
        ->get()->toArray();
		if(empty($shedit)){

          $emptyza=[];

        }else{
          $shedit=$shedit;
        }
		
		//AH table
		$ahedit=Incident::select('incident.id as in_id','ah_comment.*')
         ->join('ah_comment', 'ah_comment.incident_id', '=', 'incident.id')
          //->where('incident.id','=',$id)
		  ->whereNotNull('ah_comment.comment_name')
        ->get()->toArray();
		if(empty($ahedit)){

          $emptyza=[];

        }else{
          $ahedit=$ahedit;
        }
		
           //Incident Table Role wise
//dd($sh_need_info_status);
           if($user['role_id'] == '2')
          {

         $table=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.parent_id','inci_type.incident_t as actiontype')
        ->join( 'users','users.id', '=', 'incident.user_id'  )
       ->join('city', 'city.id', '=', 'incident.city')
         ->join('state', 'state.id', '=', 'incident.state')
         ->join('district', 'district.id', '=', 'incident.district')
         ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
         ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
          ->where('incident.save_draft','=','1')
        ->where('users.parent_id', '=',   $user['id'])
        ->get();
        
          $tablerm=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.parent_id','inci_type.incident_t as actiontype')
        ->join( 'users','users.id', '=', 'incident.user_id'  )
       ->join('city', 'city.id', '=', 'incident.city')
         ->join('state', 'state.id', '=', 'incident.state')
         ->join('district', 'district.id', '=', 'incident.district')
         ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
         ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
          //->where('incident.save_draft','=','1')
        ->where('user_id', '=', $user['id'])
        ->get();
		
		//dashboad data and total
		  $Count=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
        ->where('save_draft','=','1')
        ->get()->count();

         $Open=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('save_draft','=','1')
        ->where('status_e','=','1')
        ->get()->count();
        //close
        $Close=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
        ->where('status_e','=','0')
        ->get()->count();



             $totaltable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('incident.save_draft','=','1')
       ->get();

        $opentable=  Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('incident.save_draft','=','1')
        ->where('status_e','=','1')
       ->get();
         $closetable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      ->where('parent_id','=',$user->id)
       ->where('zone_id','=',$user->zone_id)
        ->where('status_e','=','0')
       ->get();
	   
	   $rmComment = Incident::select('incident.id as in_id','reporting_manager.rm_comment','reporting_manager.rm_date','reporting_manager.rm_time','reporting_manager.id as rm_id','users.id as user_id')
            ->leftjoin('reporting_manager','reporting_manager.incident_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
		$zaComment = Incident::select('incident.id as in_id','zonal_admin.za_comment','zonal_admin.za_date','zonal_admin.za_time','zonal_admin.id as za_id','users.id as user_id')
            ->leftjoin('zonal_admin','zonal_admin.incidentza_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
		//dd($rmComment);

          //dd( $table);
          $post_data =array('personal_info' => $personal_info,'datePicker' => $datePicker->date_range,'rmComment'=>$rmComment,'zaComment'=>$zaComment,'shtable'=>$shedit,'ahtable'=>$ahedit,'sh_need_info' => $sh_need_info,'ah_need_info' => $ah_need_info,'self_incidents'=>$tablerm,'incidents_reported'=>$table,'employee_total_incident'=>$totaltable,'employee_open_incident'=>$opentable,'employee_close_incident'=>$closetable,'total'=> $Count,'open'=> $Open,'close'=>  $Close);
         return response()->json(['status'=>200,'message'=>'Data found Successfully.',"data"=> $post_data,'meta_data'=>$meta_obj],200);
          

        

            }
            elseif($user['role_id'] == '1' ){ 

        $table=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype')
        ->join('city', 'city.id', '=', 'incident.city')
         ->join('state', 'state.id', '=', 'incident.state')
         ->join('district', 'district.id', '=', 'incident.district')
           ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
         ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
         ->where('user_id','=',$user['id'])->get();
		 
		 
		 //dashboad total and data
		          //total
        $Count=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('user_id','=',$user->id)
	   ->where('save_draft','=','1')
        
        ->get()->count();
//open
        $Open=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('user_id','=',$user->id)
	   ->where('save_draft','=','1')
       ->where('status_e','=','1')
        
        ->get()->count();
        //close
        $Close=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->where('user_id','=',$user->id)
      ->where('status_e','=','0')
        
        ->get()->count();


        $totaltable=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
        ->where('user_id','=',$user->id)
		->where('incident.save_draft','=','1')->get();
		
        $opentable= Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
       ->where('user_id','=',$user->id)
	   ->where('incident.save_draft','=','1')
      ->where('status_e','=','1')
        
        ->get();
         $closetable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
       ->where('user_id','=',$user->id)
      ->where('status_e','=','0')
        
        ->get();

          $post_data =array('personal_info' => $personal_info,'datePicker' => $datePicker->date_range,'self_incidents'=>$table,'employee_total_incident'=>$totaltable,'employee_open_incident'=>$opentable,'employee_close_incident'=>$closetable,'total'=> $Count,'open'=> $Open,'close'=>  $Close);
         return response()->json(['status'=>200,'message'=>'Data found Successfully.',"data"=> $post_data,'meta_data'=>$meta_obj],200);
            // dd($table);
               }
            elseif($user['role_id'] == '3'){
            //  echo'jghkuhu';
            
                  // if( $userzone_id=='1')  

                  // { 
                   $table=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.zone_id','inci_type.incident_t as actiontype')
        ->join( 'users','users.id', '=', 'incident.user_id'  )
       ->join('city', 'city.id', '=', 'incident.city')
         ->join('state', 'state.id', '=', 'incident.state')
         ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
         ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
       ->where('incident.save_draft','=','1')
        ->where('users.zone_id', '=', $user['zone_id'])->get();


    
          $tablerm=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.parent_id','inci_type.incident_t as actiontype')
        ->join( 'users','users.id', '=', 'incident.user_id'  )
       ->join('city', 'city.id', '=', 'incident.city')
         ->join('state', 'state.id', '=', 'incident.state')
         ->join('district', 'district.id', '=', 'incident.district')
         ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
         ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
          //->where('incident.save_draft','=','1')
        ->where('user_id', '=',$user['id'])
        
        ->get();
		//dashboad total and data
		 $Count=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
     //  ->where('parent_id','=',$user_id)
       ->where('zone_id','=',$user->zone_id)
        ->where('save_draft','=','1')
        ->get()->count();

         $Open=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       //->where('parent_id','=',$user_id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('save_draft','=','1')
        ->where('status_e','=','1')
        ->get()->count();
        //close
        $Close=Incident::select('*','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       //->where('parent_id','=',$user_id)
       ->where('zone_id','=',$user->zone_id)
        ->where('status_e','=','0')
        ->get()->count();



             $totaltable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      //->where('parent_id','=',$user_id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('incident.save_draft','=','1')
       ->get();

        $opentable= Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      //->where('parent_id','=',$user_id)
       ->where('zone_id','=',$user->zone_id)
	   ->where('incident.save_draft','=','1')
        ->where('status_e','=','1')
       ->get();
         $closetable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
       ->join('users', 'users.id', '=', 'incident.user_id')
       ->join('city', 'city.id', '=', 'incident.city')
        ->join('state', 'state.id', '=', 'incident.state')
        ->join('district', 'district.id', '=', 'incident.district')
          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
        ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
      //->where('parent_id','=',$user_id)
        ->where('zone_id','=',$user->zone_id)
        ->where('status_e','=','0')
       ->get();
	   
	   $rmComment = Incident::select('incident.id as in_id','reporting_manager.rm_comment','reporting_manager.rm_date','reporting_manager.rm_time','reporting_manager.id as rm_id','users.id as user_id')
            ->leftjoin('reporting_manager','reporting_manager.incident_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
		$zaComment = Incident::select('incident.id as in_id','zonal_admin.za_comment','zonal_admin.za_date','zonal_admin.za_time','zonal_admin.id as za_id','users.id as user_id')
            ->leftjoin('zonal_admin','zonal_admin.incidentza_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
		
        $post_data =array('personal_info' => $personal_info,'datePicker' => $datePicker->date_range,'rmComment'=>$rmComment,'zaComment'=>$zaComment,'shtable'=>$shedit,'ahtable'=>$ahedit,'sh_need_info' => $sh_need_info,'ah_need_info' => $ah_need_info,'self_incidents'=>$tablerm,'incidents_reported'=>$table,'employee_total_incident'=>$totaltable,'employee_open_incident'=>$opentable,'employee_close_incident'=>$closetable,'total'=> $Count,'open'=> $Open,'close'=>  $Close);
		
         return response()->json(['status'=>200,'message'=>'Data found Successfully.',"data"=> $post_data,'meta_data'=>$meta_obj],200);
            
        }
			elseif($user['role_id'] == '4')
			{
				$table=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','inci_type.incident_t as actiontype')
				->join( 'users','users.id', '=', 'incident.user_id'  )
				->join('city', 'city.id', '=', 'incident.city')
				->join('state', 'state.id', '=', 'incident.state')
				->join('district', 'district.id', '=', 'incident.district')
			   ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->join('status_type', 'status_type.id', '=', 'incident.injured_status')
				->where('incident.save_draft','=','1')
				 // ->get();
			   
				   //->where('incident.action_comment','!=','')
				   //->where('incident.zonal_comment','!=','')
				   ->get();

					 $tablerm=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.parent_id','inci_type.incident_t as actiontype')
			->join( 'users','users.id', '=', 'incident.user_id'  )
		   ->join('city', 'city.id', '=', 'incident.city')
			 ->join('state', 'state.id', '=', 'incident.state')
			 ->join('district', 'district.id', '=', 'incident.district')
			 ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			 ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
			  //->where('incident.save_draft','=','1')
			->where('user_id', '=',$user['id'])
			
			->get();
				 //dashboad total and data 
					 $Count=Incident::select('*','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		   ->where('save_draft','=','1')
		 //  ->where('parent_id','=',$user_id)
		   //->where('zone_id','=',$userzone_id)
			
			->get()->count();
	//pendingrm
			//Saheli
			$Open=Incident::select('incident.id','reporting_manager.*','zonal_admin.*')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->whereIn('sh_comment.flag',array(2,0))
				/*->where('sh_comment.flag','=','2')
				->whereNotNull('zonal_admin.za_comment')
				->whereNull('reporting_manager.rm_comment')*/
				->get()->count();
			//close
			$Close=Incident::select('incident.id','reporting_manager.*','zonal_admin.*')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->whereIn('sh_comment.flag',array(1,0))
				/*->where('sh_comment.flag','=','1')
				->whereNotNull('reporting_manager.rm_comment')
				->whereNull('zonal_admin.za_comment')*/
				->get()->count();
	
	
				 $totaltable=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		   ->join('city', 'city.id', '=', 'incident.city')
			->join('state', 'state.id', '=', 'incident.state')
			->join('district', 'district.id', '=', 'incident.district')
			  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			->join('status_type', 'status_type.id', '=', 'incident.injured_status')
			 ->where('incident.save_draft','=','1')
		   ->get();
		   //dd($totaltable);
	//pending rm
			//saheli
		   $closetable =  Incident::select('incident.id as in_id','incident.*','reporting_manager.rm_comment','zonal_admin.za_comment','state.name as staname','city.name','district.name as disname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('state','state.id','=','incident.state')
				->leftjoin('city','city.id','=','incident.city')
				->leftjoin('district', 'district.id', '=', 'incident.district')
				->leftjoin('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->leftjoin('status_type', 'status_type.id', '=', 'incident.injured_status')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				//->where('sh_comment.flag','=','1')
				->whereIn('sh_comment.flag',array(1,0))
				//->whereNotNull('reporting_manager.rm_comment')
				//->whereNull('zonal_admin.za_comment')
				->get();
		   //pending za
			 $opentable = Incident::select('incident.id as in_id','incident.*','reporting_manager.rm_comment','zonal_admin.za_comment','state.name as staname','city.name','district.name as disname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('state','state.id','=','incident.state')
				->leftjoin('city','city.id','=','incident.city')
				->leftjoin('district', 'district.id', '=', 'incident.district')
				->leftjoin('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->leftjoin('status_type', 'status_type.id', '=', 'incident.injured_status')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				//->where('sh_comment.flag','=','2')
				->whereIn('sh_comment.flag',array(2,0))
				//->whereNotNull('zonal_admin.za_comment')
				//->whereNull('reporting_manager.rm_comment')
				->get();
		   
		   
		$rmComment = Incident::select('incident.id as in_id','reporting_manager.rm_comment','reporting_manager.rm_date','reporting_manager.rm_time','reporting_manager.id as rm_id','users.id as user_id')
            ->leftjoin('reporting_manager','reporting_manager.incident_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
		$zaComment = Incident::select('incident.id as in_id','zonal_admin.za_comment','zonal_admin.za_date','zonal_admin.za_time','zonal_admin.id as za_id','users.id as user_id')
            ->leftjoin('zonal_admin','zonal_admin.incidentza_id','=','incident.id')
			->leftjoin('users', 'users.id', '=', 'incident.user_id')
			->where('zone_id','=',$user->zone_id)
			->get();
			
			//$sh_cmnt_chk=SHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->first();
			//$ah_cmnt_chk=AHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->first();

			 $post_data =array('personal_info' => $personal_info,'datePicker' => $datePicker->date_range,'rmComment' => $rmComment,'zaComment' => $zaComment,'shtable'=>$shedit,'ahtable'=>$ahedit,'sh_need_info' => $sh_need_info,'ah_need_info' => $ah_need_info,'self_incidents'=>$tablerm,'incidents_reported'=>$table,'employee_total_incident'=>$totaltable,'employee_open_incident'=>$opentable,'employee_close_incident'=>$closetable,'total'=> $Count,'open'=> $Open,'close'=>  $Close);
			 return response()->json(['status'=>200,'message'=>'Data found Successfully.',"data"=> $post_data,'meta_data'=>$meta_obj],200);
			 }
			  elseif($user['role_id'] == '5')
			{
				$table=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','inci_type.incident_t as actiontype')
				->join( 'users','users.id', '=', 'incident.user_id'  )
				->join('city', 'city.id', '=', 'incident.city')
				->join('state', 'state.id', '=', 'incident.state')
				->join('district', 'district.id', '=', 'incident.district')
			   ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->join('status_type', 'status_type.id', '=', 'incident.injured_status')
				->where('incident.save_draft','=','1')
				 // ->get();
			   
				   //->where('incident.action_comment','!=','')
				   //->where('incident.zonal_comment','!=','')
				   ->get();

					 $tablerm=Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','users.id','users.parent_id','inci_type.incident_t as actiontype')
			->join( 'users','users.id', '=', 'incident.user_id'  )
		   ->join('city', 'city.id', '=', 'incident.city')
			 ->join('state', 'state.id', '=', 'incident.state')
			 ->join('district', 'district.id', '=', 'incident.district')
			 ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			 ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
			  //->where('incident.save_draft','=','1')
			->where('user_id', '=',$user['id'])
			
			->get();
				  //dashboad count total and data 
				  $Count=Incident::select('*','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		   ->where('save_draft','=','1')
		 //  ->where('parent_id','=',$user_id)
		   //->where('zone_id','=',$userzone_id)
			
			->get()->count();
	//pendingrm
			//Saheli
			$Open=Incident::select('incident.id','reporting_manager.*','zonal_admin.*')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->whereIn('sh_comment.flag',array(2,0))
				/*->where('sh_comment.flag','=','2')
				->whereNotNull('zonal_admin.za_comment')
				->whereNull('reporting_manager.rm_comment')*/
				->get()->count();
				
			//close
			$Close=Incident::select('incident.id','reporting_manager.*','zonal_admin.*')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->whereIn('sh_comment.flag',array(1,0))
				/*->where('sh_comment.flag','=','1')
				->whereNotNull('reporting_manager.rm_comment')
				->whereNull('zonal_admin.za_comment')*/
				->get()->count();


				 $totaltable=Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		   ->join('city', 'city.id', '=', 'incident.city')
			->join('state', 'state.id', '=', 'incident.state')
			->join('district', 'district.id', '=', 'incident.district')
			  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			->join('status_type', 'status_type.id', '=', 'incident.injured_status')
			 ->where('incident.save_draft','=','1')
		  //->where('parent_id','=',$user_id)
		  // ->where('zone_id','=',$userzone_id)
		   ->get();
	//pending rm
			/*$opentable=  Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		 ->join('city', 'city.id', '=', 'incident.city')
			->join('state', 'state.id', '=', 'incident.state')
			->join('district', 'district.id', '=', 'incident.district')
			  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			->join('status_type', 'status_type.id', '=', 'incident.injured_status')
			 ->where('incident.save_draft','=','1')
		 ->whereNull('incident.action_comment')
		 ->whereNotNull('incident.zonal_comment')

		// ->where('zone_id','=',$userzone_id)
		   ->get();
		   //pending za
			 $closetable= Incident::select('*','incident.id as in_id','city.name','district.name as disname','state.name as staname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
		   ->join('users', 'users.id', '=', 'incident.user_id')
		 ->join('city', 'city.id', '=', 'incident.city')
			->join('state', 'state.id', '=', 'incident.state')
			->join('district', 'district.id', '=', 'incident.district')
			  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
			->join('status_type', 'status_type.id', '=', 'incident.injured_status')
		 ->whereNull('incident.zonal_comment')
		 ->whereNotNull('incident.action_comment')

		// ->where('zone_id','=',$userzone_id)
		   ->get();*/
		   
		   //saheli
		   $closetable =  Incident::select('incident.id as in_id','incident.*','reporting_manager.rm_comment','zonal_admin.za_comment','state.name as staname','city.name','district.name as disname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('state','state.id','=','incident.state')
				->leftjoin('city','city.id','=','incident.city')
				->leftjoin('district', 'district.id', '=', 'incident.district')
				->leftjoin('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->leftjoin('status_type', 'status_type.id', '=', 'incident.injured_status')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				//->where('sh_comment.flag','=','1')
				->whereIn('sh_comment.flag',array(1,0))
				//->whereNotNull('reporting_manager.rm_comment')
				//->whereNull('zonal_admin.za_comment')
				->get();
		   //pending za
			 $opentable = Incident::select('incident.id as in_id','incident.*','reporting_manager.rm_comment','zonal_admin.za_comment','state.name as staname','city.name','district.name as disname','status_type.status_name','inci_type.incident_t as actiontype','users.id')
				->leftjoin('sh_comment','sh_comment.incident_id','=','incident.id')
				->leftjoin('reporting_manager','reporting_manager.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('zonal_admin','zonal_admin.sh_cmnt_id','=','sh_comment.comment_id')
				->leftjoin('state','state.id','=','incident.state')
				->leftjoin('city','city.id','=','incident.city')
				->leftjoin('district', 'district.id', '=', 'incident.district')
				->leftjoin('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->leftjoin('status_type', 'status_type.id', '=', 'incident.injured_status')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				//->where('sh_comment.flag','=','2')
				->whereIn('sh_comment.flag',array(2,0))
				//->whereNotNull('zonal_admin.za_comment')
				//->whereNull('reporting_manager.rm_comment')
				->get();
		   
			$rmComment = Incident::select('incident.id as in_id','reporting_manager.rm_comment','reporting_manager.rm_date','reporting_manager.rm_time','reporting_manager.id as rm_id','users.id as user_id')
				->leftjoin('reporting_manager','reporting_manager.incident_id','=','incident.id')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				->where('zone_id','=',$user->zone_id)
				->get();
			$zaComment = Incident::select('incident.id as in_id','zonal_admin.za_comment','zonal_admin.za_date','zonal_admin.za_time','zonal_admin.id as za_id','users.id as user_id')
				->leftjoin('zonal_admin','zonal_admin.incidentza_id','=','incident.id')
				->leftjoin('users', 'users.id', '=', 'incident.user_id')
				->where('zone_id','=',$user->zone_id)
				->get();
		    
			//$sh_cmnt_chk=SHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->first();
			//$ah_cmnt_chk=AHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->first();

			 $post_data =array('personal_info' => $personal_info,'datePicker' => $datePicker->date_range,'rmComment' => $rmComment,'zaComment' => $zaComment,'shtable'=>$shedit,'ahtable'=>$ahedit,'sh_need_info' => $sh_need_info,'ah_need_info' => $ah_need_info,'self_incidents'=>$tablerm,'incidents_reported'=>$table,'employee_total_incident'=>$totaltable,'employee_open_incident'=>$opentable,'employee_close_incident'=>$closetable,'total'=> $Count,'open'=> $Open,'close'=>  $Close);
			 return response()->json(['status'=>200,'message'=>'Data found Successfully.',"data"=> $post_data,'meta_data'=>$meta_obj],200);
			 }

   
   }
    
	public function informationedit(Request $r){
      //dd($r);
         //dd($r);
         $user = Auth::user();
         //dd($user['id']);
     $bothtable = Employeepersonal::select('*')->where('user_id','=', $user['id'])->get('id');
     //dd($bothtable[0]->id);
        $obj=Employeepersonal::find($bothtable[0]->id);
    //dd($obj['id']);
		if($r['changepassword'] == 1){
			$changepassword=User::find($user['id']);
			$changepassword->password=Hash::make($r['password']);
        
			$obj->update();
			return response()->json(['status'=>200,'message'=>'Your password has been successfully updated.'],200);

		}elseif($r['employee_grade']!= null && $r['employee_email']!= null){
      //echo "hi1";
		$obj->employee_id=$r['empId'];
        $obj->employee_name=$r['employee_name']; 
        $obj->employee_grade=$r['employee_grade'];
        $obj->employee_email=$r['employee_email'];
        $obj->employee_age=$r['employee_age'];
        $obj->employee_sex=$r['employee_sex'];
        $obj->employee_dob= Carbon::createFromFormat('d/m/Y', $r['employee_dob'])->format('Y-m-d');
        $obj->employee_doj= Carbon::createFromFormat('d/m/Y', $r['employee_doj'])->format('Y-m-d');
        $obj->employee_designation=$r['employee_designation'];
        $obj->employee_department=$r['employee_department'];
        $obj->employee_salesoffice=$r['employee_salesoffice'];
        $obj->employee_zone=$r['employee_zone'];
        $obj->employee_mobile=$r['employee_mobile'];
        $obj->employee_address=$r['employee_address'];
        $obj->save();
		
		$users_data = User::where('id','=', $user['id'])->get()->first();
		$users_data->employee_name=$r['employee_name']; 
		$users_data->email=$r['employee_email']; 
		$users_data->phone_number=$r['employee_mobile']; 
		$users_data->save(); 
		
		
        return response()->json(['status'=>200,'message'=>'Personal Information updated Successfully.'],200);
    }elseif($r['emergency_contactname']!= null && $r['blood_group']!= null){
    //echo "hi";
     
        $obj->emergency_contactname=$r['emergency_contactname'];
        $obj->blood_group=$r['blood_group'];
        $obj->emergency_number=$r['mobile'];
        $obj->diabetic=$r['is_diabetic'];
         $obj->sinus=$r['is_sinus'];
        // $obj->employee_dob=$r['Status'];
    
        $obj->bp_problem=$r['is_bp_problem'];
        $obj->allergic=$r['is_allergic'];
        $obj->information_share=$r['information'];
        $obj->illness=$r['is_illness'];
       
    
        $obj->save();
        return response()->json(['status'=>200,'message'=>'Health Information updated Successfully.'],200);
    }else{
      return response()->json(['status'=>401,'message'=>'sorry...!something went wrong.'],401);
  }

         
    }

//change
	public function incident(Request $r){
	    
		$user = Auth::user();

		if($r['incident_id']==null){
	 
			$obj= new Incident;
			$obj->user_id=$user['id']; 
			$obj->employee_name=$r['employee_name'];
			$obj->incident_date= Carbon::createFromFormat('d/m/Y', $r['incident_date'])->format('Y-m-d');
			$obj->incident_time=$r['incident_time'];
			 $obj->inc_type=$r['inc_type'];
			$obj->incident_location=$r['incident_location'];
			$obj->incident_description=$r['incident_description'];
			$obj->injured_status=$r['injured_status'];
			$obj->city=$r['city'];
			$obj->district=$r['district'];
			$obj->state=$r['state'];
			$obj->save_draft=$r['is_submit'];
			if(!empty($r['Image'])){
				$image = $r['Image'];
				//generating unique file name;
				$file_name = 'image_'.time().'.png';

				// storing image in storage/app/public Folder
				\Storage::disk('local')->put($file_name,base64_decode($image));
			}
			else {

				$image = '';

			}

			$obj->image = $image;
		  
			$obj->save();
			
			$sh_cmnt = new SHcomment;
			$sh_cmnt->status = 'Normal Comment';
			$sh_cmnt->incident_id = $obj->id;
			$sh_cmnt->flag = '0';
			$sh_cmnt->save();
		   
			if($r['is_submit'] == 1 ){
				$url=url('/login');
				/*$mailsend=User::select('email')   
				->where('zone_id','=',$user['zone_id'])
				->where('role_id','!=','1')
				->orwhere('role_id','=','4')
				->orwhere('role_id','=','5')
				->groupby('email')
				->get()->toArray();*/
				//saheli
				$mailtoadmins = User::select('email')->where('role_id','=','4')
					->orWhere('role_id','=','5');
			
				$mailsend = User::select('email')
				->Where('role_id','=','3')
				->where('zone_id','=',$user['zone_id'])
				->ORwhere('id','=', $user['parent_id'])
				->union($mailtoadmins)
				->groupby('email')
				->get()->toArray();
				//saheli
				//dd($mailsend);
				foreach ($mailsend as $mailone){
					$to_mail=$mailone['email'];
					$data=['subject'=>'Incident-Reporting','email'=>$to_mail, 'name'=> $obj['employee_name'],'url'=>$url];

					Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

						$message->to($data['email'])->subject($data['subject']);
					  
						$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
					});
				}
				 $post_data =array('data' => $obj);
				
			   
				return response()->json(['message'=>'Your incident has been successfully submitted.',"incident"=> $post_data], 200);

			}else{
			 
				 $post_data =array('data' => $obj);

			   
				return response()->json(['message'=>'Your incident has been successfully saved as draft.',"incident"=> $post_data], 200);
			}

		}else{
			$edit=Incident::find($r['incident_id']);
			
			if($r['is_rm_comment']==1){
				$rmdata=null;
				$emptyrm=null;
		   
				$rm=new Reportingm;
				$rm->incident_id=$r['incident_id'];
				$rm->rm_date= Carbon::createFromFormat('d/m/Y', $r['managerdate'])->format('Y-m-d');
				$rm->rm_time=$r['managertime'];
				$rm->rm_comment=$r['managercomment'];
				//$rm->save();
				
				//saheli rm
				$sh_comment=SHcomment::where('incident_id','=',$r->incident_id)->where('flag','!=','3')->where('status', '=','Need Info')->get()->first();
				//dd($sh_comment);
				//$sh_comment= DB::select(DB::raw("SELECT * FROM sh_comment WHERE flag != 3 AND incident_id = '".$r->incident_id."'"));
				if(!empty($sh_comment)){
					$check_za_cmnt=Zonalad::where('sh_cmnt_id','=',$sh_comment->comment_id)->get()->first();
					if(!empty($check_za_cmnt)){
						//$sh_comment->flag='3';
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
					}
					else{
						//$sh_comment->flag='1';
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 1 where status = 'Need Info' AND flag != 3 AND incident_id = '".$r->incident_id."'");
					}
					$rm->sh_cmnt_id=$sh_comment->comment_id;
					$rm->save();
					//$sh_comment->save();
				}
				/*else{
					//dd('need info');
					$ah_comment=AHcomment::where('incident_id','=',$r->incident_id)->where('flag','!=','3')->where('status', '=','Need Info')->get()->last();
					if(!empty($ah_comment)){
						$check_za_cmnt=Zonalad::where('ah_cmnt_id','=',$ah_comment->comment_id)->get();
						if(!empty($check_za_cmnt)){
							//$ah_comment->flag='3';
							$ah_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
						}
						else{ 
							//$ah_comment->flag='1';
							$ah_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 1 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
						}
						$rm->sh_cmnt_id=$ah_comment->comment_id;
						$rm->save();
						//$ah_comment->save();
					}*/
				else{
					$sh_cmnt=SHcomment::where('incident_id','=',$r->incident_id)->where('status','=','Normal Comment')->get()->first();
					$check_za_cmnt=Zonalad::where('incidentza_id','=',$r->incident_id)->get()->first();
					if(!empty($check_za_cmnt)){
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Normal Comment' AND incident_id = '".$r->incident_id."'");
					}
					else{
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 1 where status = 'Normal Comment' AND flag != 3 AND incident_id = '".$r->incident_id."'");
					}
					$rm->sh_cmnt_id=$sh_cmnt->comment_id;
					$rm->save();
				}
				//}
				//saheli

				$rmedit=Incident::select('incident.*','reporting_manager.incident_id','reporting_manager.rm_date','reporting_manager.rm_comment','reporting_manager.rm_time')
					->join('reporting_manager', 'reporting_manager.incident_id', '=', 'incident.id')
					->where('incident.id','=',$r['incident_id'])
					->get()->toArray();
				if(empty($rmedit)){

					$emptyrm=[];

				}else{
					$rmdata=$rmedit;
				}

				$url=url('/login');
				$mailsend=User::select('email')
					->where('zone_id','=',$user['zone_id'])
					->orwhere('role_id','=','4')
					->orwhere('role_id','=','5')
					->groupby('email')
					->get()->toArray();
		  
				foreach ($mailsend as $mailone){
					$to_mail=$mailone['email'];
					$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

					/*Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

						$message->to($data['email'])->subject($data['subject']);
						$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
					});*/
				}
				$post_data =array('data' => $rmdata,'nodata'=>$emptyrm);

			   
				return response()->json(['message'=>'Your comment has been successfully submitted',"incident"=> $post_data], 200);

			}elseif ($r['is_za_comment']==1) {
				$zadata=null;
				$emptyza=null;
				$za=new Zonalad;
				$za->incidentza_id=$r['incident_id'];
			
				$za->za_date= Carbon::createFromFormat('d/m/Y', $r['zonaldate'])->format('Y-m-d');
				$za->za_time=$r['zonaltime'];
				$za->za_comment=$r['zonalcomment'];
				//$za->save();
				
				//saheli za
				$sh_comment=SHcomment::where('incident_id','=',$r->incident_id)->where('flag','!=','3')->where('status', '=','Need Info')->get()->first();
				if(!empty($sh_comment)){
					$check_rm_cmnt=Reportingm::where('sh_cmnt_id','=',$sh_comment->comment_id)->get()->first();
					if(!empty($check_rm_cmnt)){
						//$sh_comment->flag='3';
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
					}
					else{
						//$sh_comment->flag='2';
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 2 where status = 'Need Info' AND flag != 3 AND incident_id = '".$r->incident_id."'");
					}
					$za->sh_cmnt_id=$sh_comment->comment_id;
					$za->save();
					//$sh_comment->save();
				}
				/*else{
					$ah_comment=AHcomment::where('incident_id','=',$r->incident_id)->where('flag','!=','3')->where('status','=','Need Info')->get()->first();
					if(!empty($ah_comment)){
						$check_rm_cmnt=Reportingm::where('ah_cmnt_id','=',$ah_comment->comment_id)->get()->first();
						if(!empty($check_rm_cmnt)){
							//$ah_comment->flag='3';
							$ah_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
						}
						else{
							//$ah_comment->flag='2';
							$ah_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 2 where status = 'Need Info' AND incident_id = '".$r->incident_id."'");
						}
						$za->sh_cmnt_id=$ah_comment->comment_id;
						$za->save();
						//$ah_comment->save();
					}*/
					else{
					$sh_cmnt=SHcomment::where('incident_id','=',$r->incident_id)->where('status','=','Normal Comment')->get()->first();
					$check_rm_cmnt=Reportingm::where('incident_id','=',$r->incident_id)->get()->first();
					if(!empty($check_rm_cmnt)){
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 3 where status = 'Normal Comment' AND incident_id = '".$r->incident_id."'");
					}
					else{
						$sh_cmnt_updt=DB::statement("UPDATE sh_comment SET flag = 2 where status = 'Normal Comment' AND flag != 3 AND incident_id = '".$r->incident_id."'");
					}
					$za->sh_cmnt_id=$sh_cmnt->comment_id;
					$za->save();
				}
				//}
				//saheli
				
				$zaedit=Incident::select('incident.*','zonal_admin.incidentza_id','zonal_admin.za_time','zonal_admin.za_date','zonal_admin.za_comment')
					->join('zonal_admin', 'zonal_admin.incidentza_id', '=', 'incident.id')
					->where('incident.id','=',$r['incident_id'])
					->get()->toArray();
				if(empty($zaedit)){

					$emptyza=[];

				}else{
					$zadata=$zaedit;
				}
				$url=url('/login');
				$mailsend=User::select('email')
					->where('role_id','=','4')
					->orwhere('role_id','=','5')
					->groupby('email')
					->get()->toArray();

				foreach ($mailsend as $mailone){
					$to_mail=$mailone['email'];
					$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

					/*Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

						$message->to($data['email'])->subject($data['subject']);
						$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
					});*/
				}
				$post_data =array('data' => $zadata,'nodata'=>$emptyza);

			   
				return response()->json(['message'=>'Your comment has been successfully submitted',"incident"=> $post_data], 200);
			}
			elseif ($r['is_sh_comment']==1) {
				
				$edit->safety_date= Carbon::createFromFormat('d/m/Y', $r['safety_date'])->format('Y-m-d');
				$edit->safety_time=$r['safety_time'];
				$edit->safety_comment=$r['safety_comment'];
				$edit->extra_info=$r['needinfo'];
				if($r['needinfo'] == 'yes'){
					$edit->status_e=1;
				}else{
					$edit->status_e=$r['status_e'];
				}
				$edit->need_informationsh=$r['shneed'];
				$edit->save();

				if($r['needinfo'] == 'yes'){
					//store sh comment in sh_comment table
					$sh=new SHcomment;
					$sh->incident_id=$r['incident_id'];
						if(!empty($r['safety_date'])){
							$sh->comment_date = Carbon::createFromFormat('d/m/Y', $r['safety_date'])->format('Y-m-d');
						}
					
					$sh->comment_time=$r['safety_time'];
					$sh->comment_name=$r['shneed'];
					//$sh->user_id=$userId;
					$sh->status='Need Info';
					$sh->flag='0';
					$sh->sequence_no='1';
					$sh->comment_desg='SH';
					$sh->save();
					//END store sh comment in sh_comment table
					//dd($sh);
					$url=url('/login');
					$mailsend=User::select('*')
						->where('id','=',$edit['user_id'])
						->get()->toArray();
		   
					/*$mailsend2=User::select('*')
						->where('zone_id','=',$mailsend[0]['zone_id'])
						->whereIn('role_id',array(2,3))
						->orwhere('id','=',$mailsend[0]['parent_id'])
						->get()->toArray();*/
						
					//saheli
					$mailsend2 = User::select('email')
						->where('role_id','=','3')
						->where('zone_id','=',$user['zone_id'])
						->ORwhere('id','=', $user['parent_id'])
						->groupby('email')
						->get()->toArray();
					//saheli
					//dd($mailsend2);
					foreach ($mailsend2 as $mailone){
						$to_mail=$mailone['email'];
						$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

						Mail::send('admin.mail.extrainfo', $data, function($message) use ($data) {

							$message->to($data['email'])->subject($data['subject']);
						   
							$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
						});
					}
					 
				}else{
					if($r['status_e'] == 0){
						$url=url('/login');
						$mailsend=User::select('*')
							->where('id','=',$edit['user_id'])
							->get()->toArray();
					 
						$mailsend2=User::select('*')
							->where('zone_id','=',$mailsend[0]['zone_id'])
							->where('role_id','=','3')
							->orwhere('id','=',$mailsend[0]['parent_id'])
							->orwhere('id','=',$edit['user_id'])
							->get()->toArray();
					  
						//saheli
						/*$mailsend2 = User::select('email')
							->where(function($query) {

								$query->where('role_id','=','4')
									->orWhere('role_id','=','5')
									->orWhere('role_id','=','3');

							})
							->where('zone_id','=',$user['zone_id'])
							->ORwhere('id','=', $user['parent_id'])
							->groupby('email')
							->get()->toArray();*/
						//saheli
						//dd($mailsend2);
						foreach ($mailsend2 as $mailone){
							$to_mail=$mailone['email'];
							$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

							Mail::send('admin.mail.close', $data, function($message) use ($data) {

								$message->to($data['email'])->subject($data['subject']);
								$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
							});

						}
			
					}else{
						$url=url('/login');
						$mailsend=User::select('*')
							->where('id','=',$edit['user_id'])
							->get()->toArray();
		   
			
						/*$mailsend2=User::select('*')
							->where('zone_id','=',$mailsend[0]['zone_id'])
							->where('role_id','=','3')
							->orwhere('id','=',$mailsend[0]['parent_id'])
							->get()->toArray();*/
						
						//saheli
						$mailsend2 = User::select('email')
							->where(function($query) {

								$query->where('role_id','=','4')
									->orWhere('role_id','=','5')
									->orWhere('role_id','=','3');

							})
							->where('zone_id','=',$user['zone_id'])
							->ORwhere('id','=', $user['parent_id'])
							->groupby('email')
							->get()->toArray();
						//saheli
						//dd($mailsend2);

						foreach ($mailsend2 as $mailone){
							$to_mail=$mailone['email'];
							$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

							/*Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

								$message->to($data['email'])->subject($data['subject']);
								$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
							});*/
						}
			   
					}
				}

				$post_data =array('data' => $edit);
				return response()->json(['message'=>'Your comment has been successfully submitted',"incident"=> $post_data], 200);
		  
			}
			elseif ($r['is_ah_comment']==1) {
				
				$edit->admin_date= Carbon::createFromFormat('d/m/Y', $r['admin_date'])->format('Y-m-d');
				$edit->admin_time=$r['admin_time'];
				$edit->admin_comment=$r['admin_comment'];
				if($r['needinfo1'] == 'yes'){
					$edit->status_e=1;
				}else{
					$edit->status_e=$r['status_e'];
				}
				$edit->extra_info=$r['needinfo1'];
				$edit->need_informationah=$r['ahneed'];
				$edit->save();
				if($r['needinfo1'] == 'yes'){
					
					//store ah comment in ah_comment table
					$ah=new SHcomment;
					$ah->incident_id=$r['incident_id'];
						if(!empty($r['admin_date'])){
							$ah->comment_date = Carbon::createFromFormat('d/m/Y', $r['admin_date'])->format('Y-m-d');
						}
					
					$ah->comment_time=$r['admin_time'];
					$ah->comment_name=$r['ahneed'];
					//$ah->user_id=$userId;
					$ah->status='Need Info';
					$ah->flag='0';
					$ah->sequence_no='1';
					$ah->comment_desg='AH';
					$ah->save();
					//END store ah comment in ah_comment table
					
					$url=url('/login');
	   
					$mailsend=User::select('*')
						->where('id','=',$edit['user_id'])
						->get()->toArray();
					/*$mailsend2=User::select('*')
						->where('zone_id','=',$mailsend[0]['zone_id'])
						->whereIn('role_id',array(2,3))
						->orwhere('id','=',$mailsend[0]['parent_id'])
						->get()->toArray();*/
					$edit=Incident::find($r['id']);
					//saheli
					$mailsend2 = User::select('email')
						->where('role_id','=','3')
						->where('zone_id','=',$user['zone_id'])
						->ORwhere('id','=', $user['parent_id'])
						->groupby('email')
						->get()->toArray();
					//saheli
					//dd($mailsend2);
					foreach ($mailsend2 as $mailone){
						$to_mail=$mailone['email'];
						$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

						Mail::send('admin.mail.extrainfo', $data, function($message) use ($data) {

							$message->to($data['email'])->subject($data['subject']);
						   
							$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
						});
					}

				}else{
					if($r['status_e'] == 0){

						$url=url('/login');
						$mailsend=User::select('*')
							->where('id','=',$edit['user_id'])
							->get()->toArray();
					  
						$mailsend2=User::select('*')
							->where('zone_id','=',$mailsend[0]['zone_id'])
							->where('role_id','=','3')
							->orwhere('id','=',$mailsend[0]['parent_id'])
							->orwhere('id','=',$edit['user_id'])
							->get()->toArray();
							
						//dd($mailsend2);
						
						foreach ($mailsend2 as $mailone){
						  $to_mail=$mailone['email'];
							$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];
							Mail::send('admin.mail.close', $data, function($message) use ($data) {

								$message->to($data['email'])->subject($data['subject']);
								$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
							});
						}
					}else{
						$url=url('/login');
						$mailsend=User::select('*')
							->where('id','=',$edit['user_id'])
							->get()->toArray();
			
						$mailsend2=User::select('*')
							->where('zone_id','=',$mailsend[0]['zone_id'])
							->where('role_id','=','3')
							->orwhere('id','=',$mailsend[0]['parent_id'])
							->get()->toArray();

						foreach ($mailsend2 as $mailone){
							$to_mail=$mailone['email'];
							$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$edit['employee_name'],'url'=>$url];

							/*Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

								$message->to($data['email'])->subject($data['subject']);
								$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
							});*/
						}
					}

				}
				$post_data =array('data' => $edit);

				return response()->json(['message'=>'Your comment has been successfully submitted',"incident"=> $post_data], 200);
			}
			else{
				$edit->user_id=$user['id']; 
				$edit->employee_name=$r['employee_name'];

				$edit->incident_date= Carbon::createFromFormat('d/m/Y', $r['incident_date'])->format('Y-m-d');
				$edit->incident_time=$r['incident_time'];
				$edit->inc_type=$r['inc_type'];
				$edit->incident_location=$r['incident_location'];
				$edit->incident_description=$r['incident_description'];
				$edit->injured_status=$r['injured_status'];
				$edit->city=$r['city'];
				$edit->district=$r['district'];
				$edit->state=$r['state'];
				$edit->save_draft=$r['is_submit'];
				if(!empty($r['Image'])){
					$image = $r['Image'];
					//generating unique file name;
					$file_name = 'image_'.time().'.png';

					// storing image in storage/app/public Folder
					\Storage::disk('local')->put($file_name,base64_decode($image));

				} else {

					$image = '';

				}

				$edit->image = $image;
				$edit->save();
		   
				if($r['is_submit'] == 1 ){
					$post_data =array('data' => $edit);

					$url=url('/login');
					/*$mailsend=User::select('email')
						->where('zone_id','=',$user['zone_id'])
						->where('role_id','!=','1')
						->orwhere('role_id','=','4')
						->orwhere('role_id','=','5')
						->groupby('email')
						->get()->toArray();*/
					//saheli
					$mailtoadmins = User::select('email')->where('role_id','=','4')
					->orWhere('role_id','=','5');
			
					$mailsend = User::select('email')
					->Where('role_id','=','3')
					->where('zone_id','=',$user['zone_id'])
					->ORwhere('id','=', $user['parent_id'])
					->union($mailtoadmins)
					->groupby('email')
					->get()->toArray();
					//saheli
					//dd($mailsend);
						foreach ($mailsend as $mailone){
							$to_mail=$mailone['email'];
							$data=['subject'=>'Incident-Reporting','email'=>$to_mail, 'name'=>$edit->employee_name,'url'=>$url];


							Mail::send('admin.mail.closeinci', $data, function($message) use ($data) {

								$message->to($data['email'])->subject($data['subject']);
								$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
							});
						}
						return response()->json(['message'=>'Your incident has been successfully submitted.',"incident"=> $post_data], 200);

				}else{
					$post_data =array('data' => $edit);
					return response()->json(['message'=>'Your incident has been successfully saved as draft.',"incident"=> $post_data], 200);
				}

			}
		}
				 
   }
   
	public function changeDateRange(Request $request){
		//dd($request);
		$obj= Date_range_picker::get()->first();
        $obj->date_range=$request['date_range'];
		$obj->save();
		
		return response()->json(['status'=>200,'message'=>'Date Range is changed Successfully.'],200);
	}
	
}