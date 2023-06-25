<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Jobs\OrderJob;
use App\Models\Course;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Jobs\CheckFailedJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{

    public function orderDetail($id){
        $dataCourse = Course::find($id, ['id', 'title' ,'price', 'description', 'thumbnail']);
        return view('Course.orders', ['dataCourse' => $dataCourse]);
         
    }

    public function orders(Request $request, $id){
        if(Auth::user()->role != 'user'){
            Session::flash('only-user','Only user can order course');
            return redirect(url()->previous());
        } else {
            if(empty(Order::where('user_id', Auth::user()->id)->where('course_id', $id)->first())){
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
            } else {
                Session::flash('has-orders', 'You have already ordered this course');
                return redirect(url()->previous());
            }
        }

    }

    public function approve($id){
        $order = Order::with('user')->findOrFail($id);
        $order->update([
            'status' => 'active'
        ]);

        $invoice = Invoice::create([
            'order_id' => $id,
            'amount' => $order->price,
            'payment_date' => Carbon::now(),
            'payment_method' => 'Approved',
            'status' => 'paid', 
        ]);

        $users = $order->user;

        $invoiceData = [
            'text' => "Your order has been approved by admin!",
            'body' => "Check your course here",
            'url' => url('/show-user-courses'),
            'thankyou' => "Thank you for ordering!"
        ];

        dispatch(new OrderJob($users, $invoiceData))->delay(now()->addSeconds(20));

        // dispatch(new CheckFailedJobs())->delay(now()->addSeconds(60));

        if($invoice){
            Session::flash('approve-message','Approve Order Successfull');
        } else {
            Session::flash('approve-message','Approve Order Failed');
        }
        return redirect('/show-all-orders');
        
    }

    public function cancel($id){
        $order = Order::with('user')->findOrFail($id);
        $order->update([
            'status' => 'cancel'
        ]);

        $invoice = Invoice::create([
            'order_id' => $id,
            'amount' => $order->price,
            'payment_date' => Carbon::now(),
            'payment_method' => 'Canceled',
            'status' => 'cancel', 
        ]);

        $users = $order->user;

        $invoiceData = [
            'text' => 'Your order is canceled by Admin',
            'body' => 'Order again here!',
            'url' => url('/course'),
            'thankyou' => 'Thank You!'
        ];

        dispatch(new OrderJob($users, $invoiceData))->delay(now()->addSeconds(20));

        if($invoice){
            Session::flash('cancel-message','Cancel Order Successfull');
        } else {
            Session::flash('cancel-message','Cancel Order Failed');
        }
        return redirect('/show-all-orders');
    }

    public function deleteOrders($id){

        $deleteOrders = Order::findOrFail($id);

        $deleteOrders->delete();

        if($deleteOrders){
            Session::flash('delete-message','Delete Order Successfull');
        } else {
            Session::flash('delete-message','Delete Order Failed');
        }
        return redirect(url()->previous());
    }
}
