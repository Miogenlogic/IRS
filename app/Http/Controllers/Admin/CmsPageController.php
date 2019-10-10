<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CmsMainEditRequest;
use App\Http\Requests\CmsPageRequest;
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
class CmsPageController extends Controller
{



    public function cmsHomeList()
    {
        return view('admin.cmsmain.listCms');
    }


    public function getTableCmsHome(Request $request)
    {

        $table = CmsMain::where('id','=','1')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-home-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function cmsHomeEdit($id)
    {
        $cmsmain=CmsMain::find($id);

        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editCms')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function cmsHomeEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-home-list');

    }

    //AboutUs

    public function cmsAboutList()
    {
        return view('admin.cmsmain.listCmsAbout');
    }


    public function getTableCmsAbout(Request $request)
    {

        $table = CmsMain::where('id','=','2')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-about-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function cmsAboutEdit($id)
    {
        $cmsmain=CmsMain::find($id);
       // dd($cmsmain);
        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editCmsAbout')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function cmsAboutEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-about-list');

    }


    //visionmission

    public function cmsVisionList()
    {
        return view('admin.cmsmain.listCmsVision');
    }


    public function getTableCmsVision(Request $request)
    {

        $table = CmsMain::where('id','=','3')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-vision-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function cmsVisionEdit($id)
    {
        $cmsmain=CmsMain::find($id);
        // dd($cmsmain);
        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editCmsVision')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function cmsVisionEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-vision-list');

    }


    //contact
    public function cmsContactList()
    {
        return view('admin.cmsmain.listCmsContact');
    }


    public function getTableCmsContact(Request $request)
    {

        $table = CmsMain::where('id','=','4')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-contact-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }



    public function cmsContactEdit($id)
    {
        $cmsmain=CmsMain::find($id);
        // dd($cmsmain);
        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editCmsContact')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function cmsContactEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-contact-list');

    }

    //service
    public function serviceList()
    {
        return view('admin.cmsmain.listService');
    }


    public function getTableService(Request $request)
    {

        $table = CmsMain::where('id','=','5')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-service-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function servicetEdit($id)
    {
        $cmsmain=CmsMain::find($id);

        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editService')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function serviceEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-service-list');

    }

    //service page
    public function servicePageList()
    {
        return view('admin.cmsmain.listServicePage');
    }


    public function getTableServicePage(Request $request)
    {

        $table = CmsMain::where('id','=','6')->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })

            ->addColumn('content', function ($table) {
                $content=strip_tags($table->content);
                return $content;
            })

            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/uploads/cmspage/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                return $img;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/cms-service-page-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';

                //$btns .=' <a href="' . url('admin/cms-page-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">Delete</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function servicetPageEdit($id)
    {
        $cmsmain=CmsMain::find($id);

        $cms = CmsPage::where('cms_id','=',$id)->get();
        //dd($cms);
        //dd($qualification);
        return view('admin.cmsmain.editServicePage')
            ->with('cms',$cms)
            ->with('cmsmain',$cmsmain);
    }

    public function servicePageEditStore(CmsMainEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);
        $obj1 = CmsMain::find($request['id']);
        //$obj1->page = $request['page'];
        $obj1->title = $request['title'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/cmspage/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj1->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/cmspage/image';
                File::delete($destinationPath . '/' . $obj1->image);
                $image='';
            }else{
                $image = $obj1->image;
            }

        }
        $obj1->image = $image;
        $obj1->seo_url = $request['seo_url'];
        $obj1->meta_key = $request['meta_key'];
        $obj1->meta_description = $request['meta_description'];
        $obj1->status = $request['status'];
        $obj1->save();


        $obj = CmsPage::where('cms_id','=',$request['id'])->get();
        foreach($obj as $valcmspage){
            $cmspage=CmsPage::find($valcmspage->id);
            $cmspage->content=$request['content'.$valcmspage->id];
            $cmspage->save();
        }

        return redirect('admin/cms-service-page-list');

    }


}

