<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;

class ReportController extends Controller
{
    public function viewMonthly(Request $request)
    {
        return view('report.monthly');
    }

    public function monthlyReport(Request $request)
    {
        $order = Order::whereDate('created_at', '>=', $request->startDate)->whereDate('created_at','<=',$request->endDate);
        return DataTables::eloquent($order)
            ->addColumn('menu', function($orderData){
                $menu = '';
                foreach($orderData->detail as $item){
                    $menu = $menu.''.(($menu == '') ? ''  : ', ').$item->menu;
                };
                return $menu;
            })
            ->toJson();
    }
}
