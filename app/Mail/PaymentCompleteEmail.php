<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;


class PaymentCompleteEmail extends Mailable 
{
    use Queueable, SerializesModels;

    public $subject;
    public $order_id;
    public $card_holder;
    public $card_number;
    public $buyer_name;
    public $buyer_email;
    public $item_name;
    public $item_price;
    public $currency;
    public $orders_email;
    public $purchase_date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_info)
    {
        $this->subject = $order_info['subject'];
        $this->order_id = $order_info['order_id'];
        $this->card_holder = $order_info['card_holder'];
        $this->card_number = $order_info['card_number'];
        $this->buyer_name = $order_info['buyer_name'];
        $this->buyer_email = $order_info['buyer_email'];
        $this->item_name = $order_info['item_name'];
        $this->item_price = $order_info['item_price'];
        $this->currency = $order_info['currency'];
        $this->purchase_date = $order_info['purchase_date'];
        $this->orders_email = env('ORDERS_EMAIL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject($this->subject)
                    ->from($this->orders_email)
                    ->to($this->buyer_email)
                    ->view('emails.paymentComplete');
    }
}
