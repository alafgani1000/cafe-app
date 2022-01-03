<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $data = $this->datas();
        return view('payments.index', compact('data'));
    }

    public function datas()
    {
        $orders = Order::where('status',2)->orderBy('created_at')->get();
        return $orders;
    }

    public function orderData($id)
    {
        $order = Order::find($id);
        if(is_null($order)){
            $bill = null;
        }else{
            $bill = $order->total_price;
        }
        return $bill;
    }

    public function detail($id)
    {
        $order = Order::where('id',$id)->first();
        return view('payments.detail',compact('order'));
    }

    public function pay(Request $request, $id){
        $request->validate([
            'pay' => 'required|numeric',
            'change' => 'required|numeric'
        ]);

        $order = Order::where('id', $id)->update([
            'status' => 3
        ]);

        if($order){
            $dataOrder = Order::find($id);
            $payment = Payment::create([
                'order_id' => $dataOrder->id,
                'money' => $request->pay,
                'return' => $request->change
            ]);
        }
    }

}
