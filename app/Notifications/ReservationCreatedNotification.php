<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class ReservationCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Reservation Created')
            ->line('A new reservation has been created.')
            ->action('View Reservation', route('admin.reservations.show', $this->reservation->id));
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'reservation_created',
            'reservation_id' => $this->reservation->id,
            'guest_name' => $this->reservation->guest->full_name,
            'room_number' => $this->reservation->room->room_number,
            'check_in' => $this->reservation->check_in->format('Y-m-d'),
            'check_out' => $this->reservation->check_out->format('Y-m-d'),
            'message' => "New reservation for {$this->reservation->guest->full_name} in room {$this->reservation->room->room_number}",
            'url' => route('admin.reservations.show', $this->reservation->id)
        ];
    }
}
