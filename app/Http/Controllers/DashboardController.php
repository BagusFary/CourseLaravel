<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard.index');
    }

    public function showAllCourses(){
        $dataCourse = Course::paginate(3);
        return view('Dashboard.admin.showallcourses',['dataCourse' => $dataCourse]);
    }

    public function showAllOrders(){
        $dataOrder = Order::with(['user:id,name','course:id,title'])
                            ->where('status','pending')
                            ->get();
        return view('Dashboard.admin.showallorders', ['dataOrder' => $dataOrder]);
    }

    public function showApprovedOrders(){
        $dataOrder = Order::with(['user:id,name','course:id,title'])
                            ->where('status', 'active')
                            ->orWhere('status', 'cancel')
                            ->get();
        return view('Dashboard.admin.showapprovedorders', ['dataOrder' => $dataOrder]);
    }

    public function showAllUserOrders(){
        $dataOrder = Order::with('course:id,title')
                            ->where('user_id',Auth::user()->id)
                            ->select(['course_id','price','status'])
                            ->get();
        return view('Dashboard.user.showallorders',['dataOrder' => $dataOrder]);
    }

    public function showAllUserCourses(){
        $dataCourse = User::with(['orders' => function($query){
            $query->where('status', 'active')
                  ->select(['id','user_id','course_id','status']);
        },
        'orders.invoice'=> function($query){
            $query->where('status', 'paid')
                  ->select(['order_id','status']);
        },
        'orders.course' => function($query){
            $query->select(['id','title','description','thumbnail','video']);
        }
        ])->where('id', Auth::user()->id)
          ->select(['id','name','email'])->get();
        
        return view('Dashboard.user.showallcourses', ['dataCourse' => $dataCourse]);
    }
}
