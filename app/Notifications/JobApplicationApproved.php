<?php

// app/Notifications/JobApplicationApproved.php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JobApplicationApproved extends Notification
{
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your job application has been approved!')
            ->action('View Job', url('/jobs'))
            ->line('Thank you for your patience.');
    }
}
