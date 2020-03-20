<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class InvoiceRejected extends Notification
{
    use Queueable;
    protected $invoice_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $invoice_no = $this->invoice_id;
        $receiver_id = Invoice::find($this->invoice_id)->supplier_id;
        $buyer = Auth::user()->name;
        $receiver = User::find($receiver_id)->name;
        return (new MailMessage)
                    ->line('Hello '.$receiver.'.')
                    ->line('Your invoice, Invoice No: '.$invoice_no.' to '.$buyer.' has been Rejected.')
                    ->line('Login to your mobile or web application to view details.')
                    ->line('Thank you for choosing our platform!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
