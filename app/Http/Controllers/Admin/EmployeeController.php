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
use App\Models\ReptDays;

use App\Models\Incident;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\Date_range_picker;
use App\Models\RMcomment;
use App\Models\SHcomment;

use App\Models\SChampDstore;
use App\Models\SChampInfo1;
use App\Models\SChampInfo2;

use App\Branch;

//use App\Http\Requests\;


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

class EmployeeController extends Controller
{

    public function personalform(Request $r){  
        $data 			  = Session::all();      
        $userEmail 		= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name = $data['user']['employee_name'];
               
        $report =   Employeepersonal::select('master_employee.*')         
                                        ->where('emp_no','=',$emp_id)
                                        ->get()->first();

       $empExtra = Employeeextra::select('employee_personal_information.*')         
                                    ->where('employee_email','=',$userEmail)
                                    ->get()->first();
		
	   $sDtl 	= SChampDstore::select('*')			
								->where('emp_code','=',$emp_id)
								->get()->first();
							
	   $sChamp1 = UserHelper::getSchamp1($sDtl->schamp_id1);				
	   $sChamp2 = UserHelper::getSchamp2($sDtl->schamp_id2);				
       $repDays = ReptDays::find(1); 
       $safety = Employeepersonal::select('master_employee.name as safety')			
                                    ->where('emp_no','=',$repDays->def_schamp_id)
                                    ->get()->first();  
										
       
       return view('employee.personalform')
                ->with('report',$report)
                ->with('empExtra',$empExtra)
                ->with('sChamp1',$sChamp1)
                ->with('sChamp2',$sChamp2)
                ->with('safety',$safety);
   }

   public function personaledit(Request $r){	
        $objExtra       = array();
        $da             = $r->all(); 
        $data 			= Session::all();      
        $userEmail 		= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name'];
    
    $bothtable = Employeepersonal::select('*')->where('email','=', $userEmail)->get('id');
    $obj	   = Employeepersonal::find($bothtable[0]['id']);
    
    $empExtra = Employeeextra::select('*')->where('employee_email','=', $userEmail)->get('id');
    if(count($empExtra)>0){
        $objExtra = Employeeextra::find($empExtra[0]['id']);
        
        $objExtra->employee_email=$userEmail;		
        //$objExtra->employee_age=$r['age'];			
        $objExtra->employee_sex=$r['sex'];
        $objExtra->employee_dob= Carbon::createFromFormat('d/m/Y', $r['dob'])->format('Y-m-d');			
        $objExtra->employee_zone=$r['zone'];
        $objExtra->employee_mobile=$r['mobile'];
        $objExtra->employee_address=$r['address'];
        $objExtra->save();
        $objExtra = Employeeextra::where('employee_email','=', $userEmail)->get()->first();
    }else{			
        $objExtra['employee_email']=$userEmail;	
        //$objExtra['employee_age']=$r['age'];			
        $objExtra['employee_sex']=$r['sex'];
        $objExtra['employee_dob']= Carbon::createFromFormat('d/m/Y', $r['dob'])->format('Y-m-d');			
        $objExtra['employee_zone']=$r['zone'];
        $objExtra['employee_mobile']=$r['mobile'];
        $objExtra['employee_address']=$r['address'];
        $objExtra['emergency_contactname']=$r['emp_conp'];
        $objExtra['blood_group']='';
        $objExtra['emergency_number']='';
        $objExtra['diabetic']='';
        $objExtra['sinus']='';       
        $objExtra['bp_problem']='';
        $objExtra['allergic']='';
        $objExtra['information_share']='';
        $objExtra['illness']=''; 
        
        $result= Employeeextra::insert($objExtra);
        //Session::flash('flash_message', 'Task successfully added!');
    }			
    return redirect("/admin/employee-personalform")
            ->with('status', 'Your answers successfully submitted');				
   }

   public function myhealth(Request $r){       
        $data           = Session::all();      
        $userEmail 		= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name'];  
        
        $report = Employeeextra::select('employee_personal_information.*')
                                    ->where('employee_email','=',$userEmail)
                                    ->get()->first();
       
        return view('employee.myhealth')
                 ->with('report',$report);
    } 

