<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Http\Requests\EditActionRequest;
use App\Models\Actions;
use App\Models\Category;
use App\Models\Goals;
use App\Models\Plan;
use App\Models\Programs;
use App\Models\Role;
use App\Models\UserCategory;
use App\Models\UserRole;
use App\Uploads;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data1 = User::all();
        $data = [];
        foreach ($data1 as $d){
            if (UserCategory::where('userid',$d['id'])->count()==0){
                $final  = [
                    'name'=>$d['name'],
                    'id'=>$d['id'],
                    'email'=>$d['email'],
                    'category'=>'این کاربر طبقه ندارد '
                ];
            }else{
            $cat = UserCategory::where('userid',$d['id'])->first();
            $categoryname = Category::where('id',$cat['categoryId'])->first();
            $final  = [
                'name'=>$d['name'],
                'id'=>$d['id'],
                'email'=>$d['email'],
                'category'=>$categoryname['name']
            ];
            }
            array_push($data,$final);
        }

        return view('admin/user/userlist', compact('data','data1'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('admin/user/add_user', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\newUser $request)
    {

        $c = User::where('email', $request['email'])->count();
        if ($c != 0) {
            return back()->with('danger', 'حساب کاربری با این ایمیل وجود دارد !');
        }
        $name = $request['firstname'] . " " . $request['lastname'];
        $password = Hash::make($request['password']);
        $email = $request['email'];
        $user = User::create([
            'name'     => $name,
            'password' => $password,
            'email'    => $email
        ]);
        $userid = $user->id;

        foreach ( $request['category']as $category) {
            UserCategory::create([
                'categoryId'=>$category,
                'userId'=>$userid
            ]);
        }

        return back()->with('success', 'کاربر با موفقیت افزوده شد !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userdata = User::findOrFail($id);
        $userRolecount = UserRole::where('user_id',$id)->count();
        $userRole = UserRole::where('user_id',$id)->first();
        if ($userRolecount==0){
            $crole = "کاربر ";
        }else{
            $role =Role::where('id',$userRole['role_id'])->first();
            $crole = $role['name'];
        }
        return view('admin/user/userrole',compact('userdata','crole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        $data1 = Category::all();
        $cat = UserCategory::where('userid',$id)->first();
        $categoryname = Category::where('id',$cat['categoryId'])->first();
        $catid = $cat->categoryId;
        return view('admin/user/editUser',compact('data','categoryname','catid','data1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\editUser $request)
    {
        $data = User::where('id',$request['userid'])->first();
        if (!isset($request['password'])){
            $password = $data->password;
        }else{
            $password = Hash::make($request['password']);
        }
        $data->update([
            'name'=>$request['name'],
            'password'=>$password,
        ]);
        $cat = UserCategory::where('userId',$request['userid'])->first();
        $cat->update([
            'categoryId'=>$request['category']
        ]);
        return redirect(route('user.index'))->with('success', 'کاربر با موفقیت ویرایش شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }
    public function delete(){
        User::findOrFail(request('id'))->delete();
        $userRolecount = UserRole::where('user_id',request('id'))->count();
        if ($userRolecount!=0){
            UserRole::where('user_id',request('id'))->delete();
        }
        UserCategory::where('userId',request('id'))->delete();
    }
}
