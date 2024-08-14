<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobApplicationStatusNotification extends Notification
{
    use Queueable;

    private $jobApplication;

    public function __construct($jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello ' . $this->jobApplication->name . ',')
                    ->line('The status of your job application has been updated to ' . $this->jobApplication->status . '.')
                    ->action('View Application', url('/job-applications/' . $this->jobApplication->id))
                    ->line('Thank you for reaching out to IST.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Hello ' . $this->jobApplication->name . ', your job application status is now ' . $this->jobApplication->status . '.',
            'url' => url('/job-applications/' . $this->jobApplication->id)
        ];
    }
}

