<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Table;
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

    public function getOrder(Request $request)
    {
        $countOrder = 0;
        $orders = $request->session()->get('orders');
        $tables = Table::where('status',1)->get();
        return view('menus.view-cart', compact('orders','tables'));
    }

    public function indexOrder(Request $request)
    {
        return view('menus.index-cart');
    }

    public function deleteOrder(Request $request)
    {
        $orderSession = $request->session()->get('orders');
        $dataNot = $orderSession->where('menuId','!=', $request->id);
        $newData = $dataNot;
        Session::put(['orders' => $newData]);
        return response()->json([
            'message' => 'Delete order success'
        ]);
    }

    public function updateOrder(Request $request)
    {
        $menu = Menu::find($request->id);
        $orders = collect();
        if ($request->session()->has('orders')) {
            $orderSession = $request->session()->get('orders');
            $dataNow = $orderSession->where('menuId', $request->id);
            $dataEdit = $dataNow->first();
            if (isset($dataEdit)) {
                $newQty = $request->qty;
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
            }
        }
        return response()->json([
            'message' => 'Update order success'
        ]);
    }

    public function saveOrder(Request $request)
    {
        if(isset($request->room)) {
            $orders = $request->session()->get('orders');
            $orderMap = $orders->map(function($item, $key){
                return [
                    'menuId' => $item['menuId'],
                    'name' => $item['name'],
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total_price' => $item['price'] * $item['qty']
                ];
            });

            $order = Order::create([
                'total_price' => $orderMap->sum('total_price')
            ]);

            foreach($request->room as $item) {
                $order->table()->create([
                    'table_id' => $item
                ]);

                Table::where('id', $item)->update([
                    'status' => 0
                ]);
            }

            foreach($orderMap as $item){
                $order->detail()->create([
                    'menu_id' => $item['menuId'],
                    'menu' => $item['name'],
                    'qty' => $item['qty'],
                    'price' => $item['price']
                ]);
            }

            $request->session()->forget('orders');

            return response()->json([
                'message' => 'Order Success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Order Error'
            ], 422);
        }
    }
}
