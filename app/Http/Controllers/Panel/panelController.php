<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequest;
use App\Http\Requests\uploadInformationRequest;
use App\Models\Plan;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Uploads;
use Morilog\Jalali\Jalalian;
class panelController extends Controller {

    public function panel() {

        $now = Jalalian::forge('today')->format('%Y');
        $d=Plan::all();
        foreach ($d as $r){
            $r->update([
                'now'=>$now
            ]);
        }
        return view('admin/index');
    }
    public function uploadPhoto(FileRequest $request){
        $file = $request->file;
        $fileName = uniqid().rand(0,10000);
        $fileName = $fileName.'.'.$file->getClientOriginalExtension();

        $file->move(public_path('uploads/ActionFiles'),$fileName);
        return [
            'status'=>1,
            'path'=>'uploads/ActionFiles/'.$fileName
        ];

    }

    public function uploadInformation(uploadInformationRequest $request){
        $i=0;
        foreach ($request->des as $d){
            try{
                $upload = new Uploads();
                $upload->action_id = $request->id;
                $upload->type = 1;
                $upload->name = $d;
                $upload->path = $request->path[$i];
                $upload->save();
                $i++;
            }catch (\Exception $e){
                return back()->with('danger','خطا در ذخیره فایل , فایل بصورت کامل بارگزاری نشده است ');

            }
        }
        return back()->with('success','مستندات ارسال شد !');
    }

    public function showAvalbeRole(){
        $userdata = User::findOrFail(request()->userid);
        $userRolecount = UserRole::where('user_id',request()->userid)->count();
        $userRole = UserRole::where('user_id',request()->userid)->first();
        if ($userRolecount==0){
            $crole = "کاربر ";
        }else{
            $role =Role::where('id',$userRole['role_id'])->first();
            $crole = $role['name'];
        }
        return view('admin/userrole',compact('userdata','crole'));
    }
    public function userRoleUpdate(){
        $userRolecount = UserRole::where('user_id',request()->userid)->count();
        if (request()->newrole==0){
            if ($userRolecount!=0){
                UserRole::where('user_id',request()->userid)->delete();
            }
        }else{
            if ($userRolecount!=0){
                $data = UserRole::where('user_id',request()->userid)->first();
                $data->update([
                    'role_id'=>request()->newrole
                ]);
            }else{
                UserRole::create([
                    'user_id'=>request()->userid,
                    'role_id'=>request()->newrole
                    ]);
            }
        }
        return back()->with('success','تغییر دسترسی با موفق انجام شد !');
    }

    public function delete() {

        $up = Uploads::where('id',request('id'))->first();

        unlink(public_path($up['path']));
        Uploads::where('id',request('id'))->delete();
    }


    ////convert persian number to english number
    function convertPersianToEnglish($string) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    $output= str_replace($persian, $english, $string);
    return $output;
    }


    public function changePlan($id){
        $data = Plan::findOrfail($id);
        session(['plan'=>$id]);
        $str = "تغییر دوره به ".$data->name." موفقیت آمیز بود !";
        return redirect(route('panel'))->with('success',$str);
    }

}
