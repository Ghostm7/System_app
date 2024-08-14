<?php

// app/Notifications/JobApplicationSubmitted.php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JobApplicationSubmitted extends Notification
{
    protected $jobApplication;

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
            ->line('A new job application has been submitted.')
            ->action('View Application', url('/jobs/' . $this->jobApplication->job_id))
            ->line('Thank you for using our application!');
    }
}
