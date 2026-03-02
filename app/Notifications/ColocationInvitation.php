<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invitation;

class ColocationInvitation extends Notification
{
    use Queueable;

    public $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('invitations.accept', ['token' => $this->invitation->token]);

        return (new MailMessage)
                    ->subject('Invitation to join ' . $this->invitation->colocation->name)
                    ->greeting('Hello!')
                    ->line('You have been invited to join the colocation **' . $this->invitation->colocation->name . '**.')
                    ->line('Click the button below to accept the invitation and join the group.')
                    ->action('Accept Invitation', $url)
                    ->line('If you do not have an account yet, you can create one during the acceptance process.')
                    ->salutation('Best regards, The EasyColoc Team');
    }
}