<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileEditRequest;
use App\Models\Country;
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

use App\Helpers\UserHelper;
use App\Models\User;
use App\Models\UserDetails;
use Eloquent;
use Illuminate\Http\Request;
use File;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DB;
class PatientController extends Controller
{

    public function ProfileEdit()
    {
        $user_session=Session::get('user');
        //dd($user_session);die;
        $profile=User::find($user_session['user_id']);

        $Patient=UserDetails::where('user_id','=',$profile->id)->get()->first();

        $country=Country::where('status','=','Active')->get();

        //$Patient=UserDetails::find($id);

        return view('frontend.patient.editPatient')
            ->with('profile',$profile)
            ->with('Patient',$Patient)
            ->with('country',$country);
    }

    public function ProfileSave(ProfileEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);

        $obj=UserDetails::find($request['id']);

        $obj->name=$request['name'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/patient/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/patient/image';
                File::delete($destinationPath . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            }

        }
        $obj->image = $image;
        $obj->phone=$request['phone'];
        $obj->email=$request['email'];
        $obj->age=$request['age'];
        $obj->gender=$request['gender'];

        $obj->country=$request['country'];
        //$obj->country=$request[$country->country];
        $obj->state=$request['state'];
        $obj->address=$request['address'];
        $obj->save();

        /*$obj2=Country::find($request['cid']);
        $obj2->name=$request['name'];
        $obj2->save();
        $obj2->save();*/

        return redirect('my-dashboard');
    }



}