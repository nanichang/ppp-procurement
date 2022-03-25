<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMdaDeclineNotification extends Notification
{
    use Queueable;
    var $mdaData;
    var $plan;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($mdaData, $plan)
    {
        $this->mdaData = $mdaData;
        $this->plan = $plan;
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
        return (new MailMessage)
            ->subject($this->plan->project_description .' Declined!')
            ->greeting('Hello '. $this->mdaData->name . '!')
            ->line('This is to inform you that your submission for "' . $this->plan->project_description . '" has been Declined!')
            ->line('Kindly review your submission and submit again for approval')
            ->action('Login to continue', url('/'));
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
