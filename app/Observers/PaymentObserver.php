<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\PaymentAction;
use Illuminate\Support\Facades\Auth;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function created(Payment $payment)
    {
        $pmt = PaymentAction::create([
            "payment_id" => $payment->id,
            "data" => json_encode($payment),
            "action" => "store",
            "user_id" => Auth::user()->id
        ]);
    }

    /**
     * Handle the Payment "updated" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function updated(Payment $payment)
    {
        $pmt = PaymentAction::create([
            "payment_id" => $payment->id,
            "data" => json_encode($payment),
            "action" => "update",
            "user_id" => Auth::user()->id
        ]);
    }

    /**
     * Handle the Payment "deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function deleted(Payment $payment)
    {
        $pmt = PaymentAction::create([
            "payment_id" => $payment->id,
            "data" => json_encode($payment),
            "action" => "delete",
            "user_id" => Auth::user()->id
        ]);
    }

    /**
     * Handle the Payment "restored" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function restored(Payment $payment)
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function forceDeleted(Payment $payment)
    {
        $pmt = PaymentAction::create([
            "payment_id" => $payment->id,
            "data" => json_encode($payment),
            "action" => "force delete",
            "user_id" => Auth::user()->id
        ]);
    }
}
