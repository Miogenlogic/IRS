<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Helpers\UserHelper;
use App\Branch;
use App\AdminKPI_last_month;
use App\AdminKPI_Backlog_Tabular;
use App\AdminKPI_Backlog_Tabular_LastMonth;
use App\AdminKPI_lastQuarter_Financial;

use App\User;
use App\Activities;
use Session;
use File;
use Eloquent;
use Auth;
use Input;
use DB;
use DataTables;


class DashboardController extends Controller
{
    public function adminDashboard()
    {
        //echo 'hi';exit;
        return view('admin.dashboard.adminDashboard');
    }




}
