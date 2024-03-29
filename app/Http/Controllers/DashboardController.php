<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard.index');
    }

    public function showAllCourses(Request $request){
        $keyword = $request->keyword;
        $dataCourse = Course::with('tags:id,name_tags')
                            ->where('title', 'LIKE', '%'.$keyword.'%')
                            ->paginate(3)
                            ->withQueryString();
        return view('Dashboard.admin.showallcourses',['dataCourse' => $dataCourse]);
    }

    public function showAllOrders(){
        return view('Dashboard.admin.showallorders');
    }

    public function showApprovedOrders(){
        $dataOrder = Order::with(['user:id,name','course:id,title'])
                            ->where('status', 'active')
                            ->orWhere('status', 'cancel')
                            ->orderBy('id','desc')
                            ->paginate(7);
        return view('Dashboard.admin.showapprovedorders', ['dataOrder' => $dataOrder]);
    }

    public function showAllUserOrders(){
        if(Auth::user()->role != 'user'){
            return response()->view('Error.unauthorized');
        } else {
            $dataOrder = Order::where('user_id', Auth::user()->id)
                                ->with('course:id,title,description,thumbnail,price')                               
                                ->select(['id','course_id','price','status'])                             
                                ->paginate(5);
            return view('Dashboard.user.showallorders',['dataOrder' => $dataOrder]);
        }
    }

    public function showAllUserCourses(){
        
        if(Auth::user()->role == 'user'){
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
              ->select(['id','name','email'])
              ->paginate(3);

            return view('Dashboard.user.showallcourses', ['dataCourse' => $dataCourse]);
        } else {
            return response()->view('Error.unauthorized');
        }
    }

   public function invoiceDetail($id){

        if(Auth::user()->role == "user"){
            $invoiceData = Invoice::with(['orders:id,user_id,course_id,created_at','orders.user:id,name,email', 'orders.course:id,title,thumbnail,price'])
                                ->where('order_id', '=', $id)
                                ->first();
        if($invoiceData){
            
        if(Auth::user()->id != $invoiceData->orders->user_id){
            return response()->view('Error.notfound');
        }
            return view('Dashboard.user.invoicedetail', ['invoiceData' => $invoiceData]);
        } else {
            return response()->view('Error.notfound');
        }
        } else {
            return response()->view('Error.unauthorized');
        }
    }
}
