<?php

namespace App\Notifications\teachers;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTeacherNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $teacher ;
    protected $token;
    public function __construct($teacher, $token)
    {
        //
        $this->teacher = $teacher;
        $this->token = $token;
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
                    ->subject(env('APP_NAME').' - New Teacher Account')
                    ->greeting('Hello '.$this->teacher->name)
                    ->line($this->GetIntroductionMessage())
                    ->line("Your account details are as follows")
                    ->line("Your email address : ".$this->teacher->email)
                    ->action('Click here to set your password', $this->getResetLink())
                    ->line('Thank you for being part of '.env('APP_NAME'));
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
    protected function GetIntroductionMessage()
    {
        return "
        A new teacher account associated with ".env('APP_NAME')." has been created with this email. You can 
        now access your account by clicking on the link below.
        ";
    }
    protected function getResetLink()
    {
        return url('/password/reset/'.$this->token.'?email='.$this->teacher->email);
    }
}
