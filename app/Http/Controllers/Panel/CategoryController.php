<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\Category;
use App\Models\Programs;
use App\Models\Strategies;
use App\User;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->program = [];
        $this->stra = [];
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
        $data = Category::all();
        if (session("level") != 1) {
            $program = $this->program;
            $stra = $this->stra;
            $act = $this->act;
            $dact = $this->dact;
            $percent = $this->percent;
            return view(
                "admin.category.categorylist",
                compact("data", "program", "stra", "act", "dact", "percent")
            );
        }
        foreach ($data as $d) {
            $pro = Programs::where("category", $d["code"]);
            array_push($this->program, $pro->count());
            $stra = Strategies::where("category_id", $d["id"]);
            array_push($this->stra, $stra->count());
            $actc = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 0],
            ])->count();
            $act = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 1],
            ])->get();
            foreach ($act as $a) {
                $actc += $a["repeat_count"];
            }
            array_push($this->act, $actc);
            $a = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 0],
                ["done", "=", 1],
            ])->count();
            $b = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 1],
            ])->get();
            foreach ($b as $y) {
                $a += $y["repeat_done"];
            }
            array_push($this->dact, $a);
            if ($a == 0 || $actc == 0) {
                $done = 0;
            } else {
                $done = ($a * 100) / $actc;
            }

            array_push($this->percent, $done);
        }

        $program = $this->program;
        $stra = $this->stra;
        $act = $this->act;
        $dact = $this->dact;
        $percent = $this->percent;
        return view(
            "admin/category/categorylist",
            compact("data", "program", "stra", "act", "dact", "percent")
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/category/category");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Category $request)
    {
        if ($request->isCollage == "true") {
            $isCollage = true;
        } else {
            $isCollage = false;
        }
        $category = new Category();
        $category->name = $request->category;
        $category->isCollage = $isCollage;
        $category->description = $request->description . "";
        $category->code = $request->code;
        $category->save();
        return back()->with("success", "طبقه با موفقیت افزوده شد !");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Category::findOrFail($id);
        return view("admin/category/show", compact("data"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return view("admin/category/editcategory", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\Category $request, $id)
    {
        $data = Category::findOrFail($request->id);
        if ($request->isCollage == "true") {
            $isCollage = true;
        } else {
            $isCollage = false;
        }
        $data->update([
            "name" => $request->category,
            "isCollage" => $isCollage,
            "description" => $request->description . "",
            "code" => $request->code,
        ]);
        return back()->with("success", "طبقه با موفقیت ویرایش شد !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view("admin/index")->with(
            "success",
            "حذف رکورد از دیتابیس باموفقیت انجام شد !"
        );
    }

    public function delete()
    {
        $id = request("id");
        $data = UserCategory::where("CategoryId", $id)->get();
        foreach ($data as $d) {
            User::findOrFail($d["userId"])->delete();
        }
        UserCategory::where("CategoryId", $id)->delete();
        Category::findOrFail($id)->delete();
    }
}
