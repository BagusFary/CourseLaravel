<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
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

    public function store(CourseRequest $request){

        $videoExtension = $request->file('video')->getClientOriginalExtension();
        $videoName = "video"."-".now()->timestamp.".".$videoExtension;

        $thumbnailExtension = $request->file('thumbnail')->getClientOriginalExtension();
        $thumbnailName = now()->timestamp.".".$thumbnailExtension;
        
        $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
        $request->file('video')-> storeAs('video',$videoName);

        
        
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailName,
            'video' => $videoName,
            'price' => $request->price,
        ]);


        return redirect('/show-all-courses');
    }

    public function edit($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.edit', ['dataCourse' => $dataCourse]);
    }

    public function update(CourseRequest $request, $id){

        if($request->file('thumbnail')){

            $oldFile = Course::findOrFail($id);
            Storage::delete('thumbnail/'. $oldFile->thumbnail);
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
        } else if($request->file('video')) {
            
            $oldFile = Course::findOrFail($id);
            Storage::delete('video/'. $oldFile->video);
            $extension = $request->file('video')->getClientOriginalExtension();
            $videoName = now()->timestamp.".".$extension;
            $request->file('video')->storeAs('video', $videoName);
            $dataCourse = Course::findOrFail($id);
            $dataCourse->update([
                'title' => $request->title,
                'description' => $request->description,
                'video' => $videoName,
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
        Storage::delete('video/'. $dataCourse->video);
        $dataCourse->delete();
        return redirect('/show-all-courses');
    }

    public function tes(){
        return view('Course.tes');
    }

}
