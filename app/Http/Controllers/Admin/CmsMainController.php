<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CmsMainEditRequest;
use App\Http\Requests\CmsMainRequest;
use App\Models\CmsMain;
use App\Models\CmsPage;
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
class CmsMainController extends Controller
{

    public function cmsMainAdd()
    {

        return view('admin.cmsmain.addCmsMain');
    }

    public function cmsMainAddStore(CmsMainRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new CmsMain();
        $obj->page = $request['page'];
        $obj->title = $request['title'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        $obj->meta_description = $request['meta_description'];
        /*if ($request->file('image')) {
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
        $obj->image = $image;*/
        $obj->status = $request['status'];
        $obj->save();

        return redirect('admin/cms-main-list');

    }
   

    public function cmsMainList()
    {
        return view('admin.cmsmain.listCmsMain');
    }

    public function getTableCmsMain(Request $request)
    {

        $table = CmsMain::select('*')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-main-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/cms-page-list/'.$table['id']) . '" class="btn btn-outline-success" ><span class="label edit-text"><i class="fa fa-pencil" aria-hidden="true"></i>Manage Content</span></a>';

                $btns .=' <a href="' . url('admin/cms-main-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger"><span class="label edit-text"><i class="fa fa-trash" aria-hidden="true"></i>DELETE</span></a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }
    public function cmsMainEdit($id)
    {
        $cms=CmsMain::find($id);
        //dd($qualification);
        return view('admin.cmsmain.editCmsMain')
            ->with('cms',$cms);
    }

    public function cmsMainEditStore(CmsMainEditRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj = CmsMain::find($request['id']);
        //$obj->page = $request['page'];
        $obj->title = $request['title'];
        $obj->seo_url = $request['seo_url'];
        $obj->meta_key = $request['meta_key'];
        $obj->meta_description = $request['meta_description'];
        /*if ($request->file('image')) {
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
        $obj->image = $image;*/


        $obj->status = $request['status'];
        $obj->save();
        //dd($obj);
       // return redirect('admin/master-list-qualification');
        return redirect('admin/cms-main-list');

    }
    public function cmsMainDelete($cms_id)
    {
        $cmspage= CmsPage::where('cms_id','=',$cms_id)->get();
        foreach($cmspage as $valCon){
            $valCon->delete();
        }

        $cms=CmsMain::find($cms_id);
        if(isset($cms->id)) {
            $topic_del=$cms->delete();
        }

        return redirect('admin/cms-main-list');

    }




}

