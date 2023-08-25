<?php

namespace App\Helpers;

use App\Models\DateTime;
use App\Http\Request;
use App\Models\District;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\Incident;
use App\Models\Role;
use App\Models\Employeepersonal;
use App\Models\RMcomment;
use App\Models\SHcomment;
use App\Models\Zones;
use App\Models\SChampInfo1;
use App\Models\SChampInfo2;
use App\Models\ReptDays;
use Carbon\Carbon;
use DB;
use Hash;
use Auth;
use Mail;
use DataTables;
use Session;
use Redirect;
use Alert;
use Input;
use Illuminate\Support\Facades\Crypt;
use App\Providers\HelperServiceProvider;


class UserHelper extends HelperServiceProvider{
	
		
    public static function City($id){	
        $city	= City::select('city.*')
						->leftjoin('state','state.id','=','city.state_id')
						->where('city.state_id','=',$id)       
						->get();	
        return $city;
    }

    public static function District($id){
        $district	= District::select('district.*')
								->leftjoin('state','state.id','=','district.state_id')
								->where('district.state_id','=',$id)		  
								->get();								
        return $district;
    }
	
    public static function State(){
        $state=State::select('*')->get();
		
        return $state;
    }
	
	public static function GetStateName($id){	
        $districtName = State::select('state.name')						
									->where('id','=',$id)       
									->get()->toArray();												
        return $districtName[0]['name'];
    }
	
	public static function GetDistrictName($id){	
        $stateName = District::select('district.name')						
									->where('id','=',$id)       
									->get()->toArray();												
        return $stateName[0]['name'];
    }
	
	public static function GetCityName($id){	
        $cityName = City::select('city.name')						
									->where('id','=',$id)       
									->get()->toArray();												
        return $cityName[0]['name'];
    }
	
	
    public static function Incident_type(){
       $incident=Incident_type::select('*')
								 ->where('active_status','=','Y')
								 ->get();
	   
        return $incident;
    }
	
    public static function Status_type(){
        $status_type=Status_type::select('*')->get();
		
        return $status_type; 
    }
	
    public static function Count(){
		$data = Session::all();
		
        $userEmail 	 = $data['user']['email'];
        $user_id	 = $data['user']['user_id'];
        $userrole_id = $data['user']['role_id'];
    
		$Count	= Incident::select('*','users.id')
							->join('users', 'users.email', '=', 'incident.emp_email')
							->where('emp_email','=',$userEmail)
							->where('save_draft','=','1')        
							->get()->count();       
        return $Count;
    }
	
    public static function Open(){
		$data = Session::all();
        
        $userEmail	 = $data['user']['email'];
        $user_id	 = $data['user']['user_id'];
        $userrole_id = $data['user']['role_id'];
      
		$Open	= Incident::select('*','users.id')
							->join('users', 'users.email', '=', 'incident.emp_email')
							->where('email','=',$userEmail)
							->where('save_draft','=','1')
							->where('status_e','=','1')
        
        ->get()->count();
		
        return $Open;
    }
	
    public static function Close(){
		$data = Session::all();
       
        $userEmail 		  = $data['user']['email'];
        $user_id	      = $data['user']['user_id'];
        $userrole_id 	  = $data['user']['role_id'];           
        $emp_id 	      = $data['user']['emp_id'];           
        $employee_name 	  = $data['user']['employee_name'];
		$repDays 		  = ReptDays::find(1);
		//DB::enableQueryLog();
		if($userrole_id == 1){
			$Close	= Incident::select('incident.id')
								//->join('users', 'users.email', '=', 'incident.emp_email')	
								->where('manager_action','=','1')
								->where('safety_action','=', '1')	
								->where('status_e','=','0')  
								->where('save_draft','=','1')
								//->distinct()      
								->get()->count();  
		}elseif($userrole_id == 2){
			$Close	= Incident::select('incident.id')
								->join('users', 'users.email', '=', 'incident.emp_email')
								->where('email','=',$userEmail)
								->where('save_draft','=','1')
								->where('status_e','=','0')
								->distinct()        
								->get()->count();  
		}elseif($userrole_id == 3){			
			$Close	= Incident::select('incident.id')
							->join('users', 'users.email', '=', 'incident.emp_email')
							->where('manager_id','=',$emp_id)
							->where('save_draft','=','1')
							->where('status_e','=','0')  
							->distinct()      
							->get()->count(); 
		}elseif($userrole_id == 4){			
			$Close	= Incident::select('incident.id')
							->join('users', 'users.email', '=', 'incident.emp_email')
							//->where('safety_id','=',$emp_id)
							->where('save_draft','=','1')
							->where('status_e','=','0')
							->where('schamp_id1','=', $emp_id)
						    ->orWhere('schamp_id2','=', $emp_id)
							->where('safety_id','=', $repDays->def_schamp_id)	
							->distinct()     
							->get()->count(); 
		}    
		//dd(DB::getQueryLog());
        return $Close;
    }
	
