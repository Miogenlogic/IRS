<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
//use App\Models\Slider;
//use App\Models\AboutSlider;
use App\Models\HomeSlider;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DataTables;
use File;
use Image;
use Illuminate\Support\Facades\DB;
class HomeSliderController extends Controller
{

    public function sliderAdd()
    {

        return view('admin.homeslider.addSlider');
    }

    public function sliderAddSave(SliderRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new HomeSlider();

        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/homeslider/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;

        } else {
            $image = '';
        }
        $obj->image = $image;
        $obj->content = $request['content'];
        $obj->status = $request['status'];
        $obj->save();
        return redirect('admin/home-slider-list');

    }


    public function sliderList()
    {
        return view('admin.homeslider.listSlider');
    }

    public function getTableSlider(Request $request)
    {


        $table = HomeSlider::select('*')->get();


        $datatables = Datatables::of($table)
            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/homeslider/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                // $btns .=' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $img;
            })
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/home-slider-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/home-slider-delete/' . $table->id) . '" class="btn btn-outline-success" >DELETE</a>';
                // $btns .= ' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['img', 'action']);

        return $datatables->make(true);
    }

    public function sliderEdit($id)
    {
        $homeslider=HomeSlider::find($id);
        //dd($location);
        return view('admin.homeslider.editSlider')
            ->with('homeslider',$homeslider);
    }

    public function sliderEditStore(Request $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);

        $obj=HomeSlider::find($request['id']);
        $obj->name=$request['name'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/homeslider/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/homeslider/image';
                File::delete($destinationPath . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            }

        }
        $obj->image = $image;

        $obj->content=$request['content'];
        $obj->status=$request['status'];
        $obj->save();

        return redirect('admin/home-slider-list');
    }





    public function sliderDelete($user_id)
    {
        $slider = HomeSlider::find($user_id);
        $destinationPath = 'public/assets/uploads/homeslider/image';
        File::delete($destinationPath . '/' . $slider->image);
        $slider->delete();
        //dd($location);
        return redirect('admin/slider-list1');


    }



}
