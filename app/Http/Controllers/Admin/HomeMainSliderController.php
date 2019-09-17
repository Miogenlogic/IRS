<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Http\Requests\MainSliderEditRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
//use App\Models\Slider;
//use App\Models\AboutSlider;
//use App\Models\HomeSlider;
use App\Models\Slider;

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
class HomeMainSliderController extends Controller
{

    public function mainSliderAdd()
    {

        return view('admin.homemainslider.addSlider');
    }

    public function mainSliderAddSave(SliderRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new Slider();
        $obj->name = $request['name'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/slider/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;

        } else {
            $image = '';
        }
        $obj->image = $image;
        $obj->content = $request['content'];
        $obj->status = $request['status'];
        $obj->save();
        return redirect('admin/main-slider-list');

    }


    public function mainSliderList()
    {
        return view('admin.homemainslider.listSlider');
    }

    public function getTableMainSlider(Request $request)
    {


        $table = Slider::select('*')->get();


        $datatables = Datatables::of($table)
            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/slider/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                // $btns .=' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $img;
            })
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/main-slider-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
                $btns .= ' <a href="' . url('admin/main-slider-delete/' . $table->id) . '" class="btn btn-outline-success" >DELETE</a>';
                // $btns .= ' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['img', 'action']);

        return $datatables->make(true);
    }

    public function mainSliderEdit($id)
    {
        $homeslider=Slider::find($id);
        //dd($location);
        return view('admin.homemainslider.editSlider')
            ->with('homeslider',$homeslider);
    }

    public function mainSliderEditStore(MainSliderEditRequest $request)
    {
        //$myrequest=$request->all();
        //dd($myrequest);

        $obj=Slider::find($request['id']);
        $obj->name=$request['name'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/slider/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/slider/image';
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

        return redirect('admin/main-slider-list');
    }





    public function mainSliderDelete($user_id)
    {
        $slider = Slider::find($user_id);
        $destinationPath = 'public/assets/uploads/slider/image';
        File::delete($destinationPath . '/' . $slider->image);
        $slider->delete();
        //dd($location);
        return redirect('admin/main-slider-list');


    }



}
