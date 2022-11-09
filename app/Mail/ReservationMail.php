<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vehicle, $user, $inputs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vehicle, $user, $inputs)
    {
        $this->vehicle = $vehicle;
        $this->user = $user;
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reservations');
    }
}