	public static function Countrep(){
		$data = Session::all();    
        $userEmail 	 = $data['user']['email'];
        $user_id	 = $data['user']['user_id'];
        $userrole_id = $data['user']['role_id'];
        
		$Countrep = Incident::select('*','users.id')
							->join('users', 'users.email', '=', 'incident.emp_email')	   
							->where('save_draft','=','1')        
							->get()->count();        
        return $Countrep;
    }
	
	 public static function Openrep(){
		$data = Session::all();      
        $userEmail 	 = $data['user']['email'];
        $user_id	 = $data['user']['user_id'];
        $userrole_id = $data['user']['role_id'];
		
		$Openrep = Incident::select('*','users.id')
							->join('users', 'users.email', '=', 'incident.emp_email')	   
							->where('status_e','=','1')
							->where('save_draft','=','1')
							->get()->count();       
        return $Openrep;
    }
	
	 public static function Closerep(){
		$data	= Session::all();       
        $userEmployee_name = $data['user']['employee_name'];
        $user_id	 	   = $data['user']['user_id'];
        $userrole_id	   = $data['user']['role_id'];
        
		$Closerep	=	Incident::select('*','users.id')
								->join('users', 'users.email', '=', 'incident.emp_email')	  
								->where('status_e','=','0')
								->get()->count();        
        return $Closerep;
    }
		
	public static function Countall(){
		$data=Session::all();  
		//dd($data);		
        $userEmail 	   = $data['user']['email'];
        $user_id	   = $data['user']['user_id'];
        $userrole_id   = $data['user']['role_id'];           
        $emp_id 	   = $data['user']['emp_id'];           
        $employee_name = $data['user']['employee_name'];
		$repDays 	   = ReptDays::find(1);
        //DB::enableQueryLog();
		if($userrole_id == 1){			
			$Countall=Incident::select('incident.id')								
								->where('save_draft','=','1')								
								->whereIn('status_e',array('1','0'))								
								->get()->count();
			//dd(DB::getQueryLog());
			//die;
		}elseif($userrole_id == 2){			
			$Countall=Incident::select('incident.id')
								->join('users', 'users.email', '=', 'incident.emp_email')
								->where('emp_email','=',$userEmail)
								->where('save_draft','=','1')
								//->where('status_e','=','1')
								->whereIn('status_e',array('1','0'))
								->where('role_id','=','2')
								->get()->count();
			//dd(DB::getQueryLog());
			//die;									
		}elseif($userrole_id == 3){			
			$Countall=Incident::select('incident.id')
								->join('users', 'users.email', '=', 'incident.emp_email')			
								->where('save_draft','=','1')
								//->where('status_e','=','1')
								->whereIn('status_e',array('1','0'))
								->where('incident.manager_id','=',$emp_id)
								->whereIn('manager_action',array('1','0'))
								->where('role_id','=','2')
								->get()->count();		
		}elseif($userrole_id == 4){
			$Countall=Incident::select('incident.id')	
								->join('users', 'users.email', '=', 'incident.emp_email')																	
								->where('save_draft','=','1')
								//->where('status_e','=','1')
								->whereIn('status_e',array('1','0'))
								//->where('incident.safety_id','=',$emp_id)
								->whereIn('manager_action',array('1','0'))
								//->whereIn('safety_action',array('1','0'))
								->where('role_id','=','2')
								->where('schamp_id1','=', $emp_id)
							    ->orWhere('schamp_id2','=', $emp_id)
							    ->where('safety_id','=', $repDays->def_schamp_id)
								->get()->count();
		}	
		//dd(DB::getQueryLog());
		//die;	
        return $Countall;
    }
	
