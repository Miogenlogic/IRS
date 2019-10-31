<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\CmsMain;
use App\Models\CmsPage;
use App\Models\Email;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Cms;
use App\Models\AboutSlider;
use App\Models\HomeSlider;
use App\Models\RequestForm;
use App\Models\Booking;
use App\Models\User;
use App\Models\ask;
use App\Models\Askquestion;
use App\Models\Contact;

use App\Helpers\UserHelper;
use App\Models\UserDetails;
use Eloquent;
use Illuminate\Http\Request;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DB;
use Carbon\Carbon;
use App\Models\DoctorDetails;

class HomeController extends Controller
{
    public function index()
    {
        $slider=Slider::where('status', '=', 'Active')->get();

        $home=CmsMain::where('page', '=', 'home')->get()->first();
        //dd($home);
        $home_contents=CmsPage::where('cms_id','=',$home->id)->get();
       //dd($home_contents);


        $service=Service::where('status','=','Active')
            ->orderBy('id', 'asc')
            ->offset(0)
            ->limit(3)
            ->get();

        $slider2=HomeSlider::where('status','=','Active')
            ->orderBy('id', 'asc')
            ->offset(0)
            ->limit(6)
            ->get();
        $metakey=$home->meta_key;
        $metades=$home->meta_description;
        $title=$home->title;
        return view('frontend.page.home')
            ->with('slider',$slider)
            ->with('slider2',$slider2)
            ->with('home',$home)
            ->with('home_contents',$home_contents)
            ->with('service',$service)
            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);
    }

    public function about()
    {
        $about=CmsMain::where('page', '=', 'about')->get()->first();
        //dd($home);
        $about_contents=CmsPage::where('cms_id','=',$about->id)->get();
        $slider1=AboutSlider::where('status', '=', 'Active')->get();

        /* $about1=Cms::where('page', '=', 'aboutus-About-Our-Clinic')->get()->first();
         $about2=Cms::where('page', '=', 'aboutus-Our-Advantages')->get()->first();
         $about3=Cms::where('page', '=', 'aboutus-Motivation-is-easy')->get()->first();

         $about4=Cms::where('page', '=', 'home-section4')->get()->first();
         $about5=Cms::where('page', '=', 'aboutus-Our-Office')->get()->first();

         $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
         $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
         $about6=Cms::where('page', '=', 'aboutus-Motivation-is-easy2')->get()->first();
         $about7=Cms::where('page', '=', 'aboutus-Motivation-is-easy3')->get()->first();
         $about8=Cms::where('page', '=', 'aboutus-Motivation-is-easy4')->get()->first();*/
        $metakey=$about->meta_key;
        $metades=$about->meta_description;
        $title=$about->title;
        return view('frontend.page.about')
            ->with('about',$about)
            ->with('about_contents',$about_contents)
            ->with('slider1',$slider1)

            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);

    }

    public function visionmision()
    {
        $vision=CmsMain::where('page', '=', 'vision-mision ')->get()->first();
        //dd($home);
        $vision_contents=CmsPage::where('cms_id','=',$vision->id)->get();


        $metakey=$vision->meta_key;
        $metades=$vision->meta_description;
        $title=$vision->title;
        return view('frontend.page.visionmission')
            ->with('vision',$vision)
            ->with('vision_contents',$vision_contents)
            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);
    }


    public function contact()
    {
        $contact=CmsMain::where('page', '=', 'contact')->get()->first();
        //dd($home);
        $contact_contents=CmsPage::where('cms_id','=',$contact->id)->get();

        $metakey=$contact->meta_key;
        $metades=$contact->meta_description;
        $title=$contact->title;
        return view('frontend.page.contact')
            ->with('contact',$contact)
            ->with('contact_contents',$contact_contents)
            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);

    }


    public function services()
    {
        $service=CmsMain::where('page', '=', 'service')->get()->first();
        //dd($home);
        $service_contents=CmsPage::where('cms_id','=',$service->id)->get();

        //$homeSection16=Cms::where('page', '=', 'Our Services')->get()->first();
        $service1=Service::where('status','=','Active')
            ->orderBy('id', 'asc')
            ->offset(0)
            ->limit(3)
            ->get();


        $metakey=$service->meta_key;
        $metades=$service->meta_description;
        $title=$service->title;
        return view('frontend.page.services')
            ->with('service',$service)
            ->with('service_contents',$service_contents)
            ->with('service1',$service1)

            //->with('homeSection16',$homeSection16)
            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);
    }

    public function servicePage($seo_url)
    {
        $servicepage=CmsMain::where('page', '=', 'servicepage')->get()->first();
        $servicepage_contents=CmsPage::where('cms_id','=',$servicepage->id)->get();
        $service2=Service::where('seo_url','=',$seo_url)->get()->first();




        $metakey=$servicepage->meta_key;
        $metades=$servicepage->meta_description;
        $title=$service2->title;
        return view('frontend.page.servicePage')
            ->with('servicepage',$servicepage)
            ->with('servicepage_contents',$servicepage_contents)
            ->with('service2',$service2)
            ->with('metakey',$metakey)
            ->with('metades',$metades)
            ->with('title',$title);
    }


    public function requestFormAdd(Request $request)
    {

        $obj = new RequestForm();
        $obj->name = $request['requestname'];
        $obj->email = $request['requestemail'];
        $obj->phone = $request['requestphone'];
        $obj->select_service = $request['requestservice'];
        $obj->date = $request['requestdate'];
        $obj->time = $request['requesttime'];
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
           echo 'failure';
        }
        //return json_encode();

    }


    public function askQuestionAdd(Request $request)
    {
        $country=explode('-',$request['questioncountry']);
        $obj = new Askquestion();
        $obj->name = $request['name'];
        $obj->email = $request['email'];

        $obj->message = $request['message'];
        if(isset($country[1])){
            $obj->country_id=$country[1];
            $obj->phone = $request['phone'];
        }else{
            $obj->country_id=NULL;
            $obj->phone = NULL;
        }
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }


    public function bookingFormAdd(Request $request)
    {



        $country=explode('-',$request['bookingcountry']);

            $obj = new Booking();
            $obj->name = $request['bookingname'];
            $obj->email = $request['bookingemail'];
            $obj->phone = $request['bookingphone'];
            $obj->age = $request['bookingage'];
            $obj->select_service = $request['bookingservice'];
            $obj->doctor = $request['doctor'];
            $obj->service_type = $request['service_type'];
            $obj->date = $request['bookingdate'];
            $obj->time = $request['bookingtime'];
            $obj->comment = $request['bookingmessage'];
            $obj->country_id = $country[1];
            $obj->save();



        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }

   public function bookingFormOtp(Request $request){
       $otp = mt_rand(100000, 999999);
       $obj1 = new Appointment();
       $obj1->otp = $otp;
       $obj1->email = $request['bookingemail'];
       $obj1->save();

       $to_email = $obj1->email;
       $subject = 'Verify email for OTP';
       $message = $contents = view('frontend.mail.bookingOtp', ['otp' => $otp])->render();
       $headers = 'MIME-Version: 1.0' . "\r\n";
       $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
       $headers .= 'From:' . \Config::get('env.service_mail') . "\r\n";
       if(mail($to_email, $subject, $message, $headers)){
           echo "Success";
       }else{
           echo 'Failure';
       }




   }



    public function askAdd(Request $request)
    {
        $country=explode('-',$request['expertcountry']);
        $obj = new Askquestion();
        $obj->name = $request['name'];
        $obj->email = $request['email'];

        $obj->message = $request['message'];
        $obj->service_id = $request['service_id'];
        if(isset($country[1])){
            $obj->country_id=$country[1];
            $obj->phone = $request['phone'];
        }else{
            $obj->country_id=NULL;
            $obj->phone = NULL;
        }
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }

    public function mydashboard()
    {
        $user_session=Session::get('user');
        //dd($user_session);die;
        $profile=User::find($user_session['user_id']);

        $Patient=UserDetails::where('user_id','=',$profile->id)->get()->first();

        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.mydashboard')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8)
            ->with('profile',$profile)
            ->with('Patient',$Patient);

    }
    public function appointments()
    {
        $user_session=Session::get('user');
        //dd($user_session);die;
        $profile=User::find($user_session['user_id']);

        $Patient=UserDetails::where('user_id','=',$profile->id)->get()->first();
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.appointments')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8)
            ->with('profile',$profile)
            ->with('Patient',$Patient);

    }
    public function mypaymenthistory()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.mypaymenthistory')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }
    public function myprescription()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.myprescription')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }
    public function rescheduleappointments()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.rescheduleappointments')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }

    public function contactAdd(Request $request)
    {
        $country=explode('-',$request['contactcountry']);
        $obj = new Contact();
        $obj->name = $request['name'];
        $obj->email = $request['email'];

        $obj->message = $request['message'];
        if(isset($country[1])){
            $obj->country_id=$country[1];
            $obj->phone = $request['phone'];
        }else{
            $obj->country_id=NULL;
            $obj->phone = NULL;
        }
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }

    public function emilAdd(Request $request)
    {
        $obj = Email::where('email','=',$request['subscribe_mail'])->get()->first();
        if(!isset($obj->email)){
            $obj = new Email();
            $obj->name = $request['name'];
            $obj->email = $request['subscribe_mail'];
            $obj->save();



            $to_email = $obj->email;
            $subject = 'Subscription';
            $message = $contents = view('frontend.mail.subscription', ['name'=>$request['name'],'email'=>$request['subscribe_mail']])->render();

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:' . \Config::get('env.service_mail') . "\r\n";
            mail($to_email, $subject, $message, $headers);


            //email to subscriber
            /*
             *  $data = ['name'=>$request['name'],'email'=>$request['subscribe_mail']];
             * Mail::send('frontend.mail.subscription', $data, function($message) use ($data) {
                $message->to($data['email'],'Subscriber')->subject('Subscription');
                $message->from('support@biopedclinic.com','Bioped Clinic');
            });*/
            echo 'Success';
            exit(0);
        }else{
            echo 'duplicate';
            exit(0);
        }

        echo 'failure';
        exit(0);
    }





    /* service associated doctors */
    public function serviceAssociatedDoctors(Request $request)
    {
        $users = UserHelper::doctorservice();
        $str='<option selected="selected" disabled="disabled">Select Doctor</option>';
        if(!isset($users->user_id)) {
            foreach ($users as $key => $value) {
                $str .='<option value='.$value['user_id'].'>'.$value['name'].'</option>';
            }
        }
        echo $str;
    }

    //type of service(virtual or physical)
    public function typeService(Request $request)
    {
        $appointType=AppointmentType::get();
        $str='<option selected="selected" disabled="disabled">Select Consultation Type</option>';
        if(!isset($appointType->id)) {
            foreach ($appointType as $key => $value) {
                $str .='<option value='.$value['id'].'>'.$value['type'].'</option>';
            }
        }
        echo $str;
    }


}