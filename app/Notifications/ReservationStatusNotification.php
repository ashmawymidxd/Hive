<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReservationStatusNotification extends Notification
{
    use Queueable;

    protected $reservation;
    protected $action;

    public function __construct($reservation, $action)
    {
        $this->reservation = $reservation;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    // notification using the MailMessage class
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Reservation {$this->action} - #{$this->reservation->id}")
            ->line("Reservation #{$this->reservation->id} has been {$this->action}.")
            ->line("Guest: {$this->reservation->guest->full_name}")
            ->line("Room: {$this->reservation->room->room_number} ({$this->reservation->room->type})")
            ->action('View Reservation', url("/admin/reservations/{$this->reservation->id}"));
    }
}
