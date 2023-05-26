<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index(){
        $dataCourse = Course::paginate(3);
        return view('Course.index', ['dataCourse' => $dataCourse]);
    }

    public function detail($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.detail', ['dataCourse' => $dataCourse]);
    }

    public function create(){
        return view('Course.create');
    }

    public function store(CreateCourseRequest $request){

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

    public function update(UpdateCourseRequest $request, $id){

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
        } 
        
        if($request->file('video')) {
            
            $oldFile = Course::findOrFail($id);
            Storage::delete('video/'. $oldFile->video);
            $extension = $request->file('video')->getClientOriginalExtension();
            $videoName = "video"."-".now()->timestamp.".".$extension;
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
