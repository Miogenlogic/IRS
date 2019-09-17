<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//use App\Http\Requests\CmsRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
//use App\Models\Cms;
use App\Models\Settings;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Input;
use DataTables;
use File;
use Illuminate\Support\Facades\DB;
class SettingsController extends Controller
{


    public function settingsEdit()
    {
        $id=Session::get('user_id');
        $settings=Settings::select('value','option')->pluck('value','option');
        return view('admin.settings.editSettings')
            ->with('settings',$settings);
    }

    public function settingsSave(Request $request)
    {
        //dd($request['setting']);

        foreach($request['setting'] as $key => $val){

            $obj=Settings::where('option','=',$key)->get()->first();
            if($key=='logo'){
                if ($request->file('setting')) {
                    $imgfile  = $request->file('setting');
                    $tmp = explode('.', $imgfile[$key]->getClientOriginalName());
                    $ext = end($tmp);
                    $save_imgfile = time() . '.' . $ext;
                    $destinationPath = 'public/assets/uploads/logo/';
                    $imgfile[$key]->move($destinationPath, $save_imgfile);
                    $val = $save_imgfile;
                    File::delete($destinationPath . '/' . $obj->value);
                } else {
                    $val = '';
                }
            }


            $obj->value=$val;
            $obj->save();
        }
        return redirect('admin/settings');

    }



}

