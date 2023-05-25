<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function orderDetail($id){
        $dataCourse = Course::find($id, ['id', 'title' ,'price', 'description', 'thumbnail']);
        return view('Course.orders', ['dataCourse' => $dataCourse]);
         
    }

    public function orders(Request $request, $id){

        $course = Course::find($id, ['price']);

        $request['user_id'] = Auth::user()->id;
        $request['course_id'] = $id;
        $request['price'] = $course->price;
        $request['payment_status'] = "unpaid";
        
        $courseOrder = Order::create($request->all());

        if($courseOrder){
            return response()->view('Transactions.order-success');
        } else {
            return response()->view('Transactions.order-failed');
        }
    }

    public function payment(Request $request){
        $request['payment_status'] = "unpaid";
        $courseOrder = Order::create($request->all());

        if($courseOrder){
            return response()->view('Transactions.success');
        } else {
            return response()->view('Transactions.failed');
        }
    }
}
