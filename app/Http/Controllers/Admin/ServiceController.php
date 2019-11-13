<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceEditRequest;
use App\Http\Requests\ServiceModalEditRequest;
use App\Http\Requests\ServiceModalRequest;
use App\Models\ServiceModal;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
use App\Models\Service;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DataTables;
use File;
use Illuminate\Support\Facades\DB;
class ServiceController extends Controller
{

    public function serviceAdd()
    {

        return view('admin.service.addService');
    }

    public function serviceAddSave(ServiceRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new Service();
        $obj->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/service/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            //File::delete($destinationPath . '/' . $obj->image);
        } else {
            $image = '';
        }
        $obj->image = $image;
        $obj->status = $request['status'];
        $obj->featured = $request['featured'];
        $obj->short_content = $request['short_content'];
        $obj->content = $request['content'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        $obj->save();
        return redirect('admin/service-list');

    }
   

    public function serviceList()
    {
        return view('admin.service.listService');
    }

    public function getTableService(Request $request)
    {

        $table = Service::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/
            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/service/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/service-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                $btns .=' <a href="' . url('admin/service-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['img','action']);


        return $datatables->make(true);
    }

    public function serviceEdit($id)
    {
        $blog=Service::find($id);

        return view('admin.service.editService')
            ->with('blog',$blog);
    }

    public function serviceEditStore(ServiceEditRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj = Service::find($request['id']);

        $obj->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/service/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/service/image';
                File::delete($destinationPath . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            }

        }
        $obj->image = $image;

        $obj->status = $request['status'];
        $obj->featured = $request['featured'];
        $obj->short_content = $request['short_content'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        $obj->content = $request['content'];

        $obj->save();

        return redirect('admin/service-list');

    }

    public function serviceDelete($user_id)
    {
        $blog = Service::find($user_id);
        $destinationPath = 'public/assets/uploads/service/image';
        File::delete($destinationPath . '/' . $blog->image);
        $blog->delete();
        //dd($location);
        return redirect('admin/service-list');
    }

    //modal
    public function serviceModalAdd()
    {

        return view('admin.modal.addModal');
    }


    public function serviceModalAddStore(ServiceModalRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new ServiceModal();
        $obj->service_id = $request['service_id'];
        $obj->model_name = $request['model_name'];
        $obj->model_title = $request['model_title'];
        $obj->content = $request['content'];
        $obj->save();
        return redirect('admin/service-modal-list');

    }

    public function serviceModalEdit($id)
    {
        $servicemodal=ServiceModal::find($id);

        return view('admin.modal.editModal')
            ->with('servicemodal',$servicemodal);
    }

    public function serviceModalEditStore(ServiceModalEditRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj = ServiceModal::find($request['id']);
        $obj->service_id = $request['service_id'];
        $obj->model_name = $request['model_name'];
        $obj->model_title = $request['model_title'];
        $obj->content = $request['content'];

        $obj->save();

        return redirect('admin/service-modal-list');

    }

    public function serviceModalList()
    {
        return view('admin.modal.listModal');
    }

    public function getTableServiceModal(Request $request)
    {

        //$table = ServiceModal::select('*')->get();


        $table = ServiceModal::select('service_model.*','service.title')
            ->leftjoin('service','service.id','=','service_model.service_id')
            ->get();


        $datatables =  Datatables::of($table)


            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/service-modal-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                $btns .=' <a href="' . url('admin/service-modal-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
 public function serviceModalDelete($user_id)
 {
     $modal = ServiceModal::find($user_id);
     $modal->delete();
     //dd($location);
     return redirect('admin/service-modal-list');
 }

}
