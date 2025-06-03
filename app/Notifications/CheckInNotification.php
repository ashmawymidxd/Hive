<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation;

class CheckInNotification extends Notification implements ShouldQueue
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
            ->subject('Guest Checked In')
            ->line("Guest {$this->reservation->guest->full_name} has checked in.")
            ->action('View Reservation', route('admin.reservations.show', $this->reservation->id));
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'check_in',
            'reservation_id' => $this->reservation->id,
            'guest_name' => $this->reservation->guest->full_name,
            'room_number' => $this->reservation->room->room_number,
            'check_in_time' => now()->format('Y-m-d H:i:s'),
            'message' => "{$this->reservation->guest->full_name} checked in to room {$this->reservation->room->room_number}",
            'url' => route('admin.reservations.show', $this->reservation->id)
        ];
    }
}
