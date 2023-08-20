<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;

class ApiCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =Courses::query()->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data =new Courses();
        $data->fill($request->all());
        $data->save();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data =Courses::query()->findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data =Courses::query()->findOrFail($id);
        $data->fill($request->all());
        $data->save();
        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Courses::query()->findOrFail($id)->delete();
        return response()->json('xoas xong roofi');
    }
}
