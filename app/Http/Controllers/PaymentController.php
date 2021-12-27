<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $data = $this->data();
        return view('orders.index', compact('data'));
    }
}
