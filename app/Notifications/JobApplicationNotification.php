<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\JobApplication;

class JobApplicationNotification extends Notification
{
    use Queueable;

    protected $jobApplication;

    /**
     * Create a new notification instance.
     *
     * @param  JobApplication  $jobApplication
     * @return void
     */
    public function __construct(JobApplication $jobApplication)
    {
        $this->jobApplication = $jobApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // You can add other channels like 'database', 'broadcast' if needed
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have a new job application.')
                    ->action('View Application', url('/jobs/' . $this->jobApplication->job_id))
                    ->line('Thank you for using our application!');
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
            'job_id' => $this->jobApplication->job_id,
            'user_id' => $this->jobApplication->user_id,
            'message' => 'A new job application has been submitted.',
        ];
    }
}