    public function myhealthedit(Request $r){		 
		$da             = $r->all();   
		$data           = Session::all();      
        $userEmail 		= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name'];
	
		$bothtable = Employeeextra::select('*')->where('employee_email','=', $userEmail)->get('id');    
		$obj       = Employeeextra::find($bothtable[0]['id']);
		if($obj['employee_email']==$userEmail){
			$obj->emergency_contactname=$r['emp_conp'];
			$obj->relation=$r['relation'];
			$obj->blood_group=$r['emp_blood'];
			$obj->emergency_number=$r['mobile'];
			$obj->diabetic=$r['options1'];
			$obj->sinus=$r['options3'];       
			$obj->bp_problem=$r['options2'];
			$obj->allergic=$r['options4'];
			$obj->first_vaccine=$r['options6'];
			$obj->second_vaccine=$r['options7'];
			$obj->information_share=$r['information'];
			$obj->illness=$r['options5'];       

			$obj->save();
			return redirect("/admin/employee-myhealth");
		}else{
			return redirect("/admin/employee-myhealth")
                    ->with('msg',"Sorry...something went wrong.");
		 }
    }

    public function incident(){       
        $data           = Session::all();      
        $userEmail 		= $data['user']['email'];
        $user_id	    = $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	    = $data['user']['emp_id'];           
        $employee_name 	= $data['user']['employee_name'];	
		
        $datePicker = Date_range_picker::get()->first();

		    $table = Employeepersonal::select('*')
                                  ->where('emp_no','=', $emp_id)
                                  ->get()->first();
         
        return view('employee.incident')
                ->with('tabledata',$table )		
                ->with('role', $userrole_id )
                ->with('datePicker',$datePicker )
                ->with('Employee_name', $userEmployeeName);                       
    }

