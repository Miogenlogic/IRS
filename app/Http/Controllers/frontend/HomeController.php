<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

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
use App\Models\UserDetails;
use Eloquent;
use Illuminate\Http\Request;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        $slider=Slider::where('status', '=', 'Active')->get();
        $homeSection1=Cms::where('page', '=', 'home-section1')->get()->first();
        $homeSection3=Cms::where('page', '=', 'home-section3')->get()->first();
        $homeSection4=Cms::where('page', '=', 'home-section4')->get()->first();
        $homeSection5=Cms::where('page', '=', 'home-section5')->get()->first();
        $homeSection6=Cms::where('page', '=', 'home-section6')->get()->first();
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        $homeSection9=Cms::where('page', '=', '24 Hour Emergency')->get()->first();
        $homeSection10=Cms::where('page', '=', 'Complete-Lab-Services')->get()->first();
        $homeSection11=Cms::where('page', '=', 'Medical-Professionals')->get()->first();
        $homeSection12=Cms::where('page', '=', 'Mission & Vision Statement')->get()->first();
        $homeSection13=Cms::where('page', '=', 'Our Mission')->get()->first();
        $homeSection14=Cms::where('page', '=', 'Vision Statement')->get()->first();
        $homeSection15=Cms::where('page', '=', 'Clinic Principles')->get()->first();
        $homeSection16=Cms::where('page', '=', 'Our Services')->get()->first();
        $addservice1=Cms::where('page', '=', 'home-section3')->get()->first();
        $addservice2=Cms::where('page', '=', 'home-addition-service-tab1')->get()->first();
        $addservice3=Cms::where('page', '=', 'home-addition-service-tab2')->get()->first();
        $addservice4=Cms::where('page', '=', 'home-addition-service-tab3')->get()->first();

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

        return view('frontend.page.home')
            ->with('slider',$slider)->with('service',$service)
            ->with('slider2',$slider2)
            ->with('homeSection1',$homeSection1)
            ->with('homeSection3',$homeSection3)
            ->with('homeSection4',$homeSection4)
            ->with('homeSection5',$homeSection5)
            ->with('homeSection6',$homeSection6)
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8)
            ->with('homeSection9',$homeSection9)
            ->with('homeSection10',$homeSection10)
            ->with('homeSection11',$homeSection11)
            ->with('homeSection12',$homeSection12)
            ->with('homeSection13',$homeSection13)
            ->with('homeSection14',$homeSection14)
            ->with('homeSection15',$homeSection15)
            ->with('homeSection16',$homeSection16)
            ->with('service',$service)
            ->with('addservice1',$addservice1)
            ->with('addservice2',$addservice2)
            ->with('addservice3',$addservice3)
            ->with('addservice4',$addservice4);
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

        $obj = new Askquestion();
        $obj->name = $request['name'];
        $obj->email = $request['email'];
        $obj->phone = $request['phone'];
        $obj->message = $request['message'];
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

        $obj = new Booking();
        $obj->name = $request['bookingname'];
        $obj->email = $request['bookingemail'];
        $obj->phone = $request['bookingphone'];
        $obj->age = $request['bookingage'];
        $obj->select_service = $request['bookingservice'];
        $obj->date = $request['bookingdate'];
        $obj->time = $request['bookingtime'];
        $obj->comment = $request['bookingmessage'];
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }


    public function askAdd(Request $request)
    {

        $obj = new ask();
        $obj->name = $request['name'];
        $obj->email = $request['email'];
        $obj->phone = $request['phone'];
        $obj->message = $request['message'];
        $obj->save();

        if (isset($obj->id)) {
            echo 'Success';
        }else {
            echo 'failure';
        }
        //return json_encode();

    }


    public function servicePage($seo_url)
    {
        $service2=Service::where('seo_url','=',$seo_url)->get()->first();
        $service1=Cms::where('page', '=', 'servicepage-submenu1')->get()->first();
        $service3=Cms::where('page', '=', 'servicePage-Working-Time')->get()->first();
        $service4=Cms::where('page', '=', 'servicePage-Contact-Info')->get()->first();

        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();

        return view('frontend.page.servicePage')
            ->with('service1',$service1)
            ->with('service2',$service2)
            ->with('service3',$service3)
            ->with('service4',$service4)
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);
    }

    public function services()
    {
        $service1=Service::where('status','=','Active')
            ->orderBy('id', 'asc')
            ->offset(0)
            ->limit(3)
            ->get();
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        $homeSection16=Cms::where('page', '=', 'Our Services')->get()->first();
        return view('frontend.page.services')
            ->with('service1',$service1)
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8)
            ->with('homeSection16',$homeSection16);
    }


    public function about()
    {
        $about1=Cms::where('page', '=', 'aboutus-About-Our-Clinic')->get()->first();
        $about2=Cms::where('page', '=', 'aboutus-Our-Advantages')->get()->first();
        $about3=Cms::where('page', '=', 'aboutus-Motivation-is-easy')->get()->first();

        $about4=Cms::where('page', '=', 'home-section4')->get()->first();
        $about5=Cms::where('page', '=', 'aboutus-Our-Office')->get()->first();
        $slider1=AboutSlider::where('status', '=', 'Active')->get();
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        $about6=Cms::where('page', '=', 'aboutus-Motivation-is-easy2')->get()->first();
        $about7=Cms::where('page', '=', 'aboutus-Motivation-is-easy3')->get()->first();
        $about8=Cms::where('page', '=', 'aboutus-Motivation-is-easy4')->get()->first();
        return view('frontend.page.about')
            ->with('about1',$about1)
            ->with('about2',$about2)
            ->with('about3',$about3)
            ->with('about4',$about4)
            ->with('about5',$about5)
            ->with('about6',$about6)
            ->with('about7',$about7)
            ->with('about8',$about8)
            ->with('slider1',$slider1)
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }
    public function mydashboard()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.mydashboard')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }
    public function appointments()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.patient.appointments')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

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



    public function visionmision()
    {
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        $visionmission=Cms::where('page', '=', 'visionmission')->get()->first();
        return view('frontend.page.visionmission')
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8)
            ->with('visionmission',$visionmission);
    }

    public function contact()
    {
        $contact1=Cms::where('page', '=', 'contact-iframe')->get()->first();
        $contact2=Cms::where('page', '=', 'contact-Clinic-Location')->get()->first();
        $contact3=Cms::where('page', '=', 'contact-info')->get()->first();
        $contact4=Cms::where('page', '=', 'contact-get-touch')->get()->first();
        $contact5=Cms::where('page', '=', 'contact-workingtime')->get()->first();
        $homeSection7=Cms::where('page', '=', 'home-section7')->get()->first();
        $homeSection8=Cms::where('page', '=', 'home-section8')->get()->first();
        return view('frontend.page.contact')
            ->with('contact1',$contact1)
            ->with('contact2',$contact2)
            ->with('contact3',$contact3)
            ->with('contact4',$contact4)
            ->with('contact5',$contact5)
            ->with('homeSection7',$homeSection7)
            ->with('homeSection8',$homeSection8);

    }


    public function contactAdd(Request $request)
    {

        $obj = new Contact();
        $obj->name = $request['name'];
        $obj->email = $request['email'];
        $obj->phone = $request['phone'];
        $obj->message = $request['message'];
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

            $data = ['name'=>$request['name'],'email'=>$request['subscribe_mail']];
            //email to subscriber
            Mail::send('frontend.mail.subscription', $data, function($message) use ($data) {
                $message->to($data['email'],'Subscriber')->subject('Subscription');
                $message->from('support@biopedclinic.com','Bioped Clinic');
            });
            echo 'Success';
            exit(0);
        }else{
            echo 'duplicate';
            exit(0);
        }

        echo 'failure';
        exit(0);
    }

}