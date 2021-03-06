<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Actions;
use App\Models\Category;
use App\Models\Programs;
use App\Models\Strategies;
use App\Models\TotalReport;
use Facade\FlareClient\Truncation\ReportTrimmer;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->program = [];
        $this->stra = [];
        $this->act = [];
        $this->dact = [];
        $this->percent = [];
    }

    public function index()
    {
        if (!empty(session("plan"))) {
            $plan_id = session("plan");
        } else {
            $plan_id = 1;
        }
        $data = Category::all();
        if (session("level") != 1) {
            $program = $this->program;
            $stra = $this->stra;
            $act = $this->act;
            $dact = $this->dact;
            $percent = $this->percent;

            return view(
                "admin.report.index2",
                compact("data", "program", "stra", "act", "dact", "percent")
            );
        }
        foreach ($data as $d) {
            $pro = Programs::where([
                ["category", "=", $d["code"]],
                ["plan_id", "=", $plan_id],
            ]);
            array_push($this->program, $pro->count());
            $stra = Strategies::where([
                ["category_id", "=", $d["id"]],
                ["plan_id", "=", $plan_id],
            ]);
            array_push($this->stra, $stra->count());
            $actc = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 0],
                ["plan_id", "=", $plan_id],
            ])->count();
            $act = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 1],
                ["plan_id", "=", $plan_id],
            ])->get();
            foreach ($act as $a) {
                $actc += $a["repeat_count"];
            }
            array_push($this->act, $actc);
            $a = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 0],
                ["plan_id", "=", $plan_id],
                ["done", "=", 1],
                ["manager_id", "!=", 0],
            ])->count();
            $b = Actions::where([
                ["categories_id", "=", $d["id"]],
                ["repeat", "=", 1],
                ["plan_id", "=", $plan_id],
                ["manager_id", "!=", 0],
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
            "admin.report.index2",
            compact("data", "program", "stra", "act", "dact", "percent")
        );
    }
    public function indexReport()
    {
        $data = TotalReport::all();
        return view("admin.report.index", compact("data"));
    }
    public function CreateReportView()
    {
        return view("admin.report.create");
    }
    public function CustomReport(Request $request)
    {
        $plan_id = session("plan");
        $ideal = Programs::where([
            ["plan_id", $plan_id],
            ["category", $request->category],
        ])->sum("ideal");
        $done = Programs::where([
            ["plan_id", $plan_id],
            ["category", $request->category],
        ])->sum("done");
        if (
            ($done == 0) |
            ($ideal == 0) |
            ($request->c == 0) |
            ($request->h == 0)
        ) {
            return back()->with("danger", "?????????? ???????????? ???????? ??????????");
        }
        $A = ($done * 100) / $ideal;
        $A1 = $A / $request->h;
        $A2 = $A / $request->c;
        $R = ($A1 + $A2) / 2;
        TotalReport::create([
            "category_id" => Category::whereCode($request->category)->first()
                ->id,
            "result" => $R,
            "year" => Jalalian::forge("today")->format("%Y"),
            "h_value" => $request->h,
            "c_value" => $request->c,
        ]);
    }
}
