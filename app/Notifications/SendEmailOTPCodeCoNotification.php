<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailOTPCodeCoNotification extends Notification implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected string $code;
    /**
     * Create a new notification instance.
     */
    public function __construct(User $user , string $code)
    {
        $this->user = $user;
        $this->code = $code;
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
        return (new MailMessage)
                    ->subject('Furni - Reset Password')
                    ->line('Welcome '.$this->user->name .' to our website')
                    ->line('Your OTP Code is: ' . $this->code )
                    ->line('Thank you for using our application!');
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
