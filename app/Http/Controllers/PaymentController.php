<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index()
    {
        $data = $this->data();
        return view('payments.index', compact('data'));
    }

    public function data()
    {
        $orders = Order::where('status',2)->orderBy('created_at')->get();
        return $orders;
    }

    public function detail($id)
    {
        $order = Order::where('id',$id)->first();
        return view('orders.detail',compact('order'));
    }

}
