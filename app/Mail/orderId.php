<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderId extends Mailable
{ 
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $orderIdSendOnEmail=''; 
    public $getInvoice='';
    public function __construct($orderIdSendOnEmail,$getInvoice)
    {
     $this->orderIdSendOnEmail=$orderIdSendOnEmail;
     $this->getInvoice=$getInvoice;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Meat Empire New Order')->view('email.order')->from('contact@themeatempire.in');
    }
}
