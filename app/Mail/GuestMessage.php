<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class GuestMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $reservation;

    public function __construct($subject, $message, Reservation $reservation)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('admin.emails.guest_message')
                    ->with([
                        'content' => $this->message,
                        'reservation' => $this->reservation,
                    ]);
    }
}
