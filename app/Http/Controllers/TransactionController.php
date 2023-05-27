<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Course;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        
        $courseOrder = Order::create($request->all());

        if($courseOrder){
            return response()->view('Transactions.order-success');
        } else {
            return response()->view('Transactions.order-failed');
        }
    }

    public function approve($id){
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'active'
        ]);

        // $invoice = Invoice::create([
        //     'order_id' => $id,
        //     'amount' => $order->price,
        //     'payment_date' => Carbon::now(),
        //     'payment_method' => 'Admin Approved',
        //     'status' => 'paid', 
        // ]);

        // if($invoice){
            Session::flash('message','Approve Order Successfull');
        // } else {
        //     Session::flash('message','Approve Order Failed');
        // }
        return redirect('/show-all-orders');
        
    }
}
