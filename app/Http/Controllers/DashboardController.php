<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard.index');
    }

    public function showAllCourses(){
        $dataCourse = Course::get();
        return view('Dashboard.admin.showallcourses',['dataCourse' => $dataCourse]);
    }

    public function showAllOrders(){
        $dataOrder = Order::with(['user:id,name','course:id,title'])->get();
        return view('Dashboard.admin.showallorders', ['dataOrder' => $dataOrder]);
    }

    public function showAllUserOrders(){
        $dataOrder = Order::with('course:id,title')
                            ->where('user_id',Auth::user()->id)
                            ->select(['course_id','price','status'])
                            ->get();
        return view('Dashboard.user.showallorders',['dataOrder' => $dataOrder]);
    }
}
