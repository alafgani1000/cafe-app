<?php

namespace App\Observers;

use App\Models\OrderDetail;
use App\Models\OrderAction;
use Illuminate\Support\Facades\Auth;

class OrderDetailObserver
{
    /**
     * Handle the OrderDetail "created" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function created(OrderDetail $orderDetail)
    {
        $act = OrderAction::create([
            'order_id' => $orderDetail->id,
            'action' => 'store',
            'data' => json_encode($orderDetail),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }

    /**
     * Handle the OrderDetail "updated" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function updated(OrderDetail $orderDetail)
    {
        $act = OrderAction::create([
            'order_id' => $orderDetail->id,
            'action' => 'update',
            'data' => json_encode($orderDetail),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }

    /**
     * Handle the OrderDetail "deleted" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function deleted(OrderDetail $orderDetail)
    {
        $act = OrderAction::create([
            'order_id' => $orderDetail->id,
            'action' => 'delete',
            'data' => json_encode($orderDetail),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }

    /**
     * Handle the OrderDetail "restored" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function restored(OrderDetail $orderDetail)
    {

    }

    /**
     * Handle the OrderDetail "force deleted" event.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return void
     */
    public function forceDeleted(OrderDetail $orderDetail)
    {
        $act = OrderAction::create([
            'order_id' => $orderDetail->id,
            'action' => 'force delete',
            'data' => json_encode($orderDetail),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }
}
