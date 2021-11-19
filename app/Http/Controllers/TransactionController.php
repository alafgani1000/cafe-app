<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TransactionController extends Controller
{
    public function order(Request $request)
    {
        $menu = Menu::find($request->id);
        $orders = collect();
        if ($request->session()->has('orders')) {
            $orderSession = $request->session()->get('orders');
            $dataNow = $orderSession->where('menuId', $request->id);
            $dataEdit = $dataNow->first();
            if (isset($dataEdit)) {
                $newQty = $dataEdit['qty'] + $request->qty;
                $dataNot = $orderSession->where('menuId','!=', $request->id);
                $newData = $dataNot;
                $order = [
                    'menuId' => $request->id,
                    'name' => $menu->name,
                    'qty' => $newQty,
                    'price' => $menu->price
                ];
                $newData->push($order);
                $request->session()->put('orders', $newData);
            } else {
                $order = [
                    'menuId' => $request->id,
                    'name' => $menu->name,
                    'qty' => $request->qty,
                    'price' => $menu->price
                ];
                $orderSession->push($order);
                $request->session()->put('orders', $orderSession);
            }

        } else {
            $order = [
                'menuId' => $request->id,
                'name' => $menu->name,
                'qty' => $request->qty,
                'price' => $menu->price
            ];
            $orders->push($order);
            Session::put(['orders' => $orders]);
        }
    }

    public function getCountOrder(Request $request)
    {
        $countOrder = 0;
        $orders = $request->session()->get('orders');
        $countOrder = !is_null($orders) ? $orders->count() : 0;
        return response()->json([
            'count' => $countOrder
        ]);
    }

    public function  getOrder(Request $request)
    {
        $countOrder = 0;
        $orders = $request->session()->get('orders');
        $countOrder = !is_null($orders) ? $orders->count() : 0;
        return response()->json([
            'data' => $orders
        ]);
    }
}
