<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\Category;
use App\Models\Goals;
use App\Http\Requests\StrategyRequest;
use App\Models\Programs;
use App\Models\Strategies;
use App\Models\UserCategory;
use foo\bar;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class StrategyController extends Controller
{
    public function __construct()
    {
        $this->category = "";
        $this->program = [];
        $this->act = [];
        $this->dact = [];
        $this->percent = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!empty(session("plan"))) {
            $plan_id = session("plan");
        } else {
            $plan_id = 1;
        }
        $strategy = new Strategies();
        $strategy = $this->only($strategy);
        $data = $strategy->where("plan_id", $plan_id)->get();
        $arr = [];
        foreach ($data as $d) {
            $a = 0;
            $e = 0;
            $per = 0;
            $n = Category::where("id", $d["category_id"])->first();
            array_push($arr, $n["name"]);
            if (session("level") != 1) {
                continue;
            }
            $pro = Programs::where("strategy", $d["code"] . $d["row"]);
            array_push($this->program, $pro->count());
            foreach ($pro->get() as $g) {
                $e = Actions::where([
                    ["program_id", "=", $g["id"]],
                    ["repeat", "=", 0],
                    ["done", "=", 1],
                ])->count();
                $a = Actions::where([
                    ["program_id", "=", $g["id"]],
                    ["repeat", "=", 0],
                ])->count();
                $m = Actions::where([
                    ["program_id", "=", $g["id"]],
                    ["repeat", "=", 1],
                ])->get();
                foreach ($m as $y) {
                    $a += $y["repeat_count"];
                    $e += $y["repeat_done"];
                }
            }
            array_push($this->act, $a);
            array_push($this->dact, $e);
            if ($a == 0 || $e == 0) {
                $per = 0;
            } else {
                $per = ($e * 100) / $a;
            }
            array_push($this->percent, $per);
        }
        $program = $this->program;
        $act1 = $this->act;
        $dact = $this->dact;
        $percent = $this->percent;
        $category = $this->category;
        return view(
            "admin.strategy.index",
            compact(
                "data",
                "arr",
                "category",
                "program",
                "act1",
                "dact",
                "percent"
            )
        );
    }

    public function only($strategy)
    {
        if (session("level") > 1) {
            $id = auth()->id();
            $uc = UserCategory::where("UserId", $id)->get();
            foreach ($uc as $uca) {
                $strategy = $strategy->orWhere("category_id", $uca->categoryId);
            }
        }
        $input = request("only");
        if (Category::find($input)) {
            $this->category = Category::where("id", $input)->first();
            $strategy = $strategy->where("category_id", $input);
        }
        return $strategy;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goal = Goals::all();
        if (isset(request()->only)) {
            $category = Category::where("id", request()->only)->first();
        } else {
            $category = Category::all();
        }
        return view("admin/strategy/create", compact("category", "goal"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StrategyRequest $request)
    {
        if (!empty(session("plan"))) {
            $plan_id = session("plan");
        } else {
            $plan_id = 1;
        }
        $row = Strategies::where("code", $request->code)->count();
        $row++;
        $goal = implode(",", $request->goal);
        $str = new Strategies();
        $str->code = $request->code;
        $str->row = $row;
        $str->category_id = $request->category;
        $str->name = $request->title;
        $str->description = $request->description . "";
        $str->goal_id = $goal;
        $str->plan_id = $plan_id;
        $str->save();
        return back()->with(
            "success",
            "راهبرد با موفقیت در دیتابیس ذخیره شد !"
        );
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
        $data = Strategies::where("id", $id)->first();
        $category = Category::all();
        $goal = Goals::all();
        $ex = explode(",", $data["goal_id"]);
        return view(
            "admin/strategy/edit",
            compact("category", "goal", "data", "ex")
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StrategyRequest $request, $id)
    {
        $goal = implode(",", $request->goal);
        $data = Strategies::findOrFail($id);
        $data->update([
            "category_id" => $request->category,
            "name" => $request->title,
            "description" => $request->description . "",
            "goal_id" => $goal,
        ]);
        return back()->with("success", "راهبرد با موفقیت ویرایش شد  !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->id == $id) {
            Strategies::findOrFail($id)->delete();
        }
        return view("admin/index")->with(
            "success",
            "حذف راهبرد با موفقیت انجام شد !"
        );
    }

    public function delete()
    {
        Strategies::findOrFail(request("id"))->delete();
    }
}
