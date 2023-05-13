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

        // $dataCourse = $request->all();

        // $dataCourse->save();

        $dataCourse = Course::create($request->all());

        return redirect('/course');
    }
}