	public static function DraftInci(){
		$data		   = Session::all();      
        $userEmail 	   = $data['user']['email'];
        $user_id	   = $data['user']['user_id'];
        $userrole_id   = $data['user']['role_id'];           
        $emp_id 	   = $data['user']['emp_id'];           
        $employee_name = $data['user']['employee_name'];      
		//DB::enableQueryLog();		
		if($userrole_id == 1){	
			$draftInci		= Incident::select('incident.id')	
										->join('users', 'users.email', '=', 'incident.emp_email')
										//->where('incident.emp_email','=',$userEmail)  
										->where('save_draft','=','0')
										->where('status_e','=','1')
										//->where('manager_id','=',$reptMgrID[0]['rpt_code'])
										->where('manager_action','=', '0')
										->where('role_id','=','2')
										->get()->count();	
		}elseif($userrole_id == 2){	
		   $reptMgrID 		= Employeepersonal::select('*')->where('emp_no','=',$emp_id)->get()->toArray();				
		   $draftInci		= Incident::select('incident.id')	
		  								->join('users', 'users.email', '=', 'incident.emp_email')
										->where('incident.emp_email','=',$userEmail)  
										->where('save_draft','=','0')
										->where('status_e','=','1')
										->where('manager_id','=',$reptMgrID[0]['rpt_code'])
										->where('manager_action','=', '0')
										->where('role_id','=','2')
										->get()->count();	
	 	 }elseif($userrole_id == 3){
			$draftInci		= Incident::select('incident.id')
										->join('users', 'users.email', '=', 'incident.emp_email')																	
										->where('save_draft','=','0')
										->where('status_e','=','1')
										->where('incident.manager_id','=',$emp_id)
										->where('manager_action','=', '0')
										->where('role_id','=','2')
										->get()->count();
		}elseif($userrole_id == 4){
			$draftInci		= Incident::select('incident.*','users.id')	
										->join('users', 'users.email', '=', 'incident.emp_email')																	
										->where('save_draft','=','0')
										->where('status_e','=','1')
										//->where('incident.safety_id','=',$emp_id)
										->where('manager_action','=', '0')
										->where('role_id','=','2')										
										->where('schamp_id1','=', $emp_id)
										->orWhere('schamp_id2','=', $emp_id)
										->where('safety_id','=', $repDays->def_schamp_id)
										->get()->count();
		}					
		//dd(DB::getQueryLog());						
		//die;	
        return $draftInci;
    }
	
	public static function Pendingrm(){
		$data		   = Session::all();      
        $userEmail 	   = $data['user']['email'];
        $user_id	   = $data['user']['user_id'];
        $userrole_id   = $data['user']['role_id'];           
        $emp_id 	   = $data['user']['emp_id'];           
        $employee_name = $data['user']['employee_name'];
		$repDays 	   = ReptDays::find(1);	
		//DB::enableQueryLog();		
		if($userrole_id == 1){	
			$Pendingrm		= Incident::select('incident.id')				
										->where('save_draft','=','1')											
										->where('status_e','=','1')																					
										->where('manager_action','=', '0')
										->where('safety_action','=', '0')
										->get()->count();	
		}elseif($userrole_id == 2){	
		   $reptMgrID 		= Employeepersonal::select('*')->where('emp_no','=',$emp_id)->get()->toArray();				
		   $Pendingrm		= Incident::select('incident.id')	
		  								->join('users', 'users.email', '=', 'incident.emp_email')
										->where('incident.emp_email','=',$userEmail)  
										->where('save_draft','=','1')
										->where('status_e','=','1')
										->where('manager_id','=',$reptMgrID[0]['rpt_code'])
										->where('manager_action','=', '0')
										->where('manager_reject','<>', 'Y')
										->where('role_id','=','2')
										->get()->count();	
	 	 }elseif($userrole_id == 3){
			$Pendingrm		= Incident::select('incident.id')
										->join('users', 'users.email', '=', 'incident.emp_email')			
										->where('save_draft','=','1')
										->where('status_e','=','1')
										->where('incident.manager_id','=',$emp_id)
										->where('manager_action','=', '0')
										 ->where('manager_reject','=', 'N')
										->where('role_id','=','2')
										->get()->count();
		}elseif($userrole_id == 4){
			$Pendingrm		= Incident::select('incident.*','users.id')	
										->join('users', 'users.email', '=', 'incident.emp_email')		
										->where('save_draft','=','1')
										->where('status_e','=','1')
										//->where('incident.safety_id','=',$emp_id)
										->where('manager_action','=', '0')
										->where('role_id','=','2')
										->where('schamp_id1','=', $emp_id)
										->orWhere('schamp_id2','=', $emp_id)
										->where('safety_id','=', $repDays->def_schamp_id)
										->get()->count();
		}					
		//dd(DB::getQueryLog());						
		//die;

        return $Pendingrm;
    }
	
