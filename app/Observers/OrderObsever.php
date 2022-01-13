<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderAction;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class OrderObsever
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        $act = OrderAction::create([
            'order_id' => $order->id,
            'action' => 'store',
            'data' => json_encode($order),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);

        $order->detail->each(function($item, $key){
            OrderAction::create([
                'order_id' => $item->id,
                'action' => 'store',
                'data' => json_encode($item),
                'user_id' => Auth::user()->id,
                'table_name' => 'order_detail'
            ]);
        });
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        $act = OrderAction::create([
            'order_id' => $order->id,
            'action' => 'update',
            'data' => json_encode($order),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        $act = OrderAction::create([
            'order_id' => $order->id,
            'action' => 'delete',
            'data' => json_encode($order),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        $act = OrderAction::create([
            'order_id' => $order->id,
            'action' => 'force deleted',
            'data' => json_encode($order),
            'user_id' => Auth::user()->id,
            'table_name' => 'order'
        ]);
    }
}
