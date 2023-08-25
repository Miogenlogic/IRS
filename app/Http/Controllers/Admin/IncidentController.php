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
use App\AdminKPI_last_month;
use App\AdminKPI_Backlog_Tabular;
use App\AdminKPI_Backlog_Tabular_LastMonth;
use App\AdminKPI_lastQuarter_Financial;
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
use App\Models\Reportingm;
use App\Models\Zonalad;
use App\Models\Date_range_picker;
use Session;
use Hash;
use File;
use Eloquent;
use Mail;
use Input;
use DB;
use DataTables;
use Carbon\Carbon ;

class IncidentController extends Controller
{
    public function superincilist()
    {
        $title = 'Incident List';
	    //DB::enableQueryLog();
        $tabledata=Incident::select('incident.*','incident.id as in_id','city.name as cityname','district.name as disname',
												'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype',
												'master_employee.name as employee_name')
				->join( 'users','users.email', '=', 'incident.emp_email')				
				->join( 'master_employee','master_employee.email', '=', 'users.email')				
				->join( 'roles','roles.id', '=', 'users.role_id'  )
				->join('city', 'city.id', '=', 'incident.city')
				->join('state', 'state.id', '=', 'incident.state')
				->join('district', 'district.id', '=', 'incident.district')
				->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->join('status_type', 'status_type.id', '=', 'incident.injured_status')
				//->where('incident.save_draft','=','1')
				//->where('users.parent_id', '=',   $user_id)
				->get();    
				//dd(DB::getQueryLog());
				//die;
				return view('superadmin.incidentlist')
				->with('tabledata',$tabledata)	   
				->with('title',$title);						
    }

    public function inciGetTable(Request $request)
    {
       $title = 'Employee List';
       $tabledata=Incident::select('incident.*','incident.id as in_id','city.name as cityname','district.name as disname',
												'state.name as staname','status_type.status_name','inci_type.incident_t as actiontype',
												'master_employee.name as employee_name')
				->join( 'users','users.email', '=', 'incident.emp_email')				
				->join( 'master_employee','master_employee.email', '=', 'users.email')				
				->join( 'roles','roles.id', '=', 'users.role_id'  )
				->join('city', 'city.id', '=', 'incident.city')
				->join('state', 'state.id', '=', 'incident.state')
				->join('district', 'district.id', '=', 'incident.district')
				->join('inci_type', 'inci_type.id', '=', 'incident.inc_type')
				->join('status_type', 'status_type.id', '=', 'incident.injured_status')
				//->where('incident.save_draft','=','1')
				//->where('users.parent_id', '=',   $user_id)
				->get();    
        $datatables = Datatables::of($tabledata)
            ->addIndexColumn()
            ->addColumn('action', function ($tabledata) {
                $btns = ' <a href="' . url('admin/asset-type-edit/' . $table->id) . '" class="btn btn-outline-primary btn-sm" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/asset-type-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger btn-sm">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['action']);

        return $datatables->make(true);
    }
    
}