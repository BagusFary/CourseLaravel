<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(){
        $dataCourse = Course::get();
        return view('Course.index', ['dataCourse' => $dataCourse]);
    }

    public function create(){
        return view('Course.create');
    }

    public function store(Request $request){

        $extension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnailName = now()->timestamp.".".$extension;
        
        $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
        
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailName,
            'price' => $request->price,
        ]);

        return redirect('/show-all-courses');
    }

    public function edit($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.edit', ['dataCourse' => $dataCourse]);
    }

    public function update(Request $request, $id){

        if($request->file('thumbnail')){
            $oldThumbnail = Course::findOrFail($id);
            Storage::delete('thumbnail/'. $oldThumbnail->thumbnail);
            $extension = $request->file('thumbnail')->getClientOriginalExtension();
            $thumbnailName = now()->timestamp.".".$extension;
            $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
            $dataCourse = Course::findOrFail($id);
            $dataCourse->update([
                'title' => $request->title,
                'description' => $request->description,
                'thumbnail' => $thumbnailName,
                'price' => $request->price,
            ]);
        }

        $dataCourse = Course::findOrFail($id);
        $dataCourse->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect('/show-all-courses');

    }

    public function delete($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.delete', ['dataCourse' => $dataCourse]);
    }

    public function destroy($id){
        $dataCourse = Course::findOrFail($id);
        Storage::delete('thumbnail/'. $dataCourse->thumbnail);
        $dataCourse->delete();
        return redirect('/show-all-courses');
    }

    public function tes(){
        return view('Course.tes');
    }

}
