<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Helpers\UserHelper;

use App\Models\Zones;
use App\Models\User;

use phpDocumentor\Reflection\Types\Null_;
use Session;
use File;
use Eloquent;
use Auth;
use Input;
use DB;
use DataTables;
use Hash;

use Storage;

use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ZoneController extends Controller
{

    //Employee
    public function zonelist()
    {
        $title = 'Zones List';
        $tabledata = Zones::select('*')->get();

        return view('/super.zonelist')
            ->with('title', $title)
            ->with('tabledata', $tabledata);
    }


    public function zoneGetTable(Request $request)
    {
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



}
