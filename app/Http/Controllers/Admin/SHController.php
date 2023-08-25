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

use App\Models\Incident;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\Date_range_picker;
use App\Models\RMcomment;
use App\Models\SHcomment;
use App\Models\ReptDays;
use App\Branch;

//use App\Http\Requests\;


use phpDocumentor\Reflection\Types\Null_;
use Session;
use Hash;
use File;
use Eloquent;
use Mail;
use Auth;
use Input;
use DB;
use DataTables;
use Storage;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SHController extends Controller{
    
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
			
		    //dd($edit[0]['id']);			
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
		
		return view('sf.incidentedit')
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

    public function shcomment(Request $r){
        $data           = Session::all();
        $userEmail 	  	= $data['user']['email'];
        $user_id	      = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	      = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name']; 

        $obj  = Incident::find($r['id']);      
        if($r['needinfo'] == 'yes'){
          $obj->status_e          = 1;
          $obj->manager_action    = '0';
        }else{
          $obj->status_e          = $r['inci_close'];
        }
        $obj->safety_id           = $emp_id;
        $obj->safety_action       = '1'; 
        $obj->safety_date         = Carbon::createFromFormat('d/m/Y', $r['safetydate'])->format('Y-m-d');
        $obj->safety_time         = $r['safetytime'];     
        $obj->extra_info          = $r['needinfo'];
        $obj->need_informationsh  = $r['shneed'];
        $obj->save();
		
		if($r['needinfo'] != 'yes'){
			$sh = new SHcomment;        
			$shID = SHcomment::select('incident_id')->where('incident_id','=',$r['id'])->get()->toArray();       
			if($shID[0]['incident_id'] > 0){          
			  DB::table('sh_comment')
				 ->where('incident_id', $r['id'])
				 ->update(array('sf_date' => Carbon::createFromFormat('d/m/Y', $r['safetydate'])->format('Y-m-d'),
								'sf_time' => $r['safetytime'],
								'sf_comment' => $r['safetycomment']));
			 }else{
			   $sh->incident_id = $r['id']; 
			   if(!empty($r->safetydate)){
				   $sh->sf_date = Carbon::createFromFormat('d/m/Y', $r['safetydate'])->format('Y-m-d');
				 }
			 
			   $sh->sf_time=$r['safetytime'];
			   $sh->sf_comment=$r['safetycomment'];
			   $sh->save();
			 }
		}
  
        if($r['needinfo'] == 'yes'){
          $url=url('/login'); 
		  //Admin CC email
		  $adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
		  $mailsend[]   = $adminCC[0]['admin_cc_email'];
			
		  $empID 	    = Incident::select('emp_email')->where('id','=',$r['id'])->get()->toArray();
		  
          $reptMgrID 	= Incident::select('manager_id')->where('id','=',$r['id'])->get()->toArray();
          $mailtoreptmgr = Employeepersonal::select('email')->where('emp_no','=',$reptMgrID[0]['manager_id'])->get()->toArray();    
          $mailsend[]	= $mailtoreptmgr[0]['email'];
		  
		  $edit = Incident::find($r['id']); 
		  foreach ($mailsend as $mailone){ 	
			  $to_mail = $mailone;			
			  $data = ['subject'=>'Incident-Reporting','email'=>$to_mail,'inci_no'=>$r['id'],'reptby'=>$empID[0]['emp_email'],'url'=>$url];    
				  Mail::send('admin.mail.extrainfo', $data, function($message) use ($data) {  
					$message->to($data['email'])->subject($data['subject']);             
					$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
				  });
		  }
  
        }else{  
          if($r['inci_close'] == '0'){ 
            $mailsend2 = array(); 
            $url=url('/login');  
			//Admin CC email
			$adminCC 	   = ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
			$mailsend2[]   = $adminCC[0]['admin_cc_email'];
			
            $reptMgrID 	   = Incident::select('manager_id')->where('id','=',$r['id'])->get()->toArray();
            $mailtoreptmgr = Employeepersonal::select('email')->where('emp_no','=',$reptMgrID[0]['manager_id'])->get()->toArray();      
            $mailsend2[]   = $mailtoreptmgr[0]['email'];

            $empID 	       = Incident::select('emp_email')->where('id','=',$r['id'])->get()->toArray();          
            $mailsend2[]   = $empID[0]['emp_email'];        
            
            $edit = Incident::find($r['id']); 			
            foreach ($mailsend2 as $mailone){           
              $to_mail = $mailone;          
              $data=['subject'=>'Incident-Reporting','email'=>$to_mail,'inci_no'=>$r['id'],'reptby'=>$edit->emp_email,'url'=>$url];
              Mail::send('admin.mail.close', $data, function($message) use ($data) {  
                $message->to($data['email'])->subject($data['subject']);              
                $message->from(\Config::get('env.service_mail'),'Incident-Reporting');
              });          
            } 
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
	    $flag			= 'view';		
        
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();
			
		    //dd($edit[0]['id']);			
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
		
		return view('sf.incidentedit')
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