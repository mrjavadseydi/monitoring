<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OptionController extends Controller
{
    public function index()
    {
        $active = Option::where("key", "active_for_edit")->first()->value;
        return view("admin.setting.create", compact("active"));
    }

    public function store(Request $request)
    {
        Option::where("key", "active_for_edit")->update([
            "value" => $request->active_for_edit,
        ]);
        Cache::put("edit", $request->active_for_edit);
        return back()->with("success", "تنظیمات با موفقیت اعمال شد !");
    }
}
