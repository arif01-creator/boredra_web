<?php

namespace App\Notifications;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewInquiryReceived extends Notification
{
    use Queueable;

    public function __construct(public readonly Inquiry $inquiry) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Inquiry — '.$this->inquiry->name)
            ->line('A new inquiry has been submitted through the Borendra International website.')
            ->line('Name: '.$this->inquiry->name)
            ->line('Company: '.($this->inquiry->company ?? '—'))
            ->line('Email: '.$this->inquiry->email)
            ->line('Country: '.($this->inquiry->country ?? '—'))
            ->line('Product Interest: '.($this->inquiry->product_interest ?? '—'))
            ->line('Message: '.$this->inquiry->message)
            ->action('View in Admin', route('admin.inquiries.show', $this->inquiry));
    }
}
