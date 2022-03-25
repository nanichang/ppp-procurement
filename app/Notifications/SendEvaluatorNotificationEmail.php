<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendEvaluatorNotificationEmail extends Notification
{
    use Queueable;
    var $evaluator;
    var $mdaData;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($evaluator, $mdaData)
    {
        $this->evaluator = $evaluator;
        $this->mdaData = $mdaData;
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
                    ->subject('Invitation')
                    ->greeting('Hello '. $this->evaluator->name . '!')
                    ->line('You have been invited to act as an evaluator at ' . $this->mdaData->name)
                    ->line('Please find below your invitation details ')
                    ->line('Email: ' . $this->evaluator->email)
                    ->line('Code: ' . $this->evaluator->code)
                    ->action('Login here', route('evaluator.login', ['code' => $this->evaluator->id, 'email' => $this->evaluator->email]))
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
            //
        ];
    }
}
