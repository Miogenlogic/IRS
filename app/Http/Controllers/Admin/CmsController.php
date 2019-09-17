<?php

namespace App\Http\Controllers\Admin;

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
class CmsController extends Controller
{

    public function cmsAdd()
    {

        return view('admin.cms.addCms');
    }

    public function cmsAddStore(Request $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new Cms();
        $obj->page = $request['page'];
        $obj->title = $request['title'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cms/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;

        } else {
            $image = '';
        }
        $obj->image = $image;
        $obj->content = $request['content'];
        $obj->save();

        return redirect('admin/cms-list');

    }
   

    public function cmsList()
    {
        return view('admin.cms.listCms');
    }

    public function getTableCms(Request $request)
    {

        $table = Cms::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
              //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    public function cmsEdit($id)
    {
        $cms=Cms::find($id);
        //dd($qualification);
        return view('admin.cms.editCms')
            ->with('cms',$cms);
    }

    public function cmsEditStore(CmsRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj = Cms::find($request['id']);
        //$obj->page = $request['page'];
        $obj->title = $request['title'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cms/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cms/image';
                File::delete($destinationPath . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            }

        }
        $obj->image = $image;


        $obj->content = $request['content'];
        $obj->save();
        //dd($obj);
       // return redirect('admin/master-list-qualification');
        return redirect('admin/cms-list');

    }



}

