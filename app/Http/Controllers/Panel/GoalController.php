<?php

namespace App\Http\Controllers\Panel;
use App\Http\Controllers\Controller;
use App\Http\Requests\goalRequest;
use App\Models\Goals;
use App\Models\Strategies;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty(session('plan'))){
            $plan_id=session('plan');
        }else{
            $plan_id = 1;
        }
        $goal = new Goals();
        $data = $goal->where('plan_id',$plan_id)->get();
        return view('admin/goal/goal',compact('data'));
    }

    public function search($goal)
    {
        $input = Input::get();
        if($input){
            if($input['user']){
                $goal = $goal->where('user_id', $input['user_id']);
            }
        }
        return $goal;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/goal/addgoal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(goalRequest $request)
    {
        if (!empty(session('plan'))){
            $plan_id=session('plan');
        }else{
            $plan_id = 1;
        }
        $goal = new Goals();
        $goal->code = $request->code;
        $goal->title = $request->category;
        $goal->description = $request->description." ";
        $goal->plan_id = $plan_id;
        $goal->save();
        return back()->with('success','افزودن هدف با موفقیت انجام شد !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data  = Goals::findOrFail($id);
        return view('admin/goal/editgoal',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(goalRequest $request, $id)
    {
        $data = Goals::findOrFail($id);
        $data->update([
            'title'=>$request->category,
            'description'=>$request->description."",
            'code'=>$request->code,
        ]);
        return back()->with('success','ویرایش هدف با موفقیت انجام شد !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->id==$id){
            Goals::findOrFail($id)->delete();
        }
        $data  = Goals::paginate(10);
        return redirect(route('goal.index'))->with('success','حذف هدف با موفقیت انجام شد !');
    }
    public function delete(){
            Goals::findOrFail(request('id'))->delete();
    }
}
