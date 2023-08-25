<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Myform;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Helpers\UserHelper;
use App\Branch;
use App\Models\Incident;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\User;
use App\Models\AHcomment;
use App\Models\SHcomment;
use App\Models\CommentTrail;
use App\Models\Employeepersonal;
use App\Models\Employeeextra;
use App\Activities;
use App\Models\RMcomment;
use App\Models\Zonalad;
use App\Models\Date_range_picker;
use App\Models\ReptDays;
use Session;
use Hash;
use File;
use Eloquent;
use Mail;
use Input;
use DB;
use DataTables;
use Carbon\Carbon ;

class DashboardController extends Controller{

    public function dashboard(){
       $data 			    = Session::all();
       $userEmil 		    = $data['user']['email'];
       $user_id	 		    = $data['user']['user_id'];
       $userrole_id 	    = $data['user']['role_id'];           
       $emp_id 	 		    = $data['user']['emp_id'];           
       $employee_name 	    = $data['user']['employee_name'];           
       $dateRange			= $_GET['searchdate'];
	   $from_date 			= substr($_GET['searchdate'],0,10);			
	   $to_date 			= substr($_GET['searchdate'],-10);
	   $repDays 			= ReptDays::find(1); 

       if($userrole_id == 1){
        $title = 'Super Admin';
				return view('super.dashboard')					   
                ->with('role',$userrole_id )
                ->with('email', $userEmil)				
                ->with('title', $title);
        }elseif($userrole_id == '2'){
          $title = 'Employee';
		   if($from_date != ''){	
			$table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                    'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                          ->where('emp_email','=',$userEmil)
                          ->where('role_id','=','2')
						  ->whereBetween('incident_date',[$from_date, $to_date])
                          ->where('incident.status_e','=','1')
						  ->orderBy('in_id', 'DESC') 
						  ->get();
		   }else{
			 $table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                          ->where('emp_email','=',$userEmil)
                          ->where('role_id','=','2')
                          ->where('incident.status_e','=','1')
						  ->orderBy('in_id', 'DESC') 
						  ->get();
		   }
		 	
				  return view('employee.dashboard')				
				        ->with('tabledata', $table)
						->with('role', $userrole_id)
						->with('email', $userEmil)
						->with('dateRange', $dateRange)
						->with('title', $title);
		}elseif($userrole_id == '3'){
          $title = 'Reporting Manager';
		  if($from_date != ''){
			$table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
								    'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join('users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
                          ->where('incident.save_draft','=','1')
                          ->where('manager_action','=', '0')
                          ->where('manager_reject','=', 'N')
                          ->where('role_id','=','2')
						  ->whereBetween('incident_date',[$from_date, $to_date])
                          ->where('incident.manager_id','=',$emp_id)
						  ->orderBy('in_id', 'DESC') 
						  ->get();
		  }else{
			$table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
								    'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join('users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
                          ->where('incident.save_draft','=','1')
                          ->where('manager_action','=', '0')
						  ->where('manager_reject','=', 'N')
                          ->where('role_id','=','2')
                          ->where('incident.manager_id','=',$emp_id)
						  ->orderBy('in_id', 'DESC') 
						  ->get();  
		  
		  }
				  return view('rm.dashboard')				
						->with('tabledata', $table)
						->with('role', $userrole_id)
						->with('email', $userEmil)
						->with('dateRange', $dateRange)
						->with('title', $title);
		}elseif($userrole_id == '4'){
          $title = 'Safety Champion';
          //DB::enableQueryLog();
		  if($from_date != ''){
			  $table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									  'status_type.status_name','inci_type.incident_t as actiontype')
							  ->join('users','users.email', '=', 'incident.emp_email')
							  ->join('city', 'city.id', '=', 'incident.city')
							  ->join('state', 'state.id', '=', 'incident.state')
							  ->leftjoin('district', 'district.id', '=', 'incident.district')
							  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
							  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
							  //->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')		
							  //->leftjoin('sh_comment', 'sh_comment.incident_id', '=', 'incident.id')		
							  ->where('incident.save_draft','=','1')
							  ->where('manager_action','=', '1')
							  ->where('status_e','=', '1')
							  ->where('schamp_id1','=', $emp_id)
							  ->orWhere('schamp_id2','=', $emp_id)
							  ->where('safety_id','=', $repDays->def_schamp_id)
							  ->where('safety_action','=', '0')
							  ->whereBetween('incident_date',[$from_date, $to_date])
							  ->where('role_id','=','2')
							  ->orderBy('in_id', 'DESC') 
							  ->get();
		   }else{
			 $table=Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									 'status_type.status_name','inci_type.incident_t as actiontype')
							  ->join('users','users.email', '=', 'incident.emp_email')
							  ->join('city', 'city.id', '=', 'incident.city')
							  ->join('state', 'state.id', '=', 'incident.state')
							  ->leftjoin('district', 'district.id', '=', 'incident.district')
							  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
							  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
							  //->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')		
							  //->leftjoin('sh_comment', 'sh_comment.incident_id', '=', 'incident.id')		
							  ->where('incident.save_draft','=','1')
							  ->where('manager_action','=', '1')
							  ->where('status_e','=', '1')
							  ->where('schamp_id1','=', $emp_id)
							  ->orWhere('schamp_id2','=', $emp_id)
							  ->where('safety_id','=', $repDays->def_schamp_id)
							  ->where('safety_action','=', '0')
							  ->where('role_id','=','2')
							  ->orderBy('in_id', 'DESC') 
							  ->get();  
		   
		   }
                //dd(DB::getQueryLog());        
				  return view('sf.dashboard')				
                        ->with('tabledata', $table)
                        ->with('role', $userrole_id)
                        ->with('email', $userEmil)
						->with('dateRange', $dateRange)
                        ->with('title', $title);
        }          
	}
    
    public function closetable(){
        $data                = Session::all();
        $userEmil 		     = $data['user']['email'];
        $user_id	 		 = $data['user']['user_id'];
        $userrole_id 	     = $data['user']['role_id'];           
        $emp_id 	 		 = $data['user']['emp_id']; 
		$dateRange			 = $_GET['searchdate'];	
        if($userrole_id == '1'){       
          $employee_name 	    = 'Super Administrator';
        }else{
          $employee_name 	    = $data['user']['employee_name'];
        }
		
		$repDays 			= ReptDays::find(1);		
		$from_date = substr($_GET['searchdate'],0,10);			
		$to_date = substr($_GET['searchdate'],-10);			
        //DB::enableQueryLog();
       if($userrole_id == '1'){
		   if($from_date != ''){
				$table= Incident::select('*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
										 'status_type.status_name','inci_type.incident_t as actiontype')
                            //->join('users', 'users.email', '=', 'incident.emp_email')
                            ->join('city', 'city.id', '=', 'incident.city')
                            ->join('state', 'state.id', '=', 'incident.state')
                            ->leftjoin('district', 'district.id', '=', 'incident.district')
                            ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                            ->join('status_type', 'status_type.id', '=', 'incident.injured_status')   
							->where('save_draft','=','1')	
                            ->where('status_e','=','0')
							->where('manager_action','=','1')
							->where('safety_action','=', '1')
                            //->where('role_id','=','2') 
							->whereBetween('incident_date',[$from_date, $to_date])
                            ->orderBy('in_id', 'DESC')   
							->Paginate(15);	
                            //->get();
		   }else{
			  $table= Incident::select('*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									   'status_type.status_name','inci_type.incident_t as actiontype')
                            //->join('users', 'users.email', '=', 'incident.emp_email')
                            ->join('city', 'city.id', '=', 'incident.city')
                            ->join('state', 'state.id', '=', 'incident.state')
                            ->leftjoin('district', 'district.id', '=', 'incident.district')
                            ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                            ->join('status_type', 'status_type.id', '=', 'incident.injured_status')  
							->where('save_draft','=','1')	
                            ->where('status_e','=','0')
							->where('manager_action','=','1')
							->where('safety_action','=', '1')							
                            //->where('role_id','=','2') 
                            ->orderBy('in_id', 'DESC')   
							->Paginate(15);	
		   }
        }elseif($userrole_id == '2'){
			if($from_date != ''){
			 $table= Incident::select('*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									  'status_type.status_name','inci_type.incident_t as actiontype','users.id')
							  ->join('users', 'users.email', '=', 'incident.emp_email')
							  ->join('city', 'city.id', '=', 'incident.city')
							  ->join('state', 'state.id', '=', 'incident.state')
							  ->leftjoin('district', 'district.id', '=', 'incident.district')
							  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
							  ->join('status_type', 'status_type.id', '=', 'incident.injured_status') 
							  ->where('incident.emp_email','=',$userEmil)
							  ->where('status_e','=','0')
							  ->whereIn('status_e',array('1','0'))	
							  ->where('role_id','=','2') 							
							  ->whereBetween('incident_date',[$from_date, $to_date])
							  ->orderBy('in_id', 'DESC') 
							  ->Paginate(15);	
							  //->get();
			}else{
			 $table= Incident::select('*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									  'status_type.status_name','inci_type.incident_t as actiontype','users.id')
							  ->join('users', 'users.email', '=', 'incident.emp_email')
							  ->join('city', 'city.id', '=', 'incident.city')
							  ->join('state', 'state.id', '=', 'incident.state')
							  ->leftjoin('district', 'district.id', '=', 'incident.district')
							  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
							  ->join('status_type', 'status_type.id', '=', 'incident.injured_status') 
							  ->where('incident.emp_email','=',$userEmil)
							  ->where('status_e','=','0') 
							  ->whereIn('status_e',array('1','0'))
							  ->where('role_id','=','2') 							 
							  ->orderBy('in_id', 'DESC') 
							  ->Paginate(15);			
			
			}
        }elseif($userrole_id == '3') {
			if($from_date != ''){
				$table= Incident::select('incident.id as in_id','incident.*','state.name as staname','city.name','district.name as disname',
									     'status_type.status_name','inci_type.incident_t as actiontype','users.id')
								->join('users', 'users.email', '=', 'incident.emp_email')
								->join('city', 'city.id', '=', 'incident.city')
								->join('state', 'state.id', '=', 'incident.state')
								->leftjoin('district', 'district.id', '=', 'incident.district')
								->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
								->join('status_type', 'status_type.id', '=', 'incident.injured_status')       
								->where('status_e','=','0')
								->where('role_id','=','2')
								->where('save_draft','=','1')
								->where('incident.manager_id','=',$emp_id) 
								->whereBetween('incident_date',[$from_date, $to_date])
								->orderBy('in_id', 'DESC') 
								->Paginate(15);
                            //->get();
			}else{
			   $table= Incident::select('incident.id as in_id','incident.*','state.name as staname','city.name','district.name as disname',
										'status_type.status_name','inci_type.incident_t as actiontype','users.id')
                            ->join('users', 'users.email', '=', 'incident.emp_email')
                            ->join('city', 'city.id', '=', 'incident.city')
                            ->join('state', 'state.id', '=', 'incident.state')
                            ->leftjoin('district', 'district.id', '=', 'incident.district')
                            ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                            ->join('status_type', 'status_type.id', '=', 'incident.injured_status')       
                            ->where('status_e','=','0')
							->where('save_draft','=','1')
                            ->where('role_id','=','2')
                            ->where('incident.manager_id','=',$emp_id) 
                            ->orderBy('in_id', 'DESC') 
							->Paginate(15);	
			
			}
        }elseif($userrole_id == '4'){  
			if($from_date != ''){	
			  $table=	Incident::select('incident.id as in_id','incident.*','state.name as staname','city.name','district.name as disname',
										 'status_type.status_name','inci_type.incident_t as actiontype','users.id')
								->join('state','state.id','=','incident.state')
								->join('city','city.id','=','incident.city')
								->leftjoin('district', 'district.id', '=', 'incident.district')
								->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
								->join('status_type', 'status_type.id', '=', 'incident.injured_status')
								->join('users', 'users.email', '=', 'incident.emp_email')
								->where('status_e','=','0')
								->where('save_draft','=','1')
								->where('role_id','=','2') 
								->where('schamp_id1','=', $emp_id)
								->orWhere('schamp_id2','=', $emp_id)
								->where('safety_id','=', $repDays->def_schamp_id)
								->whereBetween('incident_date',[$from_date, $to_date])
								->orderBy('in_id', 'DESC') 
								->Paginate(15);	
								//->get();
			}else{
				$table=	Incident::select('incident.id as in_id','incident.*',
								'state.name as staname','city.name','district.name as disname',
								'status_type.status_name','inci_type.incident_t as actiontype','users.id')
								->join('state','state.id','=','incident.state')
								->join('city','city.id','=','incident.city')
								->leftjoin('district', 'district.id', '=', 'incident.district')
								->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
								->join('status_type', 'status_type.id', '=', 'incident.injured_status')
								->join('users', 'users.email', '=', 'incident.emp_email')
								->where('status_e','=','0')
								->where('save_draft','=','1')
								->where('schamp_id1','=', $emp_id)
								->orWhere('schamp_id2','=', $emp_id)
								->where('safety_id','=', $repDays->def_schamp_id)
								->where('role_id','=','2') 
								->orderBy('in_id', 'DESC') 
								->Paginate(15);	
			}
       }  
         //dd(DB::getQueryLog());  
         return view('admin.closetable')
                ->with('tabledata',$table)
                ->with('role',$userrole_id)
                ->with('dateRange',$dateRange)
                ->with('Employee_name', $employee_name);     
    }
		
    public function incitable(){
        $data             = Session::all();
        $userEmail 		  = $data['user']['email'];
        $user_id	 	  = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	 	  = $data['user']['emp_id'];           
        $employee_name 	  = $data['user']['employee_name'];	   
        $title            = 'Total Incident Table';
		$repDays 		  = ReptDays::find(1);
        //DB::enableQueryLog();
       if($userrole_id == '1'){
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									 'status_type.status_name','inci_type.incident_t as actiontype')
                                  //->join('users', 'users.email', '=', 'incident.emp_email')
                                  ->join('city', 'city.id', '=', 'incident.city')
                                  ->join('state', 'state.id', '=', 'incident.state')
                                  ->leftjoin('district', 'district.id', '=', 'incident.district')
                                  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                                  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
                                  //->where('user_id','=',$user_id)
								  //->where('role_id','=','2')
                                  ->where('incident.save_draft','=','1')
								  //->whereIn('incident.status_e',array('1','0'))
                                  ->orderBy('in_id', 'DESC')
								  ->Paginate(10);
                                  //->get();
             //dd( $table);            
          }elseif($userrole_id == '2'){
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join( 'users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                              ->where('emp_email','=',$userEmail)
                              ->where('role_id','=','2')
                              //->where('incident.status_e','=','1')
							  ->where('incident.save_draft','=','1')
                              ->whereIn('status_e',array('1','0'))
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();
            //dd( $table);            
          }elseif($userrole_id == '3'){
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join('users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
                              ->where('save_draft','=','1')
                              //->where('manager_action','=', '0')
                              ->whereIn('manager_action',array('1','0'))
                              //->where('status_e','=','1')
							  ->whereIn('status_e',array('1','0'))
                              ->where('role_id','=','2')
                              ->where('incident.manager_id','=',$emp_id)
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();
             //dd( $table);             
          }elseif($userrole_id == '4'){            
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join('users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                              ->where('incident.save_draft','=','1')
                              //->where('incident.status_e','=','1')
							  ->whereIn('incident.status_e',array('1','0'))
                              //->whereIn('manager_action', array('0','1'))
                              //->where('manager_action','=', '0')
                              //->where('safety_action','=', '0')
                              ->where('role_id','=','2')
							  ->where('schamp_id1','=', $emp_id)
							  ->orWhere('schamp_id2','=', $emp_id)
							  ->where('safety_id','=', $repDays->def_schamp_id)
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();  
             //dd( $table);
          }  
            //dd(DB::getQueryLog());
            return view('admin.incitable')
                    ->with('tabledata',$table)
                    ->with('role',$userrole_id)
                    ->with('title',$title)
                    ->with('Employee_name', $employee_name);   
    }
	
	public function drafttable(){
        $data             = Session::all();
        $userEmail 		  = $data['user']['email'];
        $user_id	 	  = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	 	  = $data['user']['emp_id'];           
        $employee_name 	  = $data['user']['employee_name'];	   
        $title            = 'Draft Incident Table';
		$repDays 		  = ReptDays::find(1);
        //DB::enableQueryLog();
       if($userrole_id == '1'){
            $table= Incident::select('*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
									 'status_type.status_name','inci_type.incident_t as actiontype','users.id')
                                  ->join('users', 'users.email', '=', 'incident.emp_email')
                                  ->join('city', 'city.id', '=', 'incident.city')
                                  ->join('state', 'state.id', '=', 'incident.state')
                                  ->leftjoin('district', 'district.id', '=', 'incident.district')
                                  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                                  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
                                  //->where('user_id','=',$user_id)
								  ->where('role_id','=','2')
                                  ->where('incident.save_draft','=','0')
                                  ->orderBy('in_id', 'DESC')
								  ->Paginate(10);
                                  //->get();
             //dd( $table);            
          }elseif($userrole_id == '2'){
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join( 'users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                              ->where('emp_email','=',$userEmail)
                              ->where('role_id','=','2')
                              //->where('incident.status_e','=','1')
							  ->where('incident.save_draft','=','0')
                              ->whereIn('status_e',array('1','0'))
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();
            //dd( $table);            
          }elseif($userrole_id == '3'){
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join('users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')		
                              ->where('save_draft','=','0')
                              //->where('manager_action','=', '0')
                              ->whereIn('manager_action',array('1','0'))
                              //->where('status_e','=','1')
							  ->whereIn('status_e',array('1','0'))
                              ->where('role_id','=','2')
                              ->where('incident.manager_id','=',$emp_id)
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();
             //dd( $table);             
          }elseif($userrole_id == '4'){            
            $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                     'status_type.status_name','inci_type.incident_t as actiontype')
                              ->join('users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->leftjoin('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                              ->where('incident.save_draft','=','0')
                              //->where('incident.status_e','=','1')
							  ->whereIn('incident.status_e',array('1','0'))
                              //->whereIn('manager_action', array('0','1'))
                              //->where('manager_action','=', '0')
                              //->where('safety_action','=', '0')
                              ->where('role_id','=','2')
                              ->orderBy('in_id', 'DESC') 
							  ->Paginate(10);
                              //->get();  
             //dd( $table);
          }  
            //dd(DB::getQueryLog());
            return view('admin.drafttable')
                    ->with('tabledata',$table)
                    ->with('role',$userrole_id)
                    ->with('title',$title)
                    ->with('Employee_name', $employee_name);   
    }

    public function pendrm(){
      $data             = Session::all();
      $userEmail 		= $data['user']['email'];
      $user_id	 		= $data['user']['user_id'];
      $userrole_id 	    = $data['user']['role_id'];           
      $emp_id 	 		= $data['user']['emp_id'];           
      $employee_name 	= $data['user']['employee_name'];
      $title            = 'Pending With Reporting Manager Table';
	  $repDays 			= ReptDays::find(1);
      //DB::enableQueryLog();
      if($userrole_id == '1'){  
        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          //->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                          //->where('emp_email','=',$userEmail)			
                          //->where('manager_id','=',$reptMgrID[0]['rpt_code'])
						  ->where('incident.save_draft','=','1')
                          ->where('manager_action','=', '0')
						  ->where('safety_action','=', '0')
                         //->where('role_id','=','2')
                          ->whereIn('status_e',array('1','0'))
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                          //->get();
          //dd( $table);          
      }elseif($userrole_id == '2'){  
        $reptMgrID 	 = Employeepersonal::select('rpt_code')->where('emp_no','=',$emp_id)->get()->toArray();	

        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                          ->where('emp_email','=',$userEmail)			
                          ->where('manager_id','=',$reptMgrID[0]['rpt_code'])
						  ->where('incident.save_draft','=','1')
                          ->where('manager_action','=', '0')
						  ->where('manager_reject','<>', 'Y')
                          ->where('role_id','=','2')
                          ->where('incident.status_e','=','1')
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                          //->get();
          //dd( $table);          
        }elseif($userrole_id == '3'){  
          $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                   'status_type.status_name','inci_type.incident_t as actiontype')
                            ->join( 'users','users.email', '=', 'incident.emp_email')
                            ->join('city', 'city.id', '=', 'incident.city')
                            ->join('state', 'state.id', '=', 'incident.state')
                            ->leftjoin('district', 'district.id', '=', 'incident.district')
                            ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                            ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                            ->where('manager_id','=',$emp_id)
							->where('incident.save_draft','=','1')
                            ->where('manager_action','=', '0')
							->where('manager_reject','=', 'N')
                            ->where('role_id','=','2')
                            ->where('incident.status_e','=','1')
                            ->orderBy('in_id', 'DESC') 
							->Paginate(15);	
                            //->get();
            //dd( $table);           
        }elseif($userrole_id == '4'){  
          $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                   'status_type.status_name','inci_type.incident_t as actiontype')
                            ->join( 'users','users.email', '=', 'incident.emp_email')
                            ->join('city', 'city.id', '=', 'incident.city')
                            ->join('state', 'state.id', '=', 'incident.state')
                            ->leftjoin('district', 'district.id', '=', 'incident.district')
                            ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                            ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
							->where('incident.save_draft','=','1')	
                            ->where('manager_action','=', '0')
                            //->where('safety_action','=', '0')
                            ->where('role_id','=','2')
                            ->where('incident.status_e','=','1')
							->where('schamp_id1','=', $emp_id)
							->orWhere('schamp_id2','=', $emp_id)
							->where('safety_id','=', $repDays->def_schamp_id)
                            ->orderBy('in_id', 'DESC') 
							->Paginate(15);	
                            //->get();
            //dd( $table);
        }
        //dd(DB::getQueryLog()); 
        return view('admin.incitable')
                ->with('tabledata',$table)
                ->with('role',$userrole_id)
                ->with('title',$title)
                ->with('Employee_name', $userEmployee_name);
    }

    public function pendsf(){
      $data             = Session::all();
      $userEmail 		= $data['user']['email'];
      $user_id	 		= $data['user']['user_id'];
      $userrole_id 	    = $data['user']['role_id'];           
      $emp_id 	 		= $data['user']['emp_id'];           
      $employee_name 	= $data['user']['employee_name'];
      $title            = 'Pending With Safety Champion Table';
	  $repDays 			= ReptDays::find(1);	
      $reptMgrID 	 	= Employeepersonal::select('rpt_code')->where('email','=',$userEmail)->get()->toArray();	
      $safetyheadID 	= Employeepersonal::select('emp_no')->where('desg','=','Head - Safety')->get()->toArray();
      //DB::enableQueryLog();
      if($userrole_id == '1'){
        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          //->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                         // ->where('emp_email','=',$userEmail)			
                          //->where('manager_id','=',$reptMgrID[0]['rpt_code'])
                          //->where('safety_id','=',$safetyheadID[0]['emp_no'])
                          ->where('manager_action','=','1')
                          ->where('safety_action','=', '0')
                          //->where('role_id','=','2')
						  ->where('save_draft','=','1')
                          //->where('incident.status_e','=','1')
                          ->whereIn('incident.status_e',array('1','0'))
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                          //->get();

      }elseif($userrole_id == '2'){
        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                          ->where('emp_email','=',$userEmail)			
                          ->where('manager_id','=',$reptMgrID[0]['rpt_code'])
                          //->where('safety_id','=',$safetyheadID[0]['emp_no'])
                          ->where('manager_action','=','1')
                          ->where('safety_action','=', '0')
                          ->where('role_id','=','2')
						  ->where('save_draft','=','1')
                          ->where('incident.status_e','=','1')
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                          //->get();

      }elseif($userrole_id == '3'){
        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                          //->where('emp_email','=',$userEmail)			
                          ->where('manager_id','=',$emp_id)
                          //->where('safety_id','=',$safetyheadID[0]['emp_no'])
                          ->where('manager_action','=','1')
                          ->where('safety_action','=', '0')
                          ->where('role_id','=','2')
						  ->where('save_draft','=','1')
                          ->where('incident.status_e','=','1')
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                          //->get();

      }elseif($userrole_id == '4'){
        $table= Incident::select('incident.*','incident.id as in_id','state.name as staname','city.name','district.name as disname',
                                 'status_type.status_name','inci_type.incident_t as actiontype')
                          ->join( 'users','users.email', '=', 'incident.emp_email')
                          ->join('city', 'city.id', '=', 'incident.city')
                          ->join('state', 'state.id', '=', 'incident.state')
                          ->leftjoin('district', 'district.id', '=', 'incident.district')
                          ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                          ->join('status_type', 'status_type.id', '=', 'incident.injured_status')	
                          //->where('emp_email','=',$userEmail)			
                          //->where('manager_id','=',$reptMgrID[0]['rpt_code'])
                          //->where('safety_id','=',$safetyheadID[0]['emp_no'])
                          ->where('manager_action','=','1')
                          //->where('safety_action','=', '0')
                          ->where('role_id','=','2')
						  ->where('save_draft','=','1')
                          ->where('incident.status_e','=','1')
						  ->where('schamp_id1','=', $emp_id)
						  ->orWhere('schamp_id2','=', $emp_id)
						  ->where('safety_id','=', $repDays->def_schamp_id)
                          ->orderBy('in_id', 'DESC') 
						  ->Paginate(15);	
                         // ->get();
      }
        //dd(DB::getQueryLog());
          return view('admin.incitable')
                ->with('tabledata',$table)
                ->with('role',$userrole_id)
                ->with('title',$title)
                ->with('Employee_name', $employee_name);     
    }
	
	public function Inciview($id){		
        $data           = Session::all(); 
		$userEmail 	  	= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name']; 
	    $flag			= 'view';		
        
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();
			
		    //dd($edit[0]['id']);			
		$employeeName = Employeepersonal::select('name')->where('email','=',$userEmail)->get()->toArray();		
		//DB::enableQueryLog();
        $rmedit = Incident::select('incident.*','rm_comment.incident_id','rm_comment.rm_date',
									'rm_comment.rm_comment','rm_comment.rm_time')
                          ->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')
                          ->where('incident.id','=',$id)
						  ->orderBy('rm_date', 'desc')
						  ->orderBy('rm_time', 'desc')
						  ->limit(1)
                          ->get()->toArray();
		//dd(DB::getQueryLog());				  

        if(empty($rmedit)){
          $emptyrm=[];
        }else{
          $rmdata=$rmedit;
		  //dd($rmdata);	
        };
        
		//SH table
		$shedit = Incident::select('incident.*','sh_comment.*')
						  ->join('sh_comment', 'sh_comment.incident_id', '=', 'incident.id')
						  ->where('incident.id','=',$id) 					  		
						  ->get()->toArray();

		if(empty($shedit)){
          $emptyza=[];
        }else{
          $shedit=$shedit;
        }
		
		$sh_main_cmnt = Incident::where('id','=',$id)->whereNotNull('extra_info')->get();
		  if(empty($sh_main_cmnt)){
          $sh_main_cmnt=[];

        }else{
          $sh_main_cmnt=$sh_main_cmnt;
        }	

        $todayDate = Carbon::now();
		$todayDate = date('d/m/Y', strtotime($todayDate));
		
		$sh_cmnt = SHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->last();		
		$has_comment = SHcomment::where('incident_id','=',$id)->get()->last();
		
		return view('admin.incidentview')
            ->with('edit',$edit)
            ->with('rmedit',$rmdata)
            ->with('emprm',$emptyrm)			
            ->with('shedit',$shedit)		
            ->with('empza',$emptyza)
            ->with('role', $userrole_id)
            ->with('todayDate', $todayDate)
            ->with('sh_cmnt', $sh_cmnt)
            ->with('sh_main_cmnt', $sh_main_cmnt)           
            ->with('has_comment', $has_comment)
            ->with('rm_cmnt_chk', $rm_cmnt_chk)
            ->with('flag',$flag)
            ->with('email', $userEmail);         
    }
  
    public function statecity(Request $r){        
	 $city= UserHelper::City($r['model']);  
	 $str = '<option selected="selected" disabled="disabled"></option>';
	 if (!isset($city->id)) {     
		 foreach ($city as $key => $value) {
			 $str .= '<option value=' . $value['id'] . '>' . $value['name'] . '</option>';
		 }
	 }
	 echo $str; 
   }
    
    public function statedis(Request $r){ 
	 $city= UserHelper::District($r['model']);  
	  $str = '<option selected="selected" disabled="disabled"></option>';
	  if (!isset($city->id)) {      
		  foreach ($city as $key => $value) {
			  $str .= '<option value=' . $value['id'] . '>' . $value['name'] . '</option>';
		  }
	  }
	  echo $str;      
	}
    
    public function changepassword(){
            $data             = Session::all();
            $userEmil 		    = $data['user']['email'];
            $user_id	 		    = $data['user']['user_id'];
            $userrole_id 	    = $data['user']['role_id'];           
            $emp_id 	 		    = $data['user']['emp_id'];           
            $employee_name 	  = $data['user']['employee_name'];	
      
            return view('admin.changepassword')
                  ->with('user_id',$user_id )
                  ->with('role',$userrole_id )
                  ->with('Employee_name', $userEmployee_name);              
        }
    
    public function changepss(Myform $r){          
            $data             = Session::all();
            $userEmil 		    = $data['user']['email'];
            $user_id	 		    = $data['user']['user_id'];
            $userrole_id 	    = $data['user']['role_id'];           
            $emp_id 	 		    = $data['user']['emp_id'];           
            $employee_name 	  = $data['user']['employee_name'];       
            //DB::enableQueryLog(); 
            $obj =  User::select('*')
                          ->where('username','=',$emp_id)                               
                            ->get()->toArray();; 
            
            $password = Hash::make($r['password']);           
            User::where('username', $emp_id)->update(['password' => $password]); 
            return redirect('/admin/admin-changepass') 
                  ->with('success', 'Your password has been successfully updated!');       
      } 

	
}