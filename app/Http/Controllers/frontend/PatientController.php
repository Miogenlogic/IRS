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
use DataTables;
class PatientController extends Controller
{

    public function ProfileEdit()
    {
        $user_session=Session::get('user');
        //dd($user_session);die;
        $profile=User::find($user_session['user_id']);

        $Patient=UserDetails::where('user_id','=',$profile->id)->get()->first();



        return view('frontend.patient.editPatient')
            ->with('profile',$profile)
            ->with('Patient',$Patient);
    }

    public function ProfileSave(ProfileEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);

        $country=explode('-',$request['usercountry']);
        $obj1=User::find($request['id']);
        $obj1->username = $request['username'];
        //dd($request);
        $obj1->email = $request['email'];
        $obj1->status = $request['status'];
        if($request['password']!=NULL){
            $obj1->password=Hash::make($request['password']);
        };
        $obj1->save();
        $id=$obj1->id;


        $obj=UserDetails::where('user_id','=',$request['id'])->get()->first();
        $obj->user_id=$id;
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
        $obj->country_id=$country[1];
        $obj->phone=$request['phone'];
        $obj->email=$request['email'];

        $obj->age=$request['age'];

        $obj->gender=$request['gender'];
        $obj->address=$request['address'];
        $obj->save();


        return redirect('/my-dashboard');
    }



    public function appointmentList()
    {
        return view('frontend.patient.appointments');
    }

    public function getTableAppointment(Request $request)
    {

        $user_session=Session::get('user');
        $table=Booking::where('email','=',$user_session['email'])->get();



        $datatables =  Datatables::of($table)
            ->addColumn('doctor_name', function ($table) {
                $user="";
                if($table->doctor>0){
                    $user=UserHelper::userById($table->doctor);
                    return $user->name;
                }
                return $user;
            })

            ->addColumn('service', function ($table) {
                $service="";
                if($table->select_service>0){
                    $service=UserHelper::serviceById($table->select_service);
                    return $service->title;
                }
                return $service;
            })


            ->addColumn('type', function ($table) {
                $appotype="";
                if($table->service_type>0){
                    $appotype=UserHelper::appointmentType($table->service_type);
                    return $appotype->type;
                }
                return $appotype;
            })


             /*$table = UserDetails::select('*')->get();s


        $datatables =  Datatables::of($table)*/

            ->addColumn('action', function ($table) {
                //$btns = ' <a href="' . url('admin/reply-inquiry/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
               // return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }






}