<?php

namespace App\Http\Controllers\Admin;

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

    public function serviceEditStore(ServiceRequest $request)
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


}
