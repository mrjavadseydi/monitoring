<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Contracts\DataTable;

Route::get("/", function () {
    return view("welcome");
});
Route::prefix("AdminPanel")
    ->middleware(["admin", "auth"])
    ->namespace("Panel")
    ->group(function () {
        /// resource controllers //
        Route::resource("user", "UserController");
        Route::resource("strategy", "StrategyController");
        Route::resource("category", "CategoryController");
        Route::resource("program", "ProgramController");
        Route::resource("goal", "GoalController");
        Route::resource("action", "ActionController");
        Route::resource("submit", "SubmitController");
        Route::resource("problemType", "ProblemTypeController");
        ///delete with ajax //
        Route::post("goal/delete", "GoalController@delete")->name(
            "goal.delete"
        );
        Route::post("strategy/delete", "StrategyController@delete")->name(
            "strategy.delete"
        );
        Route::post("category/delete", "CategoryController@delete")->name(
            "category.delete"
        );
        Route::post(
            "program/delete",
            'Pr
    ogramController@delete'
        )->name("program.delete");
        Route::post("action/delete", "ActionController@delete")->name(
            "action.delete"
        );
        Route::post("user/delete", "UserController@delete")->name(
            "user.delete"
        );
        Route::post("upload/delete", "panelController@delete")->name(
            "upload.delete"
        );

        //// needed controller//
        Route::get("/", "panelController@panel")->name("panel");
        Route::get("/MakeAdmin", "panelController@makeadmin")->name(
            "makeAdmin"
        );
        Route::get("/roleMaker", "panelController@showAvalbeRole")->name(
            "roleMaker"
        );
        Route::post(
            "/updateRoleForAdmin",
            "panelController@userRoleUpdate"
        )->name("userRoleUpdate");
        Route::post("/fileUpload", "panelController@uploadPhoto")->name(
            "uploadfile"
        );
        Route::post(
            "/upload-information",
            "panelController@uploadInformation"
        )->name("uploadInformation");
        Route::get("/report", "ReportController@index")->name("report.index");
        Route::get(
            "/change-current-plan/{id}",
            "panelController@changePlan"
        )->name("panel.plan");

        ///Settings
        Route::get("settings", [
            \App\Http\Controllers\OptionController::class,
            "index",
        ])->name("settings");
        Route::post("settings", [
            \App\Http\Controllers\OptionController::class,
            "store",
        ]);
        Route::get("/TotalReport", [
            \App\Http\Controllers\Panel\ReportController::class,
            "indexReport",
        ])->name("total.index");

        Route::get("/TotalReport/save", [
            \App\Http\Controllers\Panel\ReportController::class,
            "CreateReportView",
        ])->name("total.report");

        Route::post("/TotalReport/save", [
            \App\Http\Controllers\Panel\ReportController::class,
            "CustomReport",
        ]);
    });
Route::prefix("userPanel")
    ->middleware(["auth"])
    ->namespace("UserPanel")
    ->group(function () {
        Route::get("/", "UserPanel@index")->name("panel.index");
        Route::resource("UserProgram", "ProgramController");
        Route::resource("UserAction", "ActionController");
    });

Route::prefix("admin")
    ->middleware(["admin"])
    ->group(function () {
        Route::get("/upload", function () {
            return view("upload");
        });
    });

Auth::routes(["register" => false]);

Route::get("/home", function () {
    return redirect(route("panel"));
})->name("home");

// if(env('APP_DEBUG')){
Route::get("cmd", function () {
    //        return"sdfsdf";
    Artisan::call("cache:clear");
    Artisan::call("view:clear");
    // Auth::loginUsingId(2);
    return "debug_login_was_successfull";
});
// }
