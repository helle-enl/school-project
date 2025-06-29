<?php

namespace App\Mail;

use App\Models\ProductOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(ProductOrder $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('New Order Received - #' . $this->order->id)
            ->view('emails.new-order-notification')
            ->with(['order' => $this->order]);
    }
}
