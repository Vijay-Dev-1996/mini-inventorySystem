<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
class SendOrderConfirmation implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    /**
     * Create a new job instance.
     */
    public function __construct( public int $orderId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
    //      \Log::info('Order confirmation email sent', [
    //     'order_id' => $this->orderId,
    // ]);


        $order = \App\Models\Order::with('customer')->findOrFail($this->orderId);

    \Log::info('Order confirmation email simulated', [
        'order_id' => $order->id,
        'customer_email' => $order->customer->email,
        'message' => 'Bill email simulation completed successfully'
    ]);
    }
}
