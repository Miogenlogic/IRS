<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Requests\CmsRequest;
use App\Http\Requests\RequestFormRequestRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
//use App\Models\Cms;
use App\Models\RequestForm;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DataTables;
use Illuminate\Support\Facades\DB;
class RequestFormController extends Controller
{
    public function requestFormAdd()
    {

        return view('admin.requestForm.addRequestForm');
    }

    public function cmsAddStore(RequestFormRequestRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new RequestForm();
        $obj->name = $request['name'];
        $obj->title = $request['title'];
        $obj->content = $request['content'];
        $obj->content = $request['content'];
        $obj->content = $request['content'];


         $obj->save();
        return redirect('admin/request-form-list');

    }
}