	public static function Pendingsh(){
	    $data	= Session::all();     
        $userEmail 	   = $data['user']['email'];
        $user_id	   = $data['user']['user_id'];
        $userrole_id   = $data['user']['role_id'];           
        $emp_id 	   = $data['user']['emp_id'];           
        $employee_name = $data['user']['employee_name']; 
		$repDays 	   = ReptDays::find(1);
		//DB::enableQueryLog();		
		if($userrole_id == 1){	
			$Pendingsh		= Incident::select('incident.id')																			
										->where('save_draft','=','1')
										->where('status_e','=','1')																			
										->where('manager_action','=', '1')
										->where('safety_action','=', '0')										
										->get()->count();	
		}elseif($userrole_id == 2){	
			$reptMgrID 		= Employeepersonal::select('*')->where('email','=',$userEmail)->get()->toArray();				
			$Pendingsh		= Incident::select('incident.id')	
										->join('users', 'users.email', '=', 'incident.emp_email')
										 ->where('emp_email','=',$userEmail)			
										  ->where('manager_id','=',$reptMgrID[0]['rpt_code'])										  
										  ->where('save_draft','=','1')
										  ->where('manager_action','=','1')
										  ->where('safety_action','=', '0')
										  ->where('role_id','=','2')
										  ->where('incident.status_e','=','1')
										  ->orderBy('in_id', 'DESC')->count(); 										
		}elseif($userrole_id == 3){
			$Pendingsh		= Incident::select('incident.id')	
											->join('users', 'users.email', '=', 'incident.emp_email')																	
											->where('save_draft','=','1')
											->where('status_e','=','1')
											->where('incident.manager_id','=',$emp_id)
											->where('manager_action','=', '1')
											->where('safety_action','=', '0')
											->where('role_id','=','2')
											->get()->count();
		}elseif($userrole_id == 4){
			$Pendingsh		= Incident::select('incident.id')	
											->join('users', 'users.email', '=', 'incident.emp_email')																	
											->where('save_draft','=','1')
											->where('status_e','=','1')
											//->where('incident.safety_id','=',$emp_id)
											->where('manager_action','=', '1')
											->where('safety_action','=', '0')
											->where('role_id','=','2')
											->where('schamp_id1','=', $emp_id)
											->orWhere('schamp_id2','=', $emp_id)
											->where('safety_id','=', $repDays->def_schamp_id)
											->get()->count();
		}						
		//dd(DB::getQueryLog());
		//die;	
        return $Pendingsh;
    }
	
	 public static function Designation(){
        $Designation=Role::select('*')->get();
		
        return $Designation;
    }
	
	public static function GetRoles(){	
        $roles	= Role::select('roles.*')						
						->where('status','=','Y')       //Uncomment this line on 4-Dec-22 by Tousif, again comment on 26-Dec-22 by tousif due to issue
						->get();	
        return $roles;
    }

	public static function GetNameFromEmail($email){	
        $empName = Employeepersonal::select('master_employee.name')						
									->where('email','=',$email)       
									->get()->toArray();												
        return $empName[0]['name'];
    }
	
	public static function GetEmpZone($email){	
        $empPlant = Employeepersonal::select('master_employee.plant')						
									->where('email','=',$email)       
									->get()->toArray();	
									
		$empZone = Zones::select('zones.CCd')						
									->where('Plnt','=',$empPlant[0]['plant'])       
									->get()->toArray();									
        return $empZone[0]['CCd'];
    }
	
	public static function GetRMName($eid){	
		//DB::enableQueryLog();	
        $rmName = Employeepersonal::select('master_employee.name')						
									->where('emp_no','=',$eid)       
									->get()->toArray();		
		//dd(DB::getQueryLog());
		//die;									
        return $rmName[0]['name'];
    }
	
	public static function GetRMDtl($eid){	
		//DB::enableQueryLog();	
        $rmName = Employeepersonal::select('name','email','tphn_no1')						
									->where('emp_no','=',$eid)       
									->get()->first();		
		//dd(DB::getQueryLog());
		//die;									
        return $rmName;
    }
	
	public static function GetRM1stComment($inci_id){			
		$query = "SELECT * FROM rm_comment WHERE id = (SELECT MIN(id) FROM rm_comment WHERE incident_id='".$inci_id."')";
		$rm1stcmnt = DB::select($query);
		foreach($rm1stcmnt as $rm1st){			
			$rmfstcmnt = date('d/m/Y',strtotime($rm1st->rm_date)).' '.$rm1st->rm_time;	
		}
		return $rmfstcmnt;
    }
	
	public static function GetRMLastComment($inci_id){	
		$query = "SELECT * FROM rm_comment WHERE id = (SELECT MAX(id) FROM rm_comment WHERE incident_id='".$inci_id."')";
		$rmlstcmnt = DB::select($query);
		foreach($rmlstcmnt as $rmlst){			
			$rmlastcmnt = date('d/m/Y',strtotime($rmlst->rm_date)).' '.$rmlst->rm_time. '-'.$rmlst->rm_comment;	
		}
		return $rmlastcmnt;
    }
	
