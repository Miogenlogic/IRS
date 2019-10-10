<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use App\Http\Requests\CmsRequest;
use App\Http\Controllers\Controller;
use App\Helpers\UserHelper;
use App\Models\User;
use App\Models\Role;

use Eloquent;
use Mail;
use Session;
use Redirect;
use Alert;
use Auth;
use Input;
use File;
use DataTables;
use Illuminate\Support\Facades\DB;
use Hash;
class UserController extends Controller
{

    public function userAdd()
    {
        $title='Add User';
        $role=Role::where('name','!=','admin')->get();
        return view('admin.USER.addUser')
            ->with('role',$role);
    }

    public function userAddStore(UserRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);
        $user_type=explode('-',$request['user_type']);
        $obj =new User();
        $obj->username = $request['username'];
        $obj->email = $request['email'];
        $obj->password=Hash::make($request['password']);
        $obj->user_type = $user_type[1];
        $obj->status = $request['status'];
        $obj->save();
        $id=$obj->id;

        $obj2=new UserDetails();
        $obj2->user_id=$id;
        $obj2->name=$request['name'];
        $obj2->email=$request['email'];
        $obj2->address=$request['address'];
        $obj2->phone=$request['phone'];
        $obj2->age=$request['age'];
        $obj2->gender=$request['gender'];

        $obj2->save();
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/user/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;

        } else {
            $image = '';
        }
        $obj2->image = $image;

        $obj2->save();
        DB::table('role_user')->insert(
            ['role_id' =>$user_type[0], 'user_id' => $obj->id]
        );
        return redirect('admin/user-list');

    }
   

    public function userList()
    {
        return view('admin.user.listUser');
    }

    public function getTableUser(Request $request)
    {

        $table =User::select('users.*' ,'user_details.*','users.id AS user_id')
            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.id')
            ->where('users.user_type','!=','admin')
            ->get();


        $datatables =  Datatables::of($table)
            /*->addColumn('usertype', function ($table) {
                if(){

                }
                return $btns;
            })*/

            ->addColumn('action', function ($table) {
                $btns = ' <a href="' . url('admin/user-edit/' . $table->id) . '" class="btn btn-outline-success" >EDIT</a>';
              //  $btns .=' <a href="' . url('admin/cms-delete/' . $table->id) . '" onclick="return confirm(\'Are you sure?\')" class="btn btn-outline-danger">DELETE</a>';
                return $btns;
            })

            ->rawColumns(['action']);


        return $datatables->make(true);
    }

    public function userEdit($id)
    {
        $title='Edit User';
        $role=Role::where('name','!=','admin')->get();
        //$role=Role::select('name','id','display_name')->get();
        //dd($role);
        $user=User::find($id);
        $user_detail=UserDetails::where('user_id','=',$id)->get()->first();
        //$service=UserDetails::where('user_id','=',$id)->get()->first();
        //dd($user_detail);
        return view('admin.user.editUser')
            ->with('user',$user)
            ->with('role',$role)
            ->with('user_detail',$user_detail);
    }

    public function userEditStore(UserRequest $request)
    {
        //  $myrequest=$request->all();
        //dd($myrequest);
        $user_type=explode('-',$request['user_type']);
        $obj=User::find($request['id']);
        $obj->username = $request['username'];
        $obj->email = $request['email'];
        if($request['password']!=NULL){
            $obj->password=Hash::make($request['password']);
        };
        if(isset($request['user_type'])){
            $obj->user_type=$user_type[1];
        }
        $obj->status = $request['status'];
        $obj->save();
        $id=$obj->id;


        $obj2=UserDetails::where('user_id','=',$request['id'])->get()->first();
        $obj2->user_id=$id;
        $obj2->name=$request['name'];
        $obj2->email=$request['email'];
        $obj2->address=$request['address'];
        $obj2->phone=$request['phone'];
        $obj2->age=$request['age'];
        $obj2->gender=$request['gender'];
        if ($request->file('image')) {
            $imgfile = $request->file('image');
            $tmp = explode('.', $imgfile->getClientOriginalName());
            $ext = end($tmp);
            $save_imgfile = time() . '.' . $ext;
            $destinationPath = 'public/assets/uploads/user/image';
            $imgfile->move($destinationPath, $save_imgfile);
            $image = $save_imgfile;
            File::delete($destinationPath . '/' . $obj->image);
        } else {
            if(isset($request['img_rem'])){
                $destinationPath = 'public/assets/uploads/user/image';
                File::delete($destinationPath . '/' . $obj->image);
                $image='';
            }else{
                $image = $obj->image;
            }

        }

        $obj2->image=$image;
        $obj2->save();

        DB::table('role_user')->where('user_id','=',$obj->id)->delete();
        DB::table('role_user')->insert(
            ['role_id' =>$user_type[0], 'user_id' => $obj->id]
        );
        //dd($obj);
       // return redirect('admin/master-list-qualification');
        return redirect('admin/user-list');

    }



}

