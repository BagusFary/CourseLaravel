<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard.index');
    }

    public function showAllCourses(){
        $dataCourse = Course::get();
        return view('Dashboard.showallcourses',['dataCourse' => $dataCourse]);
    }
}
