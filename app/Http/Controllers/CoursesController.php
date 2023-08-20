<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    const OBJ = 'courses';
    const DOT = '.';

    function uploadFile($nameFolder, $file)
    {
        $fileName = time() . '-' . $file->getClientOriginalName();
        return $file->storeAs($nameFolder, $fileName, 'public');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Courses::query()->get();
        return view(self::OBJ . self::DOT . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::OBJ . self::DOT . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'image' => ['required'],
        ]);
        $param = $request->except('_token');
        if ($request->hasFile('image')) {
            $param['image'] = $this->uploadFile('images', $request->file('image'));
        }
        $courses = Courses::create($param);
        if ($courses->id) {
            return redirect()->route('courses.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Courses::query()->findOrFail($id);
        return view(self::OBJ . self::DOT . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'image' => ['nullable'],
        ]);
        $model = Courses::query()->findOrFail($id);
        $param = $request->except('_token', '_method');
        if ($request->hasFile('image')) {
            $deleteImage = Storage::delete('/public/'.$model->image);
            if ($deleteImage) {
                $param['image'] = $this->uploadFile('images', $request->file('image'));
            } else {
                $param['image'] = $model->image;
            }
        }
        $courses = Courses::where('id', $id)->update($param);
        if ($courses) {
            return redirect()->route('courses.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Courses::query()->findOrFail($id);
        Storage::delete('/public/'.$model->image);
        $model->delete();
        return back();
    }
}
