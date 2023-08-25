<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\BackDate;
use App\Models\ReptDays;
use App\Models\Employeepersonal;
use App\Models\Zones;
use App\Models\Incident_type;
use App\Models\Status_type;
use App\Models\SChampInfo1;
use App\Models\SChampInfo2;
use App\Models\SChampDstore;

use App\Helpers\UserHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

use App\Http\Requests\BackDateEditRequest;
use App\Http\Requests\ReptDaysEditRequest;

use Session;
use File;
use Eloquent;
use Auth;
use Input;
use DB;
use DataTables;
use Hash;
use Rap2hpoutre\FastExcel\FastExcel;


class MasterController extends Controller{
    
    public function backDateEdit(){
        $title = 'Edit Budget Overflow';

        $urgentBadge=BackDate::find(1);

        return view('super.edit-backDate')
            ->with('title', $title)
            ->with('urgentBadge', $urgentBadge);
    }

    public function backDateEditSave(BackDateEditRequest $request){
        $title = 'Edit Allowable Back Date Save';        
        $backDate              = BackDate::find(1);
        $backDate->days        = $request['days'];
        $backDate->updated_on  = date("Y-m-d");;
      
        $backDate->save();
        $request->session()->flash('success', 'Back Date Allowable updated successfully!');
        return redirect('admin/edit-backDate');
    }
	
	public function reptDaysEdit(){
        $title = 'Escalation Timeline';
		
        $repDays=ReptDays::find(1);

        return view('super.edit-repDays')
            ->with('title', $title)
            ->with('repDays', $repDays);
    }

    public function reptDaysEditSave(ReptDaysEditRequest $request){
        $title = 'Edit Escalation Timeline';   
		
        $escDays              = ReptDays::find(1);
		//dd($escDays);
		//die;
        $escDays->emp_days    = $request['emp_days'];
        $escDays->rm_days     = $request['rm_days'];
        $escDays->sh_days     = $request['sh_days'];
		$escDays->md_desk_email = $request['md_desk_email'];
		//$escDays->safety_id   = $request['safety_id'];
		$escDays->def_schamp_id  = $request['def_schamp_id'];
		$escDays->admin_cc_email = $request['admin_cc_email'];
        $escDays->updated_on  = date("Y-m-d");;
      
        $escDays->save();
        $request->session()->flash('success', 'Escalation Timeline updated successfully!');
        return redirect('admin/edit-repDays');
    }
	
    //Employee
    public function employeelist(){
        $title = 'Employee List';
        $tabledata = Employeepersonal::select('*')
                                        //->SortBy('name')                               
                                        ->get();
        //dd($tabledata);
        return view('/super.list-employee')
            ->with('title', $title)
            ->with('tabledata', $tabledata);
    }
	
    public function employeeGetTable(Request $request){
        $title = 'Employee List';
        $table = Employeepersonal::select('*')->get();
        $datatables = Datatables::of($table)
            ->addIndexColumn()
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/asset-type-edit/' . $table->id) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/asset-type-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger btn-sm">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);

        return $datatables->make(true);
    }
	
	//Safety Champion List
    public function saftyChamplist(){
        $title = 'Location/Broad Function Safety Champion List';       
        return view('/super.list-schamp')
            ->with('title', $title);           
    }
	
	public function empSaftyChamplist(){
        $title = 'Employee Wise Safety Champion List';       
        return view('/super.emp-list-schamp')
            ->with('title', $title);           
    }
	