    public function incidentrep(Request $r){
      $da			 =	$r->all();
      $data		     =	Session::all();      
      $userEmail 	 = $data['user']['email'];
      $user_id	     = $data['user']['user_id'];
      $userrole_id 	 = $data['user']['role_id'];           
      $emp_id 	     = $data['user']['emp_id'];           
      $employee_name = $data['user']['employee_name'];
      
      $reptMgrID 	 = Employeepersonal::select('rpt_code')->where('emp_no','=',$emp_id)->get()->toArray();	
	  $getSChamps 	 = SChampDstore::select('*')->where('emp_code','=',$emp_id)->get()->first();
	  $sChamp1 		 = UserHelper::getSchamp1($getSChamps->schamp_id1);
      $sChamp2 		 = UserHelper::getSchamp2($getSChamps->schamp_id2);	
      $repDays 		 = ReptDays::find(1); 
	  $safety  		 = Employeepersonal::select('master_employee.email as def_safety_email')			
											->where('emp_no','=',$repDays->def_schamp_id)
											->get()->first();	  
      //$safetyheadID  = Employeepersonal::select('emp_no')->where('desg','=','Head - Safety')->get()->toArray();	
      
      $obj= new Incident;      
      $obj->emp_email     = $userEmail;
      $obj->incident_date = Carbon::createFromFormat('d/m/Y', $r['Date'])->format('Y-m-d');
      $obj->incident_time = $r['Time'];
      $obj->inc_type      = $r['Type'];
      $obj->incident_location = $r['Location'];
      $obj->incident_description = $r['Description'];
      $obj->injured_status  = $r['Status'];      
      $obj->city          = $r['City'];
      $obj->district      = $r['District'];
      $obj->state         = $r['State'];		
      if ($r->file('Image')) {
          $imgfile = $r->file('Image');
          $tmp = explode('.', $imgfile->getClientOriginalName());
          $ext = end($tmp);
          $save_imgfile = rand().'-'.time(). '.'. $ext;
          $imgfile->move(public_path('assets/uploads/logo'), $save_imgfile);  
          $image = $save_imgfile;
      } else {
          $image = '';
      }
        $obj->image = $image; 
	  
	  if ($r->file('Image2')) {
          $imgfile2 = $r->file('Image2');
          $tmp2 = explode('.', $imgfile2->getClientOriginalName());
          $ext2 = end($tmp2);
          $save_imgfile2 = rand().'-'.time(). '.'. $ext2;
          $imgfile2->move(public_path('assets/uploads/logo'), $save_imgfile2);  
          $image2 = $save_imgfile2;
      } else {
          $image2 = '';
      }
        $obj->image2 = $image2;

	 if ($r->file('Image3')) {
          $imgfile3 = $r->file('Image3');
          $tmp3 = explode('.', $imgfile3->getClientOriginalName());
          $ext3 = end($tmp3);
          $save_imgfile3 = rand().'-'.time(). '.'. $ext3;
          $imgfile3->move(public_path('assets/uploads/logo'), $save_imgfile3);  
          $image3 = $save_imgfile3;
      } else {
          $image3 = '';
      }
        $obj->image3 = $image3;	
		
		//Get Auto Close Incident Type
		$autoClose = UserHelper::GetAutoCloseInciType($r['Type']);
		
        if($r['submit'] == 'submit'){
		 if($autoClose == 'Y'){	
			$obj->manager_action 	  = '1';
			$obj->action_date    	  = date('Y-m-d');
			$obj->action_time    	  = date("H:i:s");
			$obj->safety_action       = '1'; 
			$obj->safety_date         = date('Y-m-d');
			$obj->safety_time         = date("H:i:s"); 
			$obj->need_informationsh  = 'Auto Close';
			$obj->save_draft		  = '1';
			$obj->status_e			  = '0';
		 }else{
			 $obj->save_draft='1';
		 }
        }elseif($r['save'] == 'save'){
          $obj->save_draft='0';
        }	
		
        $obj->manager_id = $reptMgrID[0]['rpt_code'];
		if($getSChamps->schamp_id1 != ''){
			$obj->schamp_id1 = $getSChamps->schamp_id1;
		}else{
			$obj->schamp_id1 = $repDays->def_schamp_id;
		}
        if($getSChamps->schamp_id1 != ''){
			$obj->schamp_id2 = $getSChamps->schamp_id2;
		}else{
			$obj->schamp_id2 = $repDays->def_schamp_id;
		}
			$obj->safety_id  = $repDays->def_schamp_id;	
		
        $obj->save();  
		$lastInciID = $obj->id;
		
		if($autoClose == 'Y'){
			DB::table('rm_comment')->insert(
				 array(
						'incident_id' => $lastInciID, 
						'rm_date'  	  => date('Y-m-d'),
						'rm_time'  	  => date("H:i:s"),
						'rm_comment'  => 'Auto Close'
				 )
			);
			DB::table('sh_comment')->insert(
				 array(
						'incident_id' => $lastInciID, 
						'sf_date'  	  => date('Y-m-d'),
						'sf_time'  	  => date("H:i:s"),
						'sf_comment'  => 'Auto Close'
				 )
			);
		}
		
		$mailsend = array();
		if($r['submit'] == 'submit'){        
			$url      = url('/login');
			if($autoClose == 'N'){			 
				  if(isset($sChamp1)){
					 $mailsend []  = $sChamp1->schamp_email1;
				  }	
				  
				  if(isset($sChamp2)){
					 $mailsend []  = $sChamp2->schamp_email2;
				  }	
				  
				  if((!isset($sChamp1)) && (!isset($sChamp2))){
					 $mailsend []  = $safety->def_safety_email;
				  }	
				
				$mailtoreptmgr 	= Employeepersonal::select('email')->where('emp_no','=',$reptMgrID[0]['rpt_code'])->get()->toArray();
				$mailsend [] = $mailtoreptmgr[0]['email'];	
				
				//Admin CC email
				$adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
				$mailsend []    = $adminCC[0]['admin_cc_email'];
				
			   // dd($mailsend);
				//die;
				foreach ($mailsend as $mailone){
					  $to_mail = $mailone;
					  $data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_id'=>$lastInciID,'url'=>$url];
					  Mail::send('admin.mail.newinci', $data, function($message) use ($data) {
							$message->to($data['email'])->subject($data['subject']);
							$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
						});
				  }
			}else{
				$inciTypeName = UserHelper::GetInciTypeName($r['Type']);
				if(isset($sChamp1)){
					 $mailsend []  = $sChamp1->schamp_email1;
				  }	
				  
				  if(isset($sChamp2)){
					 $mailsend []  = $sChamp2->schamp_email2;
				  }	
				  
				  if((!isset($sChamp1)) && (!isset($sChamp2))){
					 $mailsend []  = $safety->def_safety_email;
				  }	
				
				$mailtoreptmgr 	= Employeepersonal::select('email')->where('emp_no','=',$reptMgrID[0]['rpt_code'])->get()->toArray();
				$mailsend [] = $mailtoreptmgr[0]['email'];	
				
				//Admin CC email
				$adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
				$mailsend []    = $adminCC[0]['admin_cc_email'];
				
				$mailsend [] = $userEmail;	
				foreach ($mailsend as $mailone){
					  $to_mail = $mailone;
					  $data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_id'=>$lastInciID,'url'=>$url,'inciTypeName'=>$inciTypeName];
					  Mail::send('admin.mail.autocloseinci', $data, function($message) use ($data) {
						  $message->to($data['email'])->subject($data['subject']);
						  $message->from(\Config::get('env.service_mail'),'Incident-Reporting');
					  });
				  }
			}
		}
        
		return redirect("/admin/admin-dashboard"); 			
	}

