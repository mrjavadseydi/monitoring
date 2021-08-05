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
use App\Models\UserCategory;
use App\Uploads;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller {

    public function __construct() {
        $this->pro = '';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index() {
        if (!empty(session('plan'))){
            $plan_id=session('plan');
        }else{
            $plan_id = 1;
        }
        $action = new Actions();
        $action = $this->only($action);
        $data = $action->where('plan_id', $plan_id)->get();
        $programs = [];
        $pro = $this->pro;
        foreach ($data as $d) {
            $n = Programs::findOrFail($d['program_id']);
            $programid = $n['category'] . '-' . $n['strategy'] . '-' . $n['row'];
            array_push($programs, $programid);
        }
        $p = Plan::where('id', $plan_id)->first();
        $plan = [
            $p->now,
            $p->first + 0,
            $p->first + 1,
            $p->first + 2,
            $p->first + 3,
            $p->first + 4,
        ];
        return view('admin/action/index', compact('data', 'programs', 'pro', 'plan'));
    }

    public function only($action) {
        if (session('level') > 1) {
            $id = auth()->id();
            $uc = UserCategory::where('UserId', $id)->get();

            foreach ($uc as $uac)
                $action = $action->orWhere('categories_id', $uac->categoryId);
        }
        $input = request('only');
        if (Programs::find($input)) {
            $this->pro = Programs::where('id', $input)->first();
            $action = $action->where('program_id', $input);
        }
        return $action;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!isset(request()->program)) {
            $category = Programs::all();
        }
        else {
            $category = Programs::where('id', request()->program)->first();
        }
        return view('admin/action/create', compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionRequest $request) {
        if (!empty(session('plan'))){
            $plan_id=session('plan');
        }else{
            $plan_id = 1;
        }
        if ($request->repeat == 0) {
            $repeat = 0;
            $repeat_count = 0;
            $repeat_done = 0;
        }
        else {
            $repeat = 1;
            $repeat_count = $request->repeat_count + 0;
            $repeat_done = 0;
        }
        $ca = Programs::where('id', $request->program)->first();
        $category_id = Category::where('code', $ca->category)->first();
        $act = new Actions();
        $act->program_id = $request->program;
        $act->categories_id = $category_id->id;
        $act->name = $request->title;
        $act->description = $request->description . '';
        $act->delivery = '';
        $act->dead_line = $request->date;
        $act->done = 0;
        $act->repeat = $repeat;
        $act->strategies_id = $ca['strategies_id'];
        $act->repeat_count = $repeat_count;
        $act->plan_id = $plan_id;
        $act->repeat_done = $repeat_done;
        $act->obst = '';
        $act->save();
        return back()->with('success', 'افزودن اقدام با موفقیت انجام شد !');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $category = Programs::all();
        $data = Actions::where('id', $id)->first();
        $files = Uploads::where('action_id', $id)->get();
        return view('admin/action/edit', compact('category', 'data', 'files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditActionRequest $request, $id) {
        if (request()->done == 1) {
            $delivery = $request->delivery;
        }
        else {
            $delivery = 0;
        }
        $repeat = $request->repeat;
        $done = 0;
        $count = 0;
        if (isset($request->repeat_count)) {
            $count = $request->repeat_count;
        }
        if (isset($request->repeat_done)) {
            $done = $request->repeat_done;
        }
        $admin = 0 ;
        $user = 0 ;
        $manager = 0 ;
        $act = Actions::where('id', $id)->first();
        if ($act->done ==1){
            $delivery = $act->delivery;
            $admin = $act->admin_id;
            $user =$act->user_id;
            $manager =$act->manager_id;
        }
        if (session('level') == 2) {
            $manager = auth()->id();
        }
        elseif (session('level') == 3) {
            $admin = auth()->id();
        }
        elseif (session('level') == 4) {
            $user = auth()->id();
        }

        $act->update([
            'program_id'   => $request->program,
            'name'         => $request->title,
            'description'  => $request->description . '',
            'done'         => request()->done,
            'delivery'     => $delivery,
            'repeat'       => $repeat,
            'repeat_count' => $count,
            'repeat_done'  => $done,
            'dead_line'    => $request->date,
            'admin_id'     => $admin,
            'manager_id'   => $manager,
            'user_id'      => $user,
            'obst'         => $request->obst . '',

        ]);
        return back()->with('success', 'اقدام ویرایش شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function delete() {
        Actions::findOrFail(request('id'))->delete();
    }
}