	//Safety Champion Data Table
	public function saftyChampGetTable(Request $request){
		$schamp1 = '';
		$schamp2 = '';
        $title = 'Location/Broad Function Safety Champion List';
        $locationId = $request->route('location_id');
		//DB::enableQueryLog();
        $table = DB::table('safety_champ_dstore')
						->select('safety_champ_dstore.*')
						->where('schamp_loc_code','=',$locationId)	
						->get();
		
		$datatables = Datatables::of($table)			
			->addIndexColumn()
			->addColumn('schamp_name1', function ($table) {
				$schamp1 = UserHelper::getSchamp1($table->schamp_id1);
                return $schamp1->schamp_name1. ' ('. $table->schamp_id1 .')';
            })
			
			->addColumn('schamp_email1', function ($table) {
				$schamp1 = UserHelper::getSchamp1($table->schamp_id1);	
                return $schamp1->schamp_email1;
            })
			
			->addColumn('schamp_mobile1', function ($table) {	
				$schamp1 = UserHelper::getSchamp1($table->schamp_id1);
                return $schamp1->schamp_mobile1;
            })
			
            ->addColumn('location1', function ($table) {				
                $locR1 = UserHelper::getLocName($table->schamp_loc_code);						
                return $locR1->location;
            })
			
			->addColumn('bfunc1', function ($table) {				
                $bfR1 = UserHelper::getBFName($table->schamp_b_func_id);						
                return $bfR1->b_func;
            })
			
			->addColumn('schamp_name2', function ($table) {
				$schamp2 = UserHelper::getSchamp2($table->schamp_id2);
                return $schamp2->schamp_name2. ' ('. $table->schamp_id2 .')';
            })
			
			->addColumn('schamp_email2', function ($table) {
				$schamp2 = UserHelper::getSchamp2($table->schamp_id2);
                return $schamp2->schamp_email2;
            })
			
			->addColumn('schamp_mobile2', function ($table) {
				$schamp2 = UserHelper::getSchamp2($table->schamp_id2);
                return $schamp2->schamp_mobile2;
            })
			
			->addColumn('location2', function ($table) {
                $locR2 = UserHelper::getLocName($table->schamp_loc_code);						
                return $locR2->location;
            })
			
			->addColumn('bfunc2', function ($table) {
                $bfR2 = UserHelper::getBFName($table->schamp_b_func_id);						
                return $bfR2->b_func;
            })
			
			->addColumn('emp_name', function ($table) {
                $empR = UserHelper::getEmpName($table->emp_code);						
                return $empR->name;
            })
			
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/schamp-edit/' . $table->emp_code) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/schamp-delete/' . $table->emp_code) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger btn-sm">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);

