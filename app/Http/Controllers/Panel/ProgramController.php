<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramEditRequest;
use App\Http\Requests\ProgramRequest;
use App\Models\Actions;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Programs;
use App\Models\Strategies;
use App\Models\UserCategory;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->stra = "";
    }

    public function index()
    {
        if (!empty(session("plan"))) {
            $plan_id = session("plan");
        } else {
            $plan_id = 1;
        }
        $program = new Programs();
        $program = $this->only($program);
        $data = $program->where("plan_id", $plan_id)->get();
        $all = [];
        $done = [];
        $stra = $this->stra;
        $p = Plan::where("id", $plan_id)->first();
        $plan = [
            $p->now,
            $p->first + 0,
            $p->first + 1,
            $p->first + 2,
            $p->first + 3,
            $p->first + 4,
        ];
        foreach ($data as $d) {
            $a = 0;
            $b = 0;
            $a = Actions::where([
                ["program_id", "=", $d["id"]],
                ["repeat", "!=", 1],
            ])->count();
            $b = Actions::where([
                ["program_id", "=", $d["id"]],
                ["done", "=", 1],
                ["repeat", "!=", 1],
            ])->count();
            $c = Actions::where([
                ["program_id", "=", $d["id"]],
                ["repeat", "!=", 0],
            ])->get();
            //            $a=0;
            //            $b=0;
            foreach ($c as $r) {
                $a += $r["repeat_count"];
                $b += $r["repeat_done"];
            }
            array_push($all, $a);
            array_push($done, $b);
        }
        return view(
            "admin/program/index",
            compact("data", "done", "all", "stra", "plan")
        );
    }

    public function only($program)
    {
        if (session("level") > 1) {
            $id = auth()->id();
            $uc = UserCategory::where("UserId", $id)->get();
            foreach ($uc as $uca) {
                $cat = Category::where("id", $uca->categoryId)->first();
                $program = $program->orWhere("category", $cat->code);
            }
        }
        $input = request("only");
        $input1 = request("strategy");
        if (Category::find($input)) {
            $code = Category::where("id", $input)->first();
            $program = $program->where(
                "category",
                $code["code"] . $code["row"]
            );
        } elseif (Strategies::find($input1)) {
            $code = Strategies::where("id", $input1)->first();
            $this->stra = $code;
            $program = $program->where(
                "strategy",
                $code["code"] . $code["row"]
            );
        }
        return $program;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session("level") > 1) {
            if (isset(request()->strategy)) {
                $strategy = Strategies::where(
                    "id",
                    request()->strategy
                )->first();
            } else {
                $id = auth()->id();
                $uc = UserCategory::where("UserId", $id)->get();
                $strategy = new Strategies();
                foreach ($uc as $uca) {
                    $strategy = $strategy->orWhere(
                        "category_id",
                        $uca->categoryId
                    );
                }
                $strategy = $strategy->get();
            }
        } else {
            if (isset(request()->strategy)) {
                $strategy = Strategies::where(
                    "id",
                    request()->strategy
                )->first();
            } else {
                $strategy = Strategies::all();
            }
        }
        if (isset(request()->only)) {
            $category = Category::where("id", request()->only)->first();
        } else {
            $category = Category::all();
        }
        return view("admin/program/create", compact("strategy", "category"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramRequest $request)
    {
        if (!empty(session("plan"))) {
            $plan_id = session("plan");
        } else {
            $plan_id = 1;
        }
        $row = Programs::where([
            ["category", "=", $request->cat1egory],
            ["strategy", "=", $request->strategy],
        ])->count();
        $program = new Programs();
        $program->strategy = $request->strategy;
        $program->category = $request->category;
        $program->row = ++$row;
        $program->name = $request->title;
        $program->strategies_id = $request["stra-id"];
        $program->dead_line = $request->date;
        $program->description = $request->description . "";
        $program->plan_id = $plan_id;
        $program->rcancel = "";
        $program->shortcut = "";
        $program->ideal = $request->ideal;
        $program->done = $request->done;
        $program->save();
        return back()->with("success", "افزودن برنامه با موفق انجام شد !");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Programs::where("id", $id)->first();
        $stra = Strategies::all();
        $cate = Category::all();
        return view("admin/program/edit", compact("data", "stra", "cate"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramEditRequest $request, $id)
    {
        $row = Programs::where([
            ["strategy", "=", $request->strategy],
            ["category", "=", $request->category],
            ["id", "!=", $id],
        ])->count();
        $row++;
        $up = Programs::findOrFail($id);
        $up->update([
            "strategy" => $request->strategy,
            "name" => $request->title,
            "category" => $request->category,
            "row" => $row,
            "strategies_id" => $request["stra-id"],
            "strategy" => $request->strategy,
            "dead_line" => $request->date,
            "description" => $request->description . "",
            "rcancel" => $request->rcancel . "",
            "shortcut" => $request->shortcut . "",
            "ideal" => $request->ideal . "",
            "done" => $request->done . "",
        ]);
        return back()->with("success", "ویرایش برنامه با موفقیت انجام شد !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == request()->id) {
            Programs::findOrFail($id)->delete();
        }
        return redirect(route("program.index"))->with(
            "success",
            "حذف برنامه با موفقیت انجام شد !"
        );
    }

    public function delete()
    {
        Programs::findOrFail(request("id"))->delete();
    }
}
