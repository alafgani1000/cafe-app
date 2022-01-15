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
            if($order->status == 3){
                return response('order already paid', 422);
            }else{
                $bill = $order->total_price;
            }
        }
        return response()->json([
            'order_id' => $order->id,
            'bill' => $bill
        ]);
    }

    public function detail($id)
    {
        $order = Order::where('id',$id)->first();
        if($order->status == 3){
            return response('order already paid', 422);
        }else{
            return view('payments.detail',compact('order'));
        }

    }

    public function pay(Request $request, $id)
    {
        $request->validate([
            'pay' => 'required|numeric',
            'change' => 'required|numeric'
        ]);

        $orderCheck = Order::where('tnumber',$id)->first();
        if($orderCheck->status == 3)
        {
            return response('Order already payment', 422);
        }else{
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

                $dataOrder->table->each(function($item, $key){
                    $item->table->update([
                        'status' => 1
                    ]);
                });
            }

            return response('Payment success');
        }

    }

    public function printStruct($id)
    {
        $order = Order::find($id);
        return view('payments.struct', compact('order'));
    }

}
