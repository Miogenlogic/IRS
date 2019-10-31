<?php

namespace App\Http\Controllers\Admin;

use App\Models\Askquestion;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CmsRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
use App\Models\Cms;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use File;
use DataTables;
use Illuminate\Support\Facades\DB;
class InquiryController extends Controller
{

    public function inquiryList(Request $request)
    {
        return view('admin.inquiry.listInquiry')
            ->with('param',$request['param']);
    }

    public function getTableInquiry(Request $request)
    {
        $param=$request['param'];
        if($param=='Physical Consultation'){
            $table = Booking::select('booking.*','service.title')
                ->leftjoin('service','service.id','=','booking.select_service')
                ->where('service_type','=',2)
                ->get();
        }
        elseif($param=='Virtual Consultation') {
            $table = Booking::select('booking.*', 'service.title')
                ->leftjoin('service', 'service.id', '=', 'booking.select_service')
                ->where('service_type', '=', 1)
                ->get();
        }
        elseif($param=='Pending Appointment') {
            $table = Booking::select('booking.*', 'service.title')
                ->leftjoin('service', 'service.id', '=', 'booking.select_service')
                ->where('booking.status','!=','Confirmed')
                ->get();
        }
        elseif($param=='Pending Physical Appointment') {
            $table = Booking::select('booking.*', 'service.title')
                ->leftjoin('service', 'service.id', '=', 'booking.select_service')
                ->where('service_type', '=', 2)
                ->where('booking.status','!=','Confirmed')
                ->get();
        }
        elseif($param=='Pending Virtual Appointment') {
            $table = Booking::select('booking.*', 'service.title')
                ->leftjoin('service', 'service.id', '=', 'booking.select_service')
                ->where('service_type', '=', 1)
                ->where('booking.status','!=','Confirmed')
                ->get();
        }

        else{
            $table = Booking::select('booking.*','service.title')
                ->leftjoin('service','service.id','=','booking.select_service')
                ->get();
        }







        $datatables =  Datatables::of($table)
            ->addColumn('doctor_name', function ($table) {
                $user="";
                if($table->doctor>0){
                    $user=UserHelper::userById($table->doctor);
                    return $user->name;
                }
                return $user;
            })

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/reply-inquiry/' . $table->id) . '" class="btn btn-outline-success" >REPLY</a>';
              //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function replyInquiry($id)
    {

        //$service = Service::where('service_id','=',$inuiry->select_service)->get();
       $book=Booking::find($id);
        $service = Booking::select('booking.*','service.title')
            ->leftjoin('service','service.id','=','booking.select_service')
            ->where('booking.id','=',$id)
            ->get()->first();



        return view('admin.inquiry.replyInquiry')
          ->with('book',$book)
            ->with('service',$service);

    }

    public function emilConfirm(Request $request)
    {

        $obj = Booking::where('email','=',$request['email'])->get()->first();
        if(!isset($obj->email)) {
            $obj = Booking::find($request['id']);
            $obj->status = $request['status'];
            $obj->confirmed_date = $request['confirmed_date'];
            $obj->confirmed_time = $request['confirmed_time'];
            $obj->content = $request['content'];

            $obj->save();

            $servicetype = \App\Helpers\UserHelper::servicetype($obj->select_service);

            $doctor = \App\Helpers\UserHelper::userById($obj->doctor);

            $type = \App\Helpers\UserHelper::appointmentType($obj->service_type);

            $to_email = $obj->email;
            $subject = 'Booking Confirmation Mail';
            $message = view('admin.mail.confirmmail', ['name' => $obj->name, 'email' => $obj->email, 'country_id' => $obj->country_id, 'phone' => $obj->phone, 'age' => $obj->age, 'select_service' => $servicetype->title, 'doctor' => $doctor->name, 'select_type' => $type->type, 'date' => $obj->date, 'time' => $obj->time, 'status' => $obj->status, 'confirmed_date' => $obj->confirmed_date, 'confirmed_time' => $obj->confirmed_time, 'comment' => $obj->comment, 'content' => $obj->content])->render();

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:' . \Config::get('env.service_mail')."\r\n";
            mail($to_email, $subject, $message, $headers);


            return redirect('admin/inquiry-list');

        }

    }


    public function questionList()
    {
        return view('admin.inquiry.listQuestion');
    }

    public function getTableQuestion(Request $request)
    {

        $table = Askquestion::select('*')->get();


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/reply-question/' . $table->id) . '" class="btn btn-outline-success" >REPLY</a>';
                //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function replyQuestion($id)
    {

        $service=Askquestion::find($id);

        return view('admin.inquiry.replyQuestion')
           // ->with('book',$book)
            ->with('service',$service);

    }

    public function emilQuestion(Request $request)
    {

        $obj = Askquestion::where('email','=',$request['email'])->get()->first();
        if(!isset($obj->email)) {
            $obj = Askquestion::find($request['id']);

            $obj->content = $request['content'];

            $obj->save();


            $to_email = $obj->email;
            $subject = 'Query Resolve Mail';
            $message = view('admin.mail.questionmail', ['name' => $obj->name, 'email' => $obj->email, 'country_id' => $obj->country_id, 'phone' => $obj->phone, 'message' => $obj->message, 'content' => $obj->content])->render();

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:' . \Config::get('env.service_mail')."\r\n";
            mail($to_email, $subject, $message, $headers);



            return redirect('admin/question-list');

        }

    }


    public function bookingList()
    {
        return view('admin.inquiry.listBooking');
    }

    public function getTableBooking(Request $request)
    {

        $users = Booking::select([
            DB::raw("CONCAT(booking.id,'-',booking.id) as id"),
            'booking.name',
            'booking.email',
            //DB::raw('count(booking.id) AS count'),
            'booking.created_at',
            'booking.updated_at'
        ])
            ->groupBy('booking.id');




        $table = Booking::select('booking.*','service.title')
            ->leftjoin('service','service.id','=','booking.select_service')
            ->get();


        $datatables =  Datatables::of($table)
            ->addColumn('doctor_name', function ($table) {
                $user="";
                if($table->doctor>0){
                    $user=UserHelper::userById($table->doctor);
                    return $user->name;
                }
                return $user;
            })
            ->addColumn('type', function ($table) {  //type is name in listblade
                $appotype="";
                if($table->service_type>0){          //service_type is name in database
                    $appotype=UserHelper::appointmentType($table->service_type);
                    return $appotype->type;
                }
                return $appotype;

            })

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/reply-inquiry/' . $table->id) . '" class="btn btn-outline-success" >REPLY</a>';
                //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;

            })


            ->rawColumns(['action']);

       if ($name = $datatables->request->get('name')) {
            $users->where('booking.name', 'like', "$name%");
        }

        $datatables =  app('datatables')->of($users)
            ->filterColumn('booking.id', 'whereRaw', "CONCAT(booking.id,'-',booking.id) like ? ", ["$1"]);

        return $datatables->make(true);
    }

//Contact related mail
    public function contactList()
    {
        return view('admin.inquiry.listContact');
    }

    public function getTableContact(Request $request)
    {

        $table = Contact::select('*')->get();


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/reply-contact/' . $table->id) . '" class="btn btn-outline-success" >REPLY</a>';
                //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function replyContact($id)
    {

        $service=Contact::find($id);

        return view('admin.inquiry.replyContact')
            // ->with('book',$book)
            ->with('service',$service);

    }

    public function emilContact(Request $request)
    {

        $obj = Contact::where('email','=',$request['email'])->get()->first();
        if(!isset($obj->email)) {
            $obj = Contact::find($request['id']);

            $obj->content = $request['content'];

            $obj->save();


            $to_email = $obj->email;
            $subject = 'Contact Query Resolve Mail';
            $message = view('admin.mail.contactmail', ['name' => $obj->name, 'email' => $obj->email, 'country_id' => $obj->country_id, 'phone' => $obj->phone, 'message' => $obj->message, 'content' => $obj->content])->render();


            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From:' . \Config::get('env.service_mail')."\r\n";
            mail($to_email, $subject, $message, $headers);

            return redirect('admin/contact-list');

        }

    }


}

