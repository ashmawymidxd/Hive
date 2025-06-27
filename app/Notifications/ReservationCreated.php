<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationCreated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Reservation Confirmation')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your reservation has been successfully created.')
            ->line('Reservation Details:')
            ->line('Check-in: ' . $this->reservation->check_in)
            ->line('Check-out: ' . $this->reservation->check_out)
            ->line('Room Type: ' . $this->reservation->room->type)
            ->action('View Your Reservation', url('/reservations/' . $this->reservation->id))
            ->line('Thank you for choosing our hotel!');
    }
}
