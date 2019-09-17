<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
//use App\Models\Slider;
use App\Models\AboutSlider;

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
class AboutSliderController extends Controller
{

    public function sliderAdd()
    {

        return view('admin.aboutslider.addSlider');
    }

    public function sliderAddSave(SliderRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);

        $obj =new AboutSlider();
        $obj->name = $request['name'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;



            $destinationPath = public_path('/assets/uploads/aboutslider/thumbs');
            $thumb_img = Image::make($imgfile->getRealPath())->resize(136, 95);
            $thumb_img->save($destinationPath.'/'.$save_imgfile,80);

            $destinationPath = 'public/assets/uploads/aboutslider/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;

        } else {
            $image = '';
        }

        $obj->image = $image;
        $obj->content = $request['content'];
        $obj->status = $request['status'];
        $obj->save();
        return redirect('admin/slider-list');

    }


    public function sliderList()
    {
        return view('admin.aboutslider.listSlider');
    }

    public function getTableSlider(Request $request)
    {


        $table = AboutSlider::select('*')->get();


        $datatables = Datatables::of($table)
            ->addColumn('img', function ($table) {
                $img = ' <img src="' . asset('public/assets/uploads/aboutslider/image') . '/' . $table->image . '" style="width: 120px;height:100px">';
                // $btns .=' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $img;
            })
            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/slider-delete/' . $table->id) . '" class="btn btn-outline-success" >DELETE</a>';
                // $btns .= ' <a href="' . url('admin/slider-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })
            ->rawColumns(['img', 'action']);

        return $datatables->make(true);
    }

    public function sliderDelete($user_id)
    {
        $slider = AboutSlider::find($user_id);
        $destinationPath = 'public/assets/uploads/aboutslider/image';
        File::delete($destinationPath . '/' . $slider->image);
        File::delete('public/assets/uploads/aboutslider/thumbs' . '/' . $slider->image);
        $slider->delete();
        return redirect('admin/slider-list');


    }



}
