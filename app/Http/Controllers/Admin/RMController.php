<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Helpers\UserHelper;
use App\Http\Requests\EmployeeCsvRequest;

use App\Models\Employeepersonal;
use App\Models\Employeeextra;
use App\Models\User;
use App\Models\SChampDstore;
use App\Models\SChampInfo1;
use App\Models\SChampInfo2;

use App\Models\Incident;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\Date_range_picker;
use App\Models\RMcomment;
use App\Models\SHcomment;
use App\Models\ReptDays;

use App\Branch;

use phpDocumentor\Reflection\Types\Null_;
use Session;
use File;
use Eloquent;
use Mail;
use Auth;
use Input;
use DB;
use DataTables;
use Hash;
use Storage;

use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class RMController extends Controller{
    
  public function incidentedit($id){
        $data           = Session::all(); 
		    $userEmail 	  	= $data['user']['email'];
        $user_id	      = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	      = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name'];        
        
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();
			
		//dd($edit[0]['name']);			
		$employeeName = Employeepersonal::select('name')->where('email','=',$userEmail)->get()->toArray();		
		
        $rmedit = Incident::select('incident.*','rm_comment.incident_id','rm_comment.rm_date',
									'rm_comment.rm_comment','rm_comment.rm_time')
                          ->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')
                          ->where('incident.id','=',$id)
						  ->orderBy('rm_date', 'desc')
						  ->orderBy('rm_time', 'desc')
						  ->limit(1)
                          ->get()->toArray();
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
                        //->whereNotNull('sh_comment.comment_name')
                        //->where('sh_comment.comment_desg','=','SH')
                        ->get()->toArray();
		if(empty($shedit)){
          $emptyza=[];
        }else{
          $shedit=$shedit;
        }
        //DB::enableQueryLog(); 
		  $sh_main_cmnt = Incident::where('id','=',$id)->whereNotNull('extra_info')->get();
      //dd(DB::getQueryLog());
		  if(empty($sh_main_cmnt)){
          $sh_main_cmnt=[];

        }else{
          $sh_main_cmnt=$sh_main_cmnt;
        }	
        
      $todayDate = Carbon::now();
		  $todayDate = date('d/m/Y', strtotime($todayDate));
		
		$sh_cmnt 	 = SHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->last();		
		$has_comment = SHcomment::where('incident_id','=',$id)->get()->last();
		$rm_cmnt_chk = SHcomment::where('incident_id','=',$id)->where('status','=','Normal Comment')->where('flag',array(0,2))->get()->last();		
		//$rm_cmnt_close=SHcomment::where('incident_id','=',$id)->whereIn('flag',array(0,2))->get()->last();		
		//dd($has_comment);
		return view('rm.incidentedit')
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
            //->with('za_cmnt_chk', $za_cmnt_chk)
            //->with('rm_cmnt_close', $rm_cmnt_close)        
            ->with('email', $userEmail);         
    }

    public function rmcomment(Request $r){
        $data           = Session::all();   
        $userEmail 		  = $data['user']['email'];
        $user_id	      = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	      = $data['user']['emp_id'];           
        $employee_name 	  = $data['user']['employee_name'];

        $obj 	  = Incident::find($r['id']);
        $obj->id  =  $r['id'];
		
		if($r['reject1'] == 'reject1'){ 
			$obj->manager_action =  '0';
			$obj->manager_reject =  'Y';
			$obj->rm_rej_cmnt 	 =  $r['rm_rej_cmnt'];
			$obj->action_date    =  Carbon::createFromFormat('d/m/Y', $r['managerdate'])->format('Y-m-d');
			$obj->action_time    =  $r['managertime']; //date("H:i");
			$obj->save();
		}else{
			$obj->manager_reject =  'N';
			$obj->manager_action =  '1';
			$obj->rm_rej_cmnt 	 =  ' ';
			$obj->safety_action  =  '0';
			$obj->action_date    =  Carbon::createFromFormat('d/m/Y', $r['managerdate'])->format('Y-m-d');
			$obj->action_time    =  $r['managertime'];
			$obj->save();
		}        
        
		if($r['reject1'] != 'reject1'){
			$rm = new RMcomment;
			$rmID = SHcomment::select('incident_id')->where('incident_id','=',$r['id'])->get()->toArray();
			if($rmID[0]['incident_id'] > 0){        
			 DB::table('rm_comment')
				->where('incident_id', $r['id'])
				->update(array('rm_date' => Carbon::createFromFormat('d/m/Y', $r['managerdate'])->format('Y-m-d'),
							   'rm_time' => $r['managertime'],
							   'rm_comment' => $r['managercomment']));
			}else{
			  $rm->incident_id = $r['id']; 
			  if(!empty($r->managerdate)){
				  $rm->rm_date = Carbon::createFromFormat('d/m/Y', $r['managerdate'])->format('Y-m-d');
				}
			
			  $rm->rm_time		= $r['managertime'];
			  $rm->rm_comment	= $r['managercomment'];
			  $rm->save();
		  }
        }
   //dd($r);
		if($r['submit1'] == 'submit1'){ 
			$mailsend = array();     
			$url=url('/login'); 				
			//Admin CC email
			$adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
			$mailsend []    = $adminCC[0]['admin_cc_email'];
			
			$empQ	  		= Employeepersonal::select('master_employee.emp_no')			
													->where('email','=',$obj->emp_email)
													->get()->first();
			$getSChamps 	= SChampDstore::select('*')->where('emp_code','=',$empQ->emp_no)->get()->first();
			$sChamp1 		= UserHelper::getSchamp1($getSChamps->schamp_id1);
			$sChamp2 		= UserHelper::getSchamp2($getSChamps->schamp_id2);	
			$repDays 		= ReptDays::find(1); 
			$safety  		= Employeepersonal::select('master_employee.email as def_safety_email')			
													->where('emp_no','=',$repDays->def_schamp_id)
													->get()->first();
			if(isset($sChamp1)){
				$mailsend []  = $sChamp1->schamp_email1;
			}	
			  
			if(isset($sChamp2)){
				$mailsend []  = $sChamp2->schamp_email2;
			}	
			  
			if((!isset($sChamp1)) && (!isset($sChamp2))){
				$mailsend []  = $safety->def_safety_email;
			}											
			
			$edit  = Incident::find($r['id']);
			$mailtoEMP 	= Incident::select('emp_email')->where('id','=',$r['id'])->get()->toArray();
			$mailsend [] = $mailtoEMP[0]['emp_email'];
			//dd($mailsend);
			//die;
			foreach ($mailsend as $mailone){          
				$to_mail = $mailone;          
				$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_no'=>$r['id'],'reptby'=>$mailtoEMP[0]['emp_email'],'url'=>$url];
				//dd($data);
				Mail::send('admin.mail.rminci', $data, function($message) use ($data) {
					$message->to($data['email'])->subject($data['subject']);
					//dd($data);
					//die;
					// $message->from(env('service_mail'),'Incident-Reporting');
					$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
				});
			  }
		}
		
		if($r['reject1'] == 'reject1'){ 
			$mailsend = array();     
			$url=url('/login'); 				
			
			//Admin CC email
			$adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
			$mailsend []    = $adminCC[0]['admin_cc_email'];
			
			$empQ	  		= Employeepersonal::select('master_employee.emp_no')			
													->where('email','=',$obj->emp_email)
													->get()->first();
			$getSChamps 	= SChampDstore::select('*')->where('emp_code','=',$empQ->emp_no)->get()->first();
			$sChamp1 		= UserHelper::getSchamp1($getSChamps->schamp_id1);
			$sChamp2 		= UserHelper::getSchamp2($getSChamps->schamp_id2);	
			$repDays 		= ReptDays::find(1); 
			$safety  		= Employeepersonal::select('master_employee.email as def_safety_email')			
													->where('emp_no','=',$repDays->def_schamp_id)
													->get()->first();
			if(isset($sChamp1)){
				$mailsend []  = $sChamp1->schamp_email1;
			}	
			  
			if(isset($sChamp2)){
				$mailsend []  = $sChamp2->schamp_email2;
			}	
			  
			if((!isset($sChamp1)) && (!isset($sChamp2))){
				$mailsend []  = $safety->def_safety_email;
			}
			
			$edit  = Incident::find($r['id']);
			$mailtoEMP 	= Incident::select('emp_email')->where('id','=',$r['id'])->get()->toArray();
			$mailsend [] = $mailtoEMP[0]['emp_email'];
			//dd($mailsend);
			//die;
			foreach ($mailsend as $mailone){          
				$to_mail = $mailone;          
				$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_no'=>$r['id'],'reptby'=>$mailtoEMP[0]['emp_email'],'url'=>$url];
				Mail::send('admin.mail.rmrejinci', $data, function($message) use ($data) {
					$message->to($data['email'])->subject($data['subject']);
					//dd($data);
					//die;
					// $message->from(env('service_mail'),'Incident-Reporting');
					$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
				});
			  }
		}
		
		return redirect("/admin/admin-dashboard");
   }
   
    public function incidentview($id){
        $data           = Session::all(); 
		$userEmail 	  	= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name']; 
		$flag 			= 'view';	
        
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();
			
		//dd($edit[0]['name']);			
		    $employeeName = Employeepersonal::select('name')->where('email','=',$userEmail)->get()->toArray();		
		
        $rmedit = Incident::select('incident.*','rm_comment.incident_id','rm_comment.rm_date',
									'rm_comment.rm_comment','rm_comment.rm_time')
                          ->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();
        if(empty($rmedit)){
          $emptyrm=[];
        }else{
          $rmdata=$rmedit;
         // dd($rmdata);
        };        
        
		//SH table
      $shedit = Incident::select('incident.*','sh_comment.*')
                        ->join('sh_comment', 'sh_comment.incident_id', '=', 'incident.id')
                        ->where('incident.id','=',$id)
                        //->whereNotNull('sh_comment.comment_name')
                        //->where('sh_comment.comment_desg','=','SH')
                        ->get()->toArray();
		if(empty($shedit)){
          $emptyza=[];
        }else{
          $shedit=$shedit;
        }
        //DB::enableQueryLog(); 
		  $sh_main_cmnt = Incident::where('id','=',$id)->whereNotNull('extra_info')->get();
      //dd(DB::getQueryLog());
		  if(empty($sh_main_cmnt)){
          $sh_main_cmnt=[];

        }else{
          $sh_main_cmnt=$sh_main_cmnt;
        }	
        
      $todayDate = Carbon::now();
		  $todayDate = date('d/m/Y', strtotime($todayDate));
		
		$sh_cmnt 	 = SHcomment::where('incident_id','=',$id)->where('status','=','Need Info')->where('flag','!=',3)->get()->last();		
		$has_comment = SHcomment::where('incident_id','=',$id)->get()->last();
		$rm_cmnt_chk = SHcomment::where('incident_id','=',$id)->where('status','=','Normal Comment')->where('flag',array(0,2))->get()->last();		
		//$rm_cmnt_close=SHcomment::where('incident_id','=',$id)->whereIn('flag',array(0,2))->get()->last();		
		//dd($has_comment);
		return view('rm.incidentedit')
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
            ->with('flag',$flag )       
            ->with('email', $userEmail);         
    }
}
