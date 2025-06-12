<?php
namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $invoice;
    public $action;
    public $isForGuest;

    public function __construct(Invoice $invoice, string $action, bool $isForGuest = false)
    {
        $this->invoice = $invoice;
        $this->action = $action;
        $this->isForGuest = $isForGuest;
    }

    public function via($notifiable)
    {
        // For guests, only send email
        if ($this->isForGuest) {
            return ['mail'];
        }

        // For admins, send both email and database notification
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $subject = $this->isForGuest
            ? "Your Invoice {$this->invoice->invoice_number} has been {$this->action}"
            : "Invoice {$this->invoice->invoice_number} {$this->action}";

        $mail = (new MailMessage)
            ->subject($subject)
            ->line("Invoice #{$this->invoice->invoice_number} has been {$this->action}.")
            ->line("Guest: {$this->invoice->guest->getFullName()}")
            ->line("Room: {$this->invoice->room->room_number}")
            ->line("Amount: \$" . number_format($this->invoice->amount, 2));

        if ($this->isForGuest) {
            $mail->line("Please log in to your account to view and pay the invoice.")
                ->action('View Invoice', url('/guest/invoices/' . $this->invoice->id));
        } else {
            $mail->action('View Invoice', route('admin.invoices.show', $this->invoice));
        }

        return $mail->line('Thank you for using our services!');
    }

    public function toArray($notifiable)
    {
        if ($this->isForGuest) {
            return []; // No database notification for guests
        }

        return [
            'invoice_id' => $this->invoice->id,
            'invoice_number' => $this->invoice->invoice_number,
            'action' => $this->action,
            'message' => "Invoice {$this->invoice->invoice_number} has been {$this->action} for guest {$this->invoice->guest->getFullName()}",
            'url' => route('admin.invoices.show', $this->invoice),
        ];
    }
}