    public function incidentedit($id){
        $data            = Session::all(); 
		$userEmil 		 = $data['user']['email'];
        $user_id	 	 = $data['user']['user_id'];
        $userrole_id 	 = $data['user']['role_id'];           
        $emp_id 	 	 = $data['user']['emp_id'];           
        $employee_name 	 = $data['user']['employee_name'];        
        
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();			
			
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
		
		$sh_main_cmnt=Incident::where('id','=',$id)->whereNotNull('safety_comment')->get();
		  if(empty($sh_main_cmnt)){
          $sh_main_cmnt=[];

        }else{
          $sh_main_cmnt=$sh_main_cmnt;
        }	

        $todayDate = Carbon::now();
		    $todayDate = date('d/m/Y', strtotime($todayDate));	
        $datePicker = Date_range_picker::get()->first();

		return view('employee.incidentedit')
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
            ->with('datePicker',$datePicker )               
            ->with('email', $userEmail);         
  }

  public function incidenteditstore(Request $r){
        $data           = Session::all();		
        $userEmail 		= $data['user']['email'];
        $user_id	 	= $data['user']['user_id'];
        $userrole_id 	= $data['user']['role_id'];           
        $emp_id 	 	= $data['user']['emp_id'];           
        $employee_name  = $data['user']['employee_name'];
		
		$getSChamps 	= SChampDstore::select('*')->where('emp_code','=',$emp_id)->get()->first();
		$sChamp1 		= UserHelper::getSchamp1($getSChamps->schamp_id1);
		$sChamp2 		= UserHelper::getSchamp2($getSChamps->schamp_id2);	
		$repDays 		= ReptDays::find(1); 
		$safety  		= Employeepersonal::select('master_employee.email as def_safety_email')			
											->where('emp_no','=',$repDays->def_schamp_id)
											->get()->first();

        $obj = Incident::find($r['id']);	
        if(!empty($r->Date)){
            $obj->incident_date= Carbon::createFromFormat('d/m/Y', $r['Date'])->format('Y-m-d');
        }       
    
        $obj->incident_time         = $r['Time'];       
        $obj->inc_type              = $r['Type'];
        $obj->incident_location     = $r['Location'];
        $obj->incident_description  = $r['Description'];
        $obj->injured_status        = $r['Status'];
        $obj->city                  = $r['City'];
        $obj->district              = $r['District'];
        $obj->state=$r['State'];

        if ($r->file('Image')) {
            $imgfile = $r->file('Image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = rand().'-'.time() . '.' . $ext;  
            $imgfile->move(public_path('assets/uploads/logo'), $save_imgfile);            
            $image = $save_imgfile;      
        } else {
            if(isset($r['img_rem'])){
                $imgfile->move(public_path('assets/uploads/logo'), $save_imgfile);
                File::delete($save_imgfile . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            } 
        }

        $obj->image = $image; 
		
		if ($r->file('Image2')) {
            $imgfile2 = $r->file('Image2');
            $tmp2 = explode('.', $imgfile2->getClientOriginalName());
            $ext2 = end($tmp2);
            $save_imgfile2 = rand().'-'.time() . '.' . $ext2;  
            $imgfile2->move(public_path('assets/uploads/logo'), $save_imgfile2);            
            $image2 = $save_imgfile2;      
        } else {
            if(isset($r['img_rem2'])){
                $imgfile2->move(public_path('assets/uploads/logo'), $save_imgfile2);
                File::delete($save_imgfile2 . '/' . $obj->image2);
                $image2='';
            }else{
                $image2 = $obj->image2;
            } 
        }

        $obj->image2 = $image2; 
		
		if ($r->file('Image3')) {
            $imgfile3 = $r->file('Image3');
            $tmp3 = explode('.', $imgfile3->getClientOriginalName());
            $ext3 = end($tmp3);
            $save_imgfile3 = rand().'-'.time() . '.' . $ext3;  
            $imgfile3->move(public_path('assets/uploads/logo'), $save_imgfile3);            
            $image3 = $save_imgfile3;      
        } else {
            if(isset($r['img_rem3'])){
                $imgfile3->move(public_path('assets/uploads/logo'), $save_imgfile3);
                File::delete($save_imgfile3 . '/' . $obj->image3);
                $image3='';
            }else{
                $image3 = $obj->image3;
            } 
        }

        $obj->image3 = $image3; 
		//echo $r['manager_reject'];
		//die;
		 if($r['manager_reject'] == 'N'){
			$obj->manager_reject = 'N'; 
		 }
		
		//Get Auto Close Incident Type
		$autoClose = UserHelper::GetAutoCloseInciType($r['Type']);
		
        if($r['submit'] == 'submit'){
          if($autoClose == 'Y'){	
			$obj->manager_action 	  = '1';
			$obj->action_date    	  = date('Y-m-d');
			$obj->action_time    	  = date("H:i:s");
			$obj->safety_action       = '1'; 
			$obj->safety_date         = date('Y-m-d');
			$obj->safety_time         = date("H:i:s"); 
			$obj->need_informationsh  = 'Auto Close';
			$obj->save_draft		  = '1';
			$obj->status_e			  = '0';
		 }else{		
			 $obj->save_draft		  = '1';
		 }
        }elseif($r['save'] == 'save'){
            $obj->save_draft='0';
        }
 
		$obj->save();
	  
	  if($autoClose == 'Y'){
			DB::table('rm_comment')->insert(
				 array(
						'incident_id' => $r['id'], 
						'rm_date'  	  => date('Y-m-d'),
						'rm_time'  	  => date("H:i:s"),
						'rm_comment'  => 'Auto Close'
				 )
			);
			DB::table('sh_comment')->insert(
				 array(
						'incident_id' => $r['id'], 
						'sf_date'  	  => date('Y-m-d'),
						'sf_time'  	  => date("H:i:s"),
						'sf_comment'  => 'Auto Close'
				 )
			);
		}

		if($r['submit'] == 'submit'){
		  $mailsend = array();
		  $url=url('/login');
		  //Admin CC email
		  $adminCC 		= ReptDays::select('admin_cc_email')->where('id','=','1')->get()->toArray();
		  $mailsend []  = $adminCC[0]['admin_cc_email'];
		  $reptMgrID 	= Employeepersonal::select('rpt_code')->where('email','=',$userEmail)->get()->first();
		  //dd($reptMgrID->rpt_code);
		  if($autoClose == 'N'){		  			 
				  if(isset($sChamp1)){
					  //echo $sChamp1->schamp_email1;
					 $mailsend[]  = $sChamp1->schamp_email1;
				  }	
				  
				  if(isset($sChamp2)){
					 $mailsend[]  = $sChamp2->schamp_email2;
				  }				  
				  
				  if((!isset($sChamp1)) && (!isset($sChamp2))){
					 $mailsend[]  = $safety->def_safety_email;
				  }	
			  
			  $mailtoreptmgr 	= Employeepersonal::select('name', 'email')->where('emp_no','=',$reptMgrID->rpt_code)->get()->first();                      
			  $mailsend[] 		= $mailtoreptmgr->email;			  
			  //dd($mailsend);
			  //die;
			  foreach ($mailsend as $mailone){          
					$to_mail=$mailone;          
					$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_id'=>$r['id'],'url'=>$url]; 
					//dd($data);
					//die;
					Mail::send('admin.mail.newinci', $data, function($message) use ($data) {
							$message->to($data['email'])->subject($data['subject']);
							$message->from(\Config::get('env.service_mail'),'Incident-Reporting');
						});
				}
		   }else{
			   $mailsend [] = $userEmail;
				foreach ($mailsend as $mailone){          
					$to_mail=$mailone;          
					$data=['subject'=>'Incident-Reporting','email'=>$to_mail,'name'=>$employee_name,'inci_id'=>$r['id'],'url'=>$url]; 
					//dd($data);
					//die;
					 Mail::send('admin.mail.autocloseinci', $data, function($message) use ($data) {
					  $message->to($data['email'])->subject($data['subject']);                
					  $message->from(\Config::get('env.service_mail'),'Incident-Reporting');
					});
				}
		   }
		}	
		
		return redirect("/admin/admin-dashboard");
	}
  
  public function incidentview($id){
        $data            = Session::all(); 
		$userEmil 		 = $data['user']['email'];
        $user_id	 	 = $data['user']['user_id'];
        $userrole_id 	 = $data['user']['role_id'];           
        $emp_id 	 	 = $data['user']['emp_id'];           
        $employee_name 	 = $data['user']['employee_name'];        
        $flag 			 = 'view';
        $edit = Incident::select('incident.*','master_employee.name')
                          ->join('master_employee', 'master_employee.email', '=', 'incident.emp_email')
                          ->where('incident.id','=',$id)
                          ->get()->toArray();			
			
	  	$employeeName = Employeepersonal::select('name')->where('email','=',$userEmail)->get()->toArray();		
		
        $rmedit = Incident::select('incident.*','rm_comment.incident_id','rm_comment.rm_date',
									'rm_comment.rm_comment','rm_comment.rm_time')
                          ->join('rm_comment', 'rm_comment.incident_id', '=', 'incident.id')
						  ->orderBy('rm_date', 'desc')
						  ->orderBy('rm_time', 'desc')
						  ->limit(1)
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
		
		$sh_main_cmnt=Incident::where('id','=',$id)->whereNotNull('safety_comment')->get();
		  if(empty($sh_main_cmnt)){
          $sh_main_cmnt=[];

        }else{
          $sh_main_cmnt=$sh_main_cmnt;
        }	

        $todayDate = Carbon::now();
		    $todayDate = date('d/m/Y', strtotime($todayDate));	
        $datePicker = Date_range_picker::get()->first();

		return view('employee.incidentedit')
            ->with('edit',$edit)
            ->with('mode','View')
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
            ->with('datePicker',$datePicker )               
            ->with('flag',$flag )               
            ->with('email', $userEmail);         
  }
  
   public function incidentdelete($id){
        $data            = Session::all(); 
		$userEmil 		 = $data['user']['email'];
        $user_id	 	 = $data['user']['user_id'];
        $userrole_id 	 = $data['user']['role_id'];           
        $emp_id 	 	 = $data['user']['emp_id'];           
        $employee_name 	 = $data['user']['employee_name']; 
		
		DB::table('incident')->where('id', $id)->delete();  
		return redirect("/admin/admin-dashboard");       
  }

  public function search(Request $r){
      $data          = Session::all();		
      $userEmail 		 = $data['user']['email'];
      $user_id	 	   = $data['user']['user_id'];
      $userrole_id 	 = $data['user']['role_id'];           
      $emp_id 	 	   = $data['user']['emp_id'];           
      $employee_name = $data['user']['employee_name'];

   if($userrole_id == '2'){
        $output     = '';
        $inputValue = $r->get('search');

     if($inputValue != ''){
       $incidents=null;
       $incident1=null;
       $incident2=null;
      
       $incidents = Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname',
                                     'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype')
                              ->join( 'users','users.email', '=', 'incident.emp_email')
                              ->join('city', 'city.id', '=', 'incident.city')
                              ->join('state', 'state.id', '=', 'incident.state')
                              ->join('district', 'district.id', '=', 'incident.district')
                              ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                              ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                              ->where('emp_email','=',$userEmail)
                              ->distinct()
                              ->where('incident.status_e','=','1')
                              ->where('incident.incident_location', 'LIKE', "%" . $inputValue . "%" )
                              ->orwhere('incident.incident_description', 'LIKE', "%"  . $inputValue . "%" )
                              ->get();

         $table = Incident_type::select('*')
                                  ->where('incident_t', 'LIKE',  "%" .$inputValue.  "%")
                                  ->get();
        if ($incidents == null) {
           # code...
         $incidents=array();
         }else{
           $incidents = $incidents->toArray();
         }
         
        // dd($table[0]['id']);
        if(!empty($table[0]['id'])){
          $incident1 = Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname',
                                        'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype')
                                ->join( 'users','users.email', '=', 'incident.emp_email')
                                ->join('city', 'city.id', '=', 'incident.city')
                                ->join('state', 'state.id', '=', 'incident.state')
                                ->join('district', 'district.id', '=', 'incident.district')
                                ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                                ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                                ->where('emp_email','=',$userEmail)
                                ->distinct()
                                ->where('incident.status_e','=','1')
                                ->where('incident.inc_type', 'LIKE', "%" . $table[0]['id'] . "%" )
                                ->get();         
         }

         if ($incident1 == null) {
           # code...
         $incident1=array();
         }else{
           $incident1 = $incident1->toArray();
         }
         
          $status_type = Status_type::select('*')         
                                      ->where('status_name', 'LIKE',  "%" .$inputValue.  "%")
                                      ->get();
         
      if(!empty($status_type[0]['id'])){
            $incident2 = Incident::select('incident.*','incident.id as in_id','city.name','district.name as disname',
                                          'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype')
                                  ->join( 'users','users.email', '=', 'incident.emp_email')
                                  ->join('city', 'city.id', '=', 'incident.city')
                                  ->join('state', 'state.id', '=', 'incident.state')
                                  ->join('district', 'district.id', '=', 'incident.district')
                                  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
                                  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')				
                                  ->where('emp_email','=',$userEmail)
                                  ->distinct()
                                  ->where('incident.status_e','=','1')       
                                  ->where('incident.injured_status', 'LIKE', "%" . $status_type[0]['id'] . "%" )
                                  ->get();           
          }
          if ($incident2 == null) {
            # code...
          $incident2 = array();
          }else{
            $incident2 = $incident2->toArray();
          }
          $result = array_merge($incidents,$incident1,$incident2);
        

           foreach ($result as $da) {
           }   $word = "base64";
               $imgbase='';           
              if(empty($da["image"])){
                  $imgbase='<td></td>';
               }elseif(strpos($da["image"], $word) !== false) {
                  $imgbase= '<td>'.'<a href="'.$da["image"].'">'.'<img src="'.$da["image"].'" style="height:50px;width:50px;"/ >'.'</td>';
                }else{
                  $imgbase= '<td>'.'<a href="/Incident-Reporting/public/assets/uploads/logo/'.$da["image"].'">'.'<img src="/Incident-Reporting/public/assets/uploads/logo/'.$da["image"].'" style="height:50px;width:50px;"/ >'.'</td>';
                }  
                  
            // dd($da['in_id']);
             $output .= '<tr>'.
                        '<td>' . $da['in_id'] . '</td>' .
                        '<td>' . date('d/m/Y',strtotime($da['incident_date']))." ". $da['incident_time']. '</td>' .
                        '<td>' . $da['actiontype'] . '</td>' .
                        '<td>' . $da['incident_location'] . '</td>' .
                        '<td>' . $da['status_name'] . '</td>' .
                        '<td>' . $da['name']. '</td>' .
                            //'<td>' . $da['image']. '</td>' .
                 // '<td>'.'<a href="/Incident-Reporting/public/assets/uploads/logo/'.$da["image"].'">'.$da["image"].'</a></td>'.
                        $imgbase
                        // '<td>'.'<a href="{{$da["image"]}}">'.'<img src="{{$da["image"]}}" style="hight:50px;width:50px;"/ >'.'</td>'.
                        .'<td>'. ($da['status_e'] == '0' ? 'Close' : 'Open').'</td>'.

                  // '<td>'.($da['save_draft']=='1'? 'Edit': '<a href="/Incident-Reporting/admin/admin-incident-edit/'.$da["in_id"].'">Edit</a>'). '</td>' .
                        '<td>'.'<a href="/Incident-Reporting/admin/admin-incident-edit/'.$da["in_id"].'">Edit</a>'. '</td>' .
                        '</tr>';

            if($output == null){
               $output=[];
            }
           return Response($output);
        }
     }     
     
   }

}