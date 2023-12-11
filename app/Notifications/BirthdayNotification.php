<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        // dd($notifiable);
        info($notifiable);
        $name = $notifiable->name;
        return (new MailMessage)
            ->subject('Celebrate with Us! 🎉 Happy Birthday, ' . $name . '!')
            ->view('emails.birthday-greeting', compact('name'));
            // ->line('Dear ' . $notifiable->name . ',')
            // ->line('Wishing you a fantastic birthday filled with joy and success.')
            // ->line('May this year bring you even more happiness and achievements.')
            // ->line('Best regards,')
            // ->line('My App');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
