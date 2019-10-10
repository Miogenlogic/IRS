<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\City;
use App\Models\Email;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Cms;
use App\Models\AboutSlider;
use App\Models\HomeSlider;
use App\Models\RequestForm;
use App\Models\Booking;
use App\Models\ask;
use App\Models\Askquestion;
use App\Models\Contact;
use App\Models\Country;
use App\Models\State;

use App\Helpers\UserHelper;
use App\Models\User;
use App\Models\UserDetails;
use Eloquent;
use Illuminate\Http\Request;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DB;
class AjaxController extends Controller
{




    /*public function stateByCountryId(Request $request)
    {
        $str='';
        $state = State::where('country_id', '=', $request['country_id'])->get();
        foreach($state as $val){
            $str .='<option value="'.$val->id.'">'.$val->name.'</option>';
        }

        echo $str;
    }

    public function cityByStateId(Request $request)
    {
        $str='';
        $city = City::where('state_id', '=', $request['state_id'])->get();
        foreach($city as $val){
            $str .='<option value="'.$val->id.'">'.$val->name.'</option>';
        }

        echo $str;
    }*/


}