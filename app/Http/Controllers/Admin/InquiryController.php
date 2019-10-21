<?php

namespace App\Http\Controllers\Admin;

use App\Models\Askquestion;
use App\Models\Booking;
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

    public function inquiryList()
    {
        return view('admin.inquiry.listInquiry');
    }

    public function getTableInquiry(Request $request)
    {

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
            $headers = 'From:' . \Config::get('env.service_mail');
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
            $headers = 'From:' . \Config::get('env.service_mail');
            mail($to_email, $subject, $message, $headers);


            return redirect('admin/question-list');

        }

    }



}

