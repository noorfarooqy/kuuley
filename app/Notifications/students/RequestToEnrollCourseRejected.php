<?php

namespace App\Notifications\students;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestToEnrollCourseRejected extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $course;
    protected $student;
    public function __construct($course, $student)
    {
        //
        $this->course = $course;
        $this->student = $student;
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
            ->subject(env('APP_NAME') . ' - Request to enroll rejected')
            ->greeting('Hello ' . $this->student->student_firstname . ' ' . $this->student->student_secondname)
            ->line('You have requested to enroll in ' . $this->course->course_name)
            ->line('We are sorry to inform you that your request has been rejected. 
            If you believe that is a mistake please contact support for further information.');
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
