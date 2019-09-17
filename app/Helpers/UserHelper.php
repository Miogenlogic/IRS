<?php
namespace App\Helpers;
use App\Providers\HelperServiceProvider;

//use App\Models\User;
//use App\Models\UserDetails;
//use App\Models\MasterSpecilization;
use Carbon\Carbon;
use App\Models\Settings;
use DB;
use Hash;
use Auth;
use Mail;
use DataTables;
use Session;
use Redirect;
use Alert;
use Input;

class UserHelper extends HelperServiceProvider{

    static function getHeaderFooter()
    {
        $settings=Settings::select('value','option')->pluck('value','option');
        return $settings;
    }





}

