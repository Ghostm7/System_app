<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminJobApplicationNotification extends Notification
{
    use Queueable;

    private $jobApplication;

    public function __construct($jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Job Application Received')
                    ->greeting('Hello Admin,')
                    ->line('A new job application has been submitted by ' . $this->jobApplication->name . '.')
                    ->action('View Application', url('/admin/job-applications/' . $this->jobApplication->id))
                    ->line('Thank you for managing the applications on IST.');
    }
}
