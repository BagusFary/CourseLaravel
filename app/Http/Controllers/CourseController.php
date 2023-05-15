<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

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

        Course::create($request->all());

        return redirect('/course');
    }

    public function edit($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.edit', ['dataCourse' => $dataCourse]);
    }

    public function update(Request $request, $id){

        $dataCourse = Course::findOrFail($id);
        $dataCourse->update($request->all());
        return redirect('/course');

    }

    public function delete($id){
        $dataCourse = Course::findOrFail($id);
        return view('Course.delete', ['dataCourse' => $dataCourse]);
    }

    public function destroy($id){
        $dataCourse = Course::findOrFail($id);
        $dataCourse->delete();
        return redirect('/course');
    }


}
