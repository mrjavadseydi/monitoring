<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\problemTypeRequest;
use App\Models\ProblemType;
use Illuminate\Http\Request;

class ProblemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProblemType::all();
        return view("admin.probleType.index", compact("data"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.probleType.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(problemTypeRequest $request)
    {
        ProblemType::create([
            "title" => $request->title,
            "description" => $request->description,
        ]);
        return redirect(route("problemType.index"))->with(
            "success",
            "با موفقیت افزوده شد !"
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
        $data = ProblemType::findOrFail($id);
        return view("admin.probleType.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        problemTypeRequest $request,
        ProblemType $problemType
    ) {
        $problemType->update([
            "title" => $request->title,
            "description" => $request->description,
        ]);

        return redirect(route("problemType.index"))->with(
            "success",
            "با موفقیت ویرایش شد !"
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProblemType::whereId($id)->delete();
    }
}
