<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileEditRequest;
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

    public function ProfileEdit($id)
    {
        //$id=Session::get('user_id');
        //$profile=User::find($id);
        //$Patient=UserDetails::where('user_id','=',$id);

        $Patient=UserDetails::find($id);

        return view('frontend.patient.editPatient')
            //->with('profile',$profile)
            ->with('Patient',$Patient);
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
        $obj->city=$request['city'];
        $obj->address=$request['address'];
        $obj->save();

        return redirect('my-dashboard');
    }


}