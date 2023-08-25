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
use App\Models\SHcomment;
use App\Models\Employeepersonal;
use App\Models\Employeeextra;
use App\Activities;
use App\Models\RMcomment;
use App\Models\Zonalad;
use App\Models\ReportTemp;
use App\Models\SChampInfo1;
use App\Models\SChampInfo2;
use App\Models\SChampDstore;

use Session;
use Hash;
use File;
use Eloquent;
use Mail;
use DateTime;
use Input;
use DB;
use DataTables;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;
//use Box\Spout\Common\Type;
//use Box\Spout\Writer\WriterFactory;
//use Box\Spout\Writer\Style\StyleBuilder;
//use Box\Spout\Writer\Style\Color;
use Rap2hpoutre\FastExcel\SheetCollection;

class ReportController extends Controller{

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

       if($userrole_id == 1){
        $title = 'Super Admin';
		 return view('reports.dashboard')					   
                ->with('role',$userrole_id )
                ->with('email', $userEmil)				
                ->with('title', $title);
        }elseif($userrole_id == '4'){
          return view('reports.dashboard')					   
                ->with('role',$userrole_id )
                ->with('email', $userEmil)				
                ->with('title', $title); 
		   
		}              
	}
	
	public function generateReport(Request $req){
		
	   $data 			    = Session::all();
       $userEmil 		    = $data['user']['email'];
       $user_id	 		    = $data['user']['user_id'];
       $userrole_id 	    = $data['user']['role_id'];           
       $emp_id 	 		    = $data['user']['emp_id'];           
       $employee_name 	    = $data['user']['employee_name'];           
       $dateRange			= $_GET['searchdate'];	   
	  
	   $whereRaw=[];
       $c=0;
	   if($req->rep_type == 'to'){
		$whereRaw[$c] = " incident.status_e IN ('1','0')";
		$c++;
	   }elseif($req->rep_type == 'rm'){
		$whereRaw[$c] = " incident.status_e= '1' AND manager_action= '0'";
		$c++;
	   }elseif($req->rep_type == 'sf'){
		$whereRaw[$c] = " incident.status_e= '1' AND manager_action= '1' AND safety_action= '0'";
		$c++;
	   }
	  
	   if($req->incident_from_date != Null){
		$from_date = Carbon::createFromFormat('d/m/Y', $req->incident_from_date)->format('Y-m-d');		
	   }
	   
	   if($req->incident_to_date != Null){
		$to_date = Carbon::createFromFormat('d/m/Y', $req->incident_to_date)->format('Y-m-d');		
	   }
	   
	   if($req->incident_no != Null){
		$whereRaw[$c] = " incident.id=".$req->incident_no;
		$c++;
	   }
	   
	   if($req->Type != Null){
		$whereRaw[$c] = " incident.inc_type=".$req->Type;
		$c++;
	   }
	   
	   if($req->Status != Null){
		$whereRaw[$c] = " incident.injured_status=".$req->Status;
		$c++;
	   }
	   
	   if($req->State != Null){
		$whereRaw[$c] = " incident.state=".$req->State;
		$c++;
	   }
	   
	   if($req->District != Null){
		$whereRaw[$c] = " incident.district=".$req->District;
		$c++;
	   }
	   
	   if($req->City != Null){
		$whereRaw[$c] = " incident.city=".$req->City;
		$c++;
	   }
	   
	   if($c==0){
            $whereRaw=1;
        }else{
            $whereRaw=implode(' AND ',$whereRaw);
        }
	   //DB::enableQueryLog();
	   $table=Incident::select('incident.*','incident.id as in_id','incident.created_at as emp_crdt','city.name as cityname','district.name as disname',
                               'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype',
							   'master_employee.emp_no as emp_id','master_employee.name as emp_name','master_employee.plant','master_employee.plant_name','master_employee.sbu','master_employee.b_func','sh_comment.*',
							   'employee_personal_information.employee_dob')
							  ->join( 'users','users.email', '=', 'incident.emp_email')
							  ->leftJoin( 'employee_personal_information','employee_personal_information.employee_email', '=', 'users.email')
							  ->join( 'master_employee','master_employee.email', '=', 'users.email')
							  ->join('city', 'city.id', '=', 'incident.city')
							  ->join('state', 'state.id', '=', 'incident.state')
							  ->leftJoin('district', 'district.id', '=', 'incident.district')
							  ->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
							  ->join('status_type', 'status_type.id', '=', 'incident.injured_status')
							  ->leftJoin('sh_comment','sh_comment.incident_id','=','incident.id')	
							  //->where('emp_email','=',$userEmil)
							  ->where('role_id','=','2')
							  ->where('incident.save_draft','=','1')
							  ->whereBetween('incident_date',[$from_date, $to_date])
							  ->whereRaw($whereRaw)
							  ->orderBy('incident.id','desc')
							  ->get();
							  
		// Begin Transaction
        DB::beginTransaction();
        try
        {
            ReportTemp::truncate();
            $rowData = [];
            foreach ($table as $request_arr){
				if($request_arr->employee_dob != ''){
				  $to   = new DateTime('today');
				  $from = new DateTime($request_arr->employee_dob);
				  $emp_age = $from->diff($to)->y;
				}else{
				  $emp_age = '';	
				}
				
				$empZone = UserHelper::GetEmpZone($request_arr->emp_email);
				$RMName  = UserHelper::GetRMName($request_arr->manager_id);
				$RMFirstComment = UserHelper::GetRM1stComment($request_arr->in_id);
				$RMlcmnt = UserHelper::GetRMLastComment($request_arr->in_id);
				$rmLst = explode("-", $RMlcmnt);
				$RMLastcmnt = $rmLst[0];
				$RMcmnt_org = html_entity_decode(htmlentities($rmLst[1]));
				$RMcmnt1 = preg_replace("/&#?[a-z0-9]+;/i","",$RMcmnt_org);
				$RMcmnt = filter_var($RMcmnt1, FILTER_SANITIZE_STRING);;
				
				if($RMFirstComment != ''){
					$fdate = strtotime($request_arr->emp_crdt);	
					$var1 = substr($RMFirstComment,0,10);
					$date1 = str_replace('/', '-', $var1);
					$RMLastCmntdt = strtotime($date1);
					$RMTAT = (($RMLastCmntdt - $fdate)/86400);
				}				
				if($request_arr->sf_date != ''){
				 $sf_date = Carbon::parse($request_arr->sf_date)->format('d/m/Y');
				}
				if($request_arr->extra_info == 'yes'){
					$shCmnt = $request_arr->need_informationsh;
					if($RMLastcmnt != ''){
						$to = strtotime($request_arr->sf_date);	
						$var = substr($RMLastcmnt,0,10);
						$date = str_replace('/', '-', $var);
						$RMLastcmntdt = strtotime($date);
						$SFTAT = (($to - $RMLastcmntdt)/86400);
						if($SFTAT < 0){
							$SFTAT = '';
						  }	
					}
				}else{
					  $shCmnt = UserHelper::GetSFComment($request_arr->in_id);
					  if($request_arr->sf_date != ''){
						  $to = strtotime($request_arr->sf_date);	
						  $var = substr($RMLastcmnt,0,10);
						  $date = str_replace('/', '-', $var);
						  $RMLastcmntdt = strtotime($date);
						  $SFTAT = (($to - $RMLastcmntdt)/86400);
						  if($SFTAT < 0){
							$SFTAT = '';
						  }
					  }
				}				
								
				$rowData[] = [
						'in_id' => $request_arr->in_id,
						'emp_id' => $request_arr->emp_id,
						'emp_name' => $request_arr->emp_name,
						'emp_age' => $emp_age,
						'empZone' => $empZone,
						'plant' => $request_arr->plant.'-'.$request_arr->plant_name,
						'sbu' => $request_arr->sbu,
						'branch' => $request_arr->plant_name,
						'dept' => $request_arr->b_func,
						'incident_date' => Carbon::parse($request_arr->incident_date)->format('d/m/Y'),
						'incident_time' => $request_arr->incident_time,
						'emp_crdt' => Carbon::parse($request_arr->emp_crdt)->format('d/m/Y'),
						'actiontype' => $request_arr->actiontype,
						'incident_location' => $request_arr->incident_location,
						'incident_description' => $request_arr->incident_description,
						'status_name' => $request_arr->status_name,
						'staname' => $request_arr->staname,
						'disname' => $request_arr->disname,
						'cityname' => $request_arr->cityname,
						'RMName' => $RMName,
						'RMFirstComment' => $RMFirstComment,
						'RMLastcmnt' => $RMLastcmnt,
						'RMTAT' => $RMTAT,
						'RMComment' => $RMcmnt,
						'sf_date' => $sf_date,
						'sf_time' => $request_arr->sf_time,
						'SFTAT' => $SFTAT,
						'sf_comment' => $shCmnt,
						'status_e' => $request_arr->status_e == 0 ? 'Close' :'Open',
					];				
			}
			// Inset as chunk as insertation large data may cause issue
			foreach (array_chunk($rowData,1000) as $chunkData)  {
				DB::table('report_temp')->insert($chunkData);	
			}		
            DB::commit();
			
			$report=ReportTemp::get();
			
			//die;	
            ReportTemp::truncate();
			//$path=$_SERVER["DOCUMENT_ROOT"].'/incident_reporting/public/assets/uploads';
			 $path=$_SERVER["DOCUMENT_ROOT"].'/Incident-Reporting/public/assets/uploads';
			 $file=$path.'/IncidentReport.xlsx';		
			 $name = basename($file);
			 
            (new FastExcel($report))->export($path.'/IncidentReport.xlsx', function ($report) {				
                return [
                    'Incident No.' => $report->in_id,
					'Employee ID' => $report->emp_id,
					'Employee Name' => $report->emp_name,
					'Employee Age(Years)' => $report->emp_age,
                    'Zone' => $report->empZone,
                    'Plant' => $report->plant,
                    'SBU' => $report->sbu,
					'Branch' => $report->branch,
					'Dept' => $report->dept,
                    'Incident Date' => $report->incident_date,
                    'Incident Time' => $report->incident_time,
                    'Emp Reported Date' => $report->emp_crdt,
					'Type of Incident' => $report->actiontype,
					'Exact Location of Incident' => $report->incident_location,
					'Incident Description' => $report->incident_description,
					'Status of Injured Person' => $report->status_name,
					'State' => $report->staname,
					'District' => $report->disname,
					'City' => $report->cityname,
					'RM Name' => $report->RMName,
					'RM First Comment Date Time' => $report->RMFirstComment == '' ? '' :$report->RMFirstComment,
					'RM Last Comment Date Time' => $report->RMLastcmnt == '' ? '' :$report->RMLastcmnt,
					'RMTAT' => $report->RMTAT == '' ? '' :$report->RMTAT,
					'RM Comment' => $report->RMComment == '' ? '' :$report->RMComment,
					'SH Action Date' => $report->sf_date == '' ? '' :$report->sf_date,
					'SH Action Time' => $report->sf_time,
					'SHTAT' => $report->SFTAT == '' ? '' :$report->SFTAT,
					'SH Comment' => $report->sf_comment == '' ? '' :$report->sf_comment,
					'Incident Status' => $report->status_e,			
                ];
            });

			
			
		}catch (\Exception $e) {
            // Rollback Transaction
            DB::rollback();
        }				  
		//die;
		return view('reports.dashboard')
                ->with('tabledata',$table)
                ->with('role',$userrole_id)				
                ->with('rep_type',$req->rep_type)
                ->with('from_date',$req->incident_from_date)
                ->with('to_date',$req->incident_to_date)
                ->with('incident_no',$req->incident_no)
                ->with('rep_type',$req->rep_type)
                ->with('Type',$req->Type)
                ->with('Status',$req->Status)
                ->with('State',$req->State)
                ->with('District',$req->District)
                ->with('City',$req->City);
	}	
	
	public function viewHRep(){
	   $data 			    = Session::all();       
       $userrole_id 	    = $data['user']['role_id'];           
       $emp_id 	 		    = $data['user']['emp_id'];           
       $employee_name 	    = $data['user']['employee_name'];  
       
        $title = 'Download Health Information Report';
        return view('reports.healthrep')
				->with('title', $title)
				->with('role', $userrole_id);	   
    }

	public function locationWiseSafetyChampDownload(Request $request) {
		try {
			$locationCode = isset($_GET['location_code']) ? $_GET['location_code'] : 'all';
		$where = '';
		if($locationCode !== 'all') {
			$where = " WHERE safety_champ_dstore.schamp_loc_code = ".$locationCode;
		}
		$screport = DB::select("SELECT safety_champ_dstore.*, master_employee.name as emp_name, master_employee.rpt_code as rm_code
								FROM safety_champ_dstore 
								INNER JOIN master_employee on master_employee.emp_no = safety_champ_dstore.emp_code 
								INNER JOIN users ON users.username = safety_champ_dstore.emp_code
								".$where." ORDER BY emp_code ASC");
		//dd(DB::getQueryLog());							
			//$path= $_SERVER["DOCUMENT_ROOT"].'/incident_reporting/public/assets/uploads';
			$path= $_SERVER["DOCUMENT_ROOT"].'/Incident-Reporting/public/assets/uploads';
			
            (new FastExcel($screport))->export($path.'/LocationWiseSChampInfoReport.xlsx', function ($screport) {	
					//$dob = date('d/m/Y', strtotime($screport->employee_dob));				
					$locname = UserHelper::getLocName($screport->schamp_loc_code);
					$sc1  	 = UserHelper::getSchamp1($screport->schamp_id1);
					$sc2  	 = UserHelper::getSchamp2($screport->schamp_id2);
					return [
					'Location' => $locname->location,                    
					'Employee Name' => $screport->emp_name,
					'Safety Champion1 Name' => $sc1->schamp_name1,
					'Safety Champion1 Email' => $sc1->schamp_email1,
					'Safety Champion2 Name' => $sc2->schamp_name2,
					'Safety Champion2 Email' => $sc2->schamp_email2,
					
					
                ];
            });
			
			$file=$path.'/LocationWiseSChampInfoReport.xlsx';
			$name = basename($file);
			return response()->download($file, $name);
			return redirect('admin/saftchamp-list');

		} catch(\Exception $e) {
			echo $e->getMessage();
			exit();

		}
		
	}
	
	public function downloadHRep(){
		$title = 'Download Health Information Report';
		
		$hreport=Employeeextra::select('employee_personal_information.*','ms.emp_no as emp_id',
										 'ms.name as emp_name','ms.tphn_no1 as tel_no1')
									->join( 'master_employee as ms','ms.email', '=', 'employee_personal_information.employee_email')
									->get();
									
			//$path= $_SERVER["DOCUMENT_ROOT"].'/incident_reporting/public/assets/uploads';
			$path= $_SERVER["DOCUMENT_ROOT"].'/Incident-Reporting/public/assets/uploads';
			
            (new FastExcel($hreport))->export($path.'/HealthInfoReport.xlsx', function ($hreport) {	
					$dob = date('d/m/Y', strtotime($hreport->employee_dob));
                return [                    
					'Employee ID' => $hreport->emp_id,
					'Employee Name' => $hreport->emp_name,
					'Employee Gender' => $hreport->employee_sex == 'M' ? 'Male' :'Female',
					'Employee DOB' => $dob,
					'Employee Primary Mobile No' => $hreport->employee_mobile,
					'Employee Secondary Mobile No' => $hreport->tel_no1,
					'Employee Address' => $hreport->employee_address,
					'Employee Emergency Contact' => $hreport->emergency_contactname,
					'Employee Relationship' => $hreport->relation,
					'Employee Blood Group' => $hreport->blood_group,
					'Employee Emergency No' => $hreport->emergency_number,
					'Diabetic' => $hreport->diabetic == 'no' ? 'No' :'Yes',
					'BP Problem' => $hreport->bp_problem == 'no' ? 'No' :'Yes',
					'Respiratory Disorders' => $hreport->sinus == 'no' ? 'No' :'Yes',
					'Allergic' => $hreport->allergic == 'no' ? 'No' :'Yes',
					'Extra Information' => $hreport->information_share,
					'Any Other illness' => $hreport->illness == 'no' ? 'No' :'Yes',
					//'COVID First Does Taken' => $hreport->first_vaccine == 'no' ? 'No' :'Yes',
					//'COVID Second Does Taken' => $hreport->second_vaccine == 'no' ? 'No' :'Yes',
                    			
                ];
            });
			
			$file=$path.'/HealthInfoReport.xlsx';
			$name = basename($file);
			return response()->download($file, $name);
			return redirect('reports/healthrep');			
	}
	
	public function viewSchampRep(){
	   $data 			    = Session::all();       
       $userrole_id 	    = $data['user']['role_id'];           
       $emp_id 	 		    = $data['user']['emp_id'];           
       $employee_name 	    = $data['user']['employee_name'];  
       
        $title = 'Download Employee Master';
        return view('reports.schamprep')
				->with('title', $title)
				->with('role', $userrole_id);	   
    }
	
	public function downloadSchampRep(Request $req){
		$title = 'Download Health Information Report';
		
		$where = '';		
		if(isset($req->schamp_loc_code)){			
			if($req->schamp_loc_code != 'all'){
				$where = " AND schamp_loc_code = ".$req->schamp_loc_code;
			}
		}
		if(isset($req->schamp_b_func_id)){			
			if($req->schamp_b_func_id != 'all'){
				$where .= " AND schamp_b_func_id = ".$req->schamp_b_func_id;
			}
		}
		if(isset($req->emp_code)){			
				if($req->emp_code != 'all'){
					$where .= " AND emp_code = ".$req->emp_code;
				}
		}
		
		
		//DB::enableQueryLog();
		$screport = DB::select("SELECT safety_champ_dstore.*, master_employee.name as emp_name, master_employee.rpt_code as rm_code,users.last_logged_in as laslogin,users.log_in_from as loginfrom
								FROM safety_champ_dstore 
								INNER JOIN master_employee on master_employee.emp_no = safety_champ_dstore.emp_code 
								INNER JOIN users ON users.username = safety_champ_dstore.emp_code
								WHERE 1 ".$where." ORDER BY emp_code ASC");
		//dd(DB::getQueryLog());							
			//$path= $_SERVER["DOCUMENT_ROOT"].'/incident_reporting/public/assets/uploads';
			$path= $_SERVER["DOCUMENT_ROOT"].'/Incident-Reporting/public/assets/uploads';
			
            (new FastExcel($screport))->export($path.'/SChampInfoReport.xlsx', function ($screport) {	
					//$dob = date('d/m/Y', strtotime($screport->employee_dob));
					$rmDtlQ  = UserHelper::GetRMDtl($screport->rm_code);					
					$locname = UserHelper::getLocName($screport->schamp_loc_code);
					$bfname  = UserHelper::getBFName($screport->schamp_b_func_id);
					$sc1  	 = UserHelper::getSchamp1($screport->schamp_id1);
					$sc2  	 = UserHelper::getSchamp2($screport->schamp_id2);
					$lastLoginDate = !empty($screport->laslogin) ? date('d/m/Y',strtotime($screport->laslogin)) : '';
                    $lastloginTime = !empty($screport->laslogin) ? date('H:i:s',strtotime($screport->laslogin)) : '';
					return [                    
					'Employee ID' => $screport->emp_code,
					'Employee Name' => $screport->emp_name,
					'Reporting Manager Code' => $screport->rm_code,
					'Reporting Manager Name' => $rmDtlQ->name,
					'Reporting Manager Email' => $rmDtlQ->email,
					'Reporting Manager Phone No.' => $rmDtlQ->tphn_no1,
					'Employee Location' => $locname->location,
					'Employee Broad Function' => $bfname->b_func,
					'Safety Champion1 ID' => $screport->schamp_id1,
					'Safety Champion1 Name' => $sc1->schamp_name1,
					'Safety Champion1 Email' => $sc1->schamp_email1,
					'Safety Champion1 Phone No.' => $sc1->schamp_mobile1,
					'Safety Champion2 ID' => $screport->schamp_id2,
					'Safety Champion2 Name' => $sc2->schamp_name2,
					'Safety Champion2 Email' => $sc2->schamp_email2,
					'Safety Champion2 Phone No.' => $sc2->schamp_mobile2,
					'Login Date' => $lastLoginDate,
					'Login Time' => $lastloginTime,
					'Login From' => !empty($screport->loginfrom) ? $screport->loginfrom : '',
					//'Default Safety Champion' => $sc2->emergency_number,
                ];
            });
			
			$file=$path.'/SChampInfoReport.xlsx';
			$name = basename($file);
			return response()->download($file, $name);
			return redirect('reports/schamp-report');			
	}
	
}