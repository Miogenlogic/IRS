<?php

namespace App\Http\Controllers\Admin;

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
                $btns = ' <a href="' . url('admin/reply-inquiry/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
              //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function replyInquiry($id)
    {

        //$service = Service::where('service_id','=',$inuiry->select_service)->get();

        $service = Booking::select('booking.*','service.title')
            ->leftjoin('service','service.id','=','booking.select_service')
            ->where('booking.id','=',$id)
            ->get()->first();



        return view('admin.inquiry.replyInquiry')
            ->with('service',$service);

    }

    public function emilConfirm(Request $request)
    {
        $obj = Booking::where('email','=',$request['subscribe_mail'])->get()->first();
        if(!isset($obj->email)){
            $obj = new Booking();
            $obj->name = $request['name'];
            $obj->email = $request['subscribe_mail'];
            $obj->phone = $request['phone'];
            $obj->age = $request['age'];
            $obj->select_service = $request['select_service'];
            $obj->doctor = $request['doctor'];
            $obj->select_type = $request['select_type'];
            $obj->date = $request['date'];
            $obj->time = $request['time'];
            $obj->comment = $request['comment'];
            $obj->save();

            $data = ['name'=>$request['name'],'email'=>$request['subscribe_mail']];
            //email to customer
            Mail::send('admin.mail.confirmedmail', $data, function($message) use ($data) {
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