        return $datatables->make(true);
    }
	
	public function sChampAdd(){
        $title = 'Add Safety Champion';        
									
		return view('super.add-schamp')
            ->with('title', $title);
    }
	
	public function empSChampAdd(){
        $title = 'Add Employee Wise Safety Champion';        
									
		return view('super.emp-add-schamp')
            ->with('title', $title);
    }
	
	public function ChampEdit($id){
		//echo $id;
        $title = 'Edit Employee Safety Champion Details'; 
		$empR = SChampDstore::select('*')
									->where('emp_code','=',$id)
									->get()->first();
									
		$sc1 = SChampInfo1::select('*')						
							->where('schamp_id1','=',$empR->schamp_id1 )
							->get()->first();
							
		$sc2 = SChampInfo2::select('*')						
							->where('schamp_id2','=',$empR->schamp_id2 )
							->get()->first();
							
		return view('super.edit-schamp')
				->with('empR', $empR)
				->with('sc1', $sc1)
				->with('sc2', $sc2)
				->with('title', $title);
    }
		
	public function sChampSave(Request $request){
		$data = array();
        $title = 'Save Safety Champion'; 
		
		if(isset($request->schamp_id1)){
			//DB::table('safety_champ_info1')->where('schamp_id1', $request->schamp_id1)->delete();
			$sChampion1 = UserHelper::getEmpDtl($request->schamp_id1);			
			$data1 = ['schamp_id1' => $sChampion1[0]['emp_no'], 'schamp_name1' => $sChampion1[0]['name'], 
					 'schamp_email1' => $sChampion1[0]['email'], 'schamp_mobile1' => $sChampion1[0]['tphn_no1'],
					 'created_at' => date('Y-m-d')
					];						
			DB::table('safety_champ_info1')->insert($data1);
		}
		
		if(isset($request->schamp_id2)){
			//DB::table('safety_champ_info2')->where('schamp_id2', $request->schamp_id2)->delete();
			$sChampion2 = UserHelper::getEmpDtl($request->schamp_id2);
			$data2 = ['schamp_id2' => $sChampion2[0]['emp_no'], 'schamp_name2' => $sChampion2[0]['name'], 
					 'schamp_email2' => $sChampion2[0]['email'], 'schamp_mobile2' => $sChampion2[0]['tphn_no1'],
					 'created_at' => date('Y-m-d')
					];							
			DB::table('safety_champ_info2')->insert($data2);
		}
			
		
		if((isset($request->schamp_loc_code))){
			foreach ($request->schamp_loc_code as $sloc) {
				$slocation.= "'".$sloc."',";
			}
			$slocation = rtrim($slocation, ',');
		}
		
		
		if(isset($request->schamp_b_func_id)){
			foreach ($request->schamp_b_func_id as $bfunc) {
				$bfuncs.= "'".$bfunc."',";
			}
			$bfuncs = rtrim($bfuncs, ',');
		}
		
		$getDtls = UserHelper::getSchampDetails($slocation,$bfuncs);
		//dd($getDtls);
		//die;
		if(isset($getDtls)){
			$sDtls   = '';
			$schamp1 = '';
			$schamp2 = '';
			$data1 = array();
			
			foreach($getDtls as $key=>$value){	
			  if(isset($request->schamp_id1)){
				  $schamp1 = $request->schamp_id1;
			  }
			  
			  if(isset($request->schamp_id2)){
				  $schamp2 = $request->schamp_id2;
			  }			  
			  DB::table('safety_champ_dstore')->where('emp_code', $value->emp_no)->delete();
			  $data1 = ['schamp_id1' => $schamp1, 'schamp_id2' => $schamp2, 'schamp_loc_code' => $value->loc_code, 
					  'schamp_b_func_id' => $value->b_func_id, 'emp_code' => $value->emp_no,
					  'created_at' => date('Y-m-d')
				];
			
			  DB::table('safety_champ_dstore')->insert($data1);	
			}
		}
		
		return redirect("/admin/saftchamp-list");
    }
	
	public function empsChampSave(Request $request){
		$data = array();
        $title = 'Save Safety Champion'; 
				
		if(isset($request->schamp_id1)){			
			$checkSC1 = SChampInfo1::select('id')->where('schamp_id1','=',$request->schamp_id1)->get()->first();
			if(!isset($checkSC1)){
				$sChampion1 = UserHelper::getEmpDtl($request->schamp_id1);			
				$data1 = ['schamp_id1' => $sChampion1[0]['emp_no'], 'schamp_name1' => $sChampion1[0]['name'], 
						 'schamp_email1' => $sChampion1[0]['email'], 'schamp_mobile1' => $sChampion1[0]['tphn_no1'],
						 'created_at' => date('Y-m-d')
						];						
				DB::table('safety_champ_info1')->insert($data1);
			}
		}
		
		if(isset($request->schamp_id2)){
			$checkSC2 = SChampInfo2::select('id')->where('schamp_id2','=',$request->schamp_id2)->get()->first();
			if(!isset($checkSC2)){
				$sChampion2 = UserHelper::getEmpDtl($request->schamp_id2);
				$data2 = ['schamp_id2' => $sChampion2[0]['emp_no'], 'schamp_name2' => $sChampion2[0]['name'], 
						 'schamp_email2' => $sChampion2[0]['email'], 'schamp_mobile2' => $sChampion2[0]['tphn_no1'],
						 'created_at' => date('Y-m-d')
						];							
				DB::table('safety_champ_info2')->insert($data2);
			}
		}
		
			$empDtl = UserHelper::getEmpDtl($request->emp_code);
			$data1 = ['schamp_id1' => $request->schamp_id1, 'schamp_id2' => $request->schamp_id2, 'schamp_loc_code' => $empDtl[0]['loc_code'], 
					  'schamp_b_func_id' => $empDtl[0]['b_func_id'], 'emp_code' => $request->emp_code,
					  'created_at' => date('Y-m-d')
					 ];
			DB::table('safety_champ_dstore')->where('emp_code', $request->emp_code)->delete();			
			DB::table('safety_champ_dstore')->insert($data1);			
						
		return redirect("/admin/emp-saftchamp-list");
    }

    //Zones
    public function zoneslist(){
        $title = 'Zones List';
        $tabledata = Zones::select('*')->get();
                                        //->SortBy('name') 
        return view('/super.list-zones')
            ->with('title', $title)
            ->with('tabledata', $tabledata);
    }

    public function zonesGetTable(Request $request){
        $title = 'Zones List';
        $table = Zones::select('*')->get();
        $datatables = Datatables::of($table)
            ->addIndexColumn()
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/asset-type-edit/' . $table->id) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/asset-type-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger btn-sm">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);

        return $datatables->make(true);
    }

    public function UploadZone(Request $request){
        $title = 'Upload Zone Template';

        return view('super.zone-upload')
            ->with('title', $title);
    }

    public function SaveZone(Request $request){
        $title = 'Save Zone'; 
        if($request->hasFile('zone_file')){            
            DB::table('zones')->delete();
            $path = $request->file('zone_file')->getRealPath();
            //die;
            $collection = (new FastExcel)->import($path);
            $zones = (new FastExcel)->import($path, function ($line) {                
                return Zones::create([
                    'Plnt' => $line['Plnt'],
                    'Name1' => $line['Name1'],
                    'Street' => $line['Street'],
                    'Street2' => $line['Street2'],
                    'Street3' => $line['Street3'],
                    'Street4' => $line['Street4'],
                    'City' => $line['City'],
                    'District' => $line['District'],
                    'PostalCode' => $line['PostalCode'],
                    'Description' => $line['Description'],
                    'CCd' => $line['CCd']
                ]);
            });
        }
        return redirect("/admin/zones-list");
    }
    //Incident Types
    public function inciTypelist(){
        $title = 'Incident Type List';
        $tabledata = Incident_type::select('*')
									->get();
        //dd($tabledata);
        return view('/super.list-incitype')
            ->with('title', $title)
            ->with('tabledata', $tabledata);
    }
	
	public function incitypeGetTable(Request $request){
        $title = 'Incident Type List';
        $table = Incident_type::select('*')->get();
        $datatables = Datatables::of($table)
            ->addIndexColumn()
			
			->addColumn('status', function ($table){
				if($table->active_status == 'Y'){
					return 'Active';
					
				}else{
					return 'Inactive';
				}
			})
			
            ->addColumn('action', function ($table){
                $btns = ' <a href="' . url('admin/edit-incitype/' . $table->id) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns.= ' <a href="' . url('admin/delete-incitype/' . $table->id . '/' .$table->active_status) . '" onclick="return confirm(\'Are you sure want to change status?\')" class="btn btn-outline-danger btn-sm">CHANGE STATUS</a>';
                return $btns;
            })
			
			->addColumn('auto_close', function ($table) {
                if($table->auto_close == 'N'){
                    return 'No';
                }else{
                    return 'Yes';
                }
            })
            ->rawColumns(['status','auto_close','action']);
			
        return $datatables->make(true);		
    }
	
	public function inciTypeAdd(){
        $title = 'Add Incident Type';        
									
		return view('super.add-incitype')
            ->with('title', $title);
    }
	
	public function inciTypeEdit($id){
        $title = 'Edit Incident Type';        
		$incitype = Incident_type::find($id);
		return view('super.add-incitype')
            ->with('incitype', $incitype->incident_t)
            ->with('incitypeID', $incitype->id)
			->with('autoClose', $incitype->auto_close)
			//->with('active_status', $incitype->active_status)
            ->with('title', $title);
    }
	
	public function inciTypeSave(Request $request){
        $title = 'Incident Type Save'; 		
		if($request->inci_type_id != ''){
			$incitype              = Incident_type::find($request->inci_type_id);
			$incitype->incident_t  = $request->incident_t;
			$incitype->auto_close  = $request->status;	
			$incitype->updated_at  = date("Y-m-d");
			
			$incitype->save(); 
			$request->session()->flash('success', 'Incident Type updated successfully!');	
		}else{
			DB::table('inci_type')->insert(
				 array(					
						'incident_t'   =>   $request['incident_t']
					  )
			); 
			$request->session()->flash('success', 'New Incident Type added successfully!');
		}		
        return redirect('admin/inci-list');
    }
	
	public function inciTypeDelete($id,$stat){
		//echo $stat;
		//die;
		if($stat == 'N'){
			$status = 'Y';
		}else{
			$status = 'N';
		}
		//DB::table('inci_type')->where('id', $id)->delete();  
		DB::table('inci_type')
            ->where('id',$id)
            ->update(['active_status' => $status]);
		return redirect("/admin/inci-list");
	}
	
	//Incident Status
    public function inciStatlist(){
        $title = 'Incident Status Type List';
        $tabledata = Status_type::select('*')
									->get();
        //dd($tabledata);
        return view('/super.list-incistat')
            ->with('title', $title)
            ->with('tabledata', $tabledata);
    }
	
	public function incistatGetTable(Request $request){
        $title = 'Incident Status List';
        $table = Status_type::select('*')->get();
        $datatables = Datatables::of($table)
            ->addIndexColumn()
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/edit-incistatus/' . $table->id) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/delete-incistatus/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger btn-sm">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);
			
        return $datatables->make(true);		
    }
	
	public function inciStatAdd(){
        $title = 'Add Incident Status Type';        
									
		return view('super.add-incistat')
            ->with('title', $title);
    }
	
	public function inciStatEdit($id){
        $title = 'Edit Incident Status Type'; 		
		$incistatus = Status_type::find($id);		
		return view('super.add-incistat')
            ->with('incistatus', $incistatus->status_name)
            ->with('incistatID', $incistatus->id)
            ->with('title', $title);
    }
	
	public function inciStatSave(Request $request){
        $title = 'Incident Status Type Save'; 
		if($request->statid != ''){
			$incistat              = Status_type::find($request->statid);
			$incistat->status_name = $request->status_name;			
			$incistat->updated_at  = date("Y-m-d");
			
			$incistat->save(); 
			$request->session()->flash('success', 'Incident Status Type updated successfully!');	
		}else{
			DB::table('status_type')->insert(
				 array(					
						'status_name'   =>   $request['status_name']
					  )
			);
			$request->session()->flash('success', 'New Incident Status Type added successfully!');
		}	 
        return redirect('admin/incistat-list');
    }
	
	public function inciStatDelete($id){
		DB::table('status_type')->where('id', $id)->delete();  
		return redirect("/admin/incistat-list");
	}         
}
