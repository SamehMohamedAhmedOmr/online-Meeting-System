<?php

namespace Illuminate\Auth\Notifications;

use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        $userName = User::where('email', $notifiable->email)->pluck('name')->first();

        $greatMsg = __('Emails.Hello').' '.$userName;

        $expireFirstMsg = __('Emails.This password reset link will expire in');
        $expireTime = config('auth.passwords.users.expire');
        $expireLastMsg = __('Emails.minutes.');
        $expiration = $expireFirstMsg.' '.$expireTime.' '.$expireLastMsg;

        $salutation = __('Emails.Regards');
        return (new MailMessage)
            ->greeting($greatMsg)
            ->subject(Lang::getFromJson( __('Emails.Reset Password Notification')))
            ->line(Lang::getFromJson( __('Emails.mail reason') ))
            ->action(Lang::getFromJson( __('home.Reset Password')), url(config('app.url').route('password.reset', ['token' => $this->token], false)))
            ->line(Lang::getFromJson($expiration))
            ->line(Lang::getFromJson(__('Emails.no reset Request')))
            ->salutation($salutation);
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}