	public static function GetSFComment($inci_id){	
		$sfCmnt = SHcomment::select('sh_comment.sf_comment')						
									->where('incident_id','=',$inci_id)       
									->get()->toArray();
		
		return $sfCmnt[0]['sf_comment'];
    }
		
	public static function GetAutoCloseInciType($id){		
		$autoClose = '';
        $inciType = Incident_type::select('inci_type.auto_close')						
									->where('id','=',$id)       
									->get()->toArray();	
									
		if($inciType[0]['auto_close'] == 'Y'){
			$autoClose = 'Y';
		}else{
			$autoClose = 'N';
		}			
        return $autoClose;
    }
		
	public static function GetInciTypeName($id){
        $inciType = Incident_type::select('inci_type.incident_t')						
									->where('id','=',$id)       
									->get()->toArray();	
									
        return $inciType[0]['incident_t'];
    }
	
	/*public static function getsChampion($id){
        $sid = SChampInfo1::select('schamp_id')						
							->where('schamp_id','=',$id)       
							->get()->toArray();										
				
        return $sid;
    }*/
	
	public static function getEmpDtl($id){
        $empDtl = Employeepersonal::select('*')						
							->where('emp_no','=',$id)       
							->get()->toArray();										
				
        return $empDtl;
    }
	
	public static function getsChamp(){
		//DB::enableQueryLog();	
        $schamps	= DB::table('master_employee')
							->select('emp_no','name')
							->distinct()
							->orderBy('name')
							->get();
		//dd(DB::getQueryLog());						
        return $schamps;
    }
	
	public static function getLocation(){
		//DB::enableQueryLog();	
        $locations	= DB::table('master_employee')
							->select('loc_code','location')
							->distinct()
							->orderBy('location')
							->get();
		//dd(DB::getQueryLog());						
        return $locations;
    }
	
	public static function getBF(){	
        $sbus	= DB::table('master_employee')
							->select('b_func_id','b_func')
							->distinct()
							->orderBy('b_func')
							->get();	
        return $sbus;
    }
	
	/*public static function getSchamps($schampID){
		$rawWhere = '';
		if(isset($schampID)){
			$rawWhere .= "emp_no IN (".$schampID.")";
		}
		//DB::enableQueryLog();
        $schampQ	= DB::select(DB::raw("SELECT emp_no,name,email,tphn_no1 FROM master_employee WHERE	".$rawWhere." ORDER BY emp_no ASC"));
							//->get();								
		//dd(DB::getQueryLog());
		return $schampQ;	
	}*/
	
	public static function getSchamps($schampID){		
		//DB::enableQueryLog();
        $schampQ	= DB::table('master_employee')
							->select('emp_no,name,email,tphn_no1')							
							->get()->first();								
		//dd(DB::getQueryLog());
		return $schampQ;	
	}
	
	public static function getSchampDetails($locs,$bfunc){
		$where = '';		
		if(isset($locs)){
			if($locs != "'all'"){
				$where .= " WHERE loc_code IN (".$locs.")";
			}else{
				$where .= " WHERE 1";
			}
		}
		if(isset($bfunc)){
			if($bfunc != "'all'"){
				$where .= " AND b_func_id IN (".$bfunc.")";
			}else{
				$where .= " AND 1";
			}
		}
		//DB::enableQueryLog();
        $scDtlQ	= DB::select("SELECT emp_no,name,loc_code,b_func_id FROM master_employee ".$where." ORDER BY emp_no ASC");
							//->get();	
		//dd(DB::getQueryLog());					
        return $scDtlQ;
    }
	
	public static function getLocName($id){		
        $locQ = Employeepersonal::select('location')						
							->where('loc_code','=',$id)
							->get()->first();
						
        return $locQ;
    }
	
	public static function getBFName($id){		
        $sbuQ = Employeepersonal::select('b_func')						
							->where('b_func_id','=',$id) 
							->get()->first();
        return $sbuQ;
    }
	
	public static function getEmpName($id){		
        $empQ = Employeepersonal::select('emp_no','name')						
							->where('emp_no','=',$id) 
							->get()->first();
        return $empQ;
    }
	
	public static function getSchamp1($id){		
        $sc1Q = SChampInfo1::select('*')						
							->where('schamp_id1','=',$id) 
							->get()->first();
        return $sc1Q;
    }
	
	public static function getSchamp2($id){		
        $sc2Q = SChampInfo2::select('*')						
							->where('schamp_id2','=',$id) 
							->get()->first();
        return $sc2Q;
    }
	
	
	
}