<?php

namespace App\Mail\Checkout;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfterCheckout extends Mailable
{
    use Queueable, SerializesModels;

    // buat variable
    private $checkout;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($checkout) // parameter $checkout akan lempar ke $checkout di CheckoutController.php
    {
        $this->checkout = $checkout; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // lempar $checkout __construct ke frontend nya afterCheckout.blade.php
        return $this->subject("Register Camp: {$this->checkout->Camp->title}")->markdown('emails.checkout.afterCheckout', [
            'checkout' => $this->checkout
        ]);
    }
}
