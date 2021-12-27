<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderTable;
use DataTables;

class OrderController extends Controller
{
    public function index()
    {
        $data = $this->data();
        return view('orders.index', compact('data'));
    }

    public function data()
    {
        $orders = Order::whereNull('status')->orderBy('created_at')->get();
        return $orders;
    }

    public function detail($id)
    {
        $order = Order::where('id',$id)->first();
        return view('orders.detail',compact('order'));
    }

}
