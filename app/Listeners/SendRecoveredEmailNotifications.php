<?php

namespace App\Listeners;

use App\Notifications\EndpointDownNotification;
use App\Notifications\EndpointRecoveredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendRecoveredEmailNotifications
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event): void
    {
        collect($event->check->endpoint->site->notification_emails)
            ->each(function ($email) use($event) {
                // send the email to the Notification channel 'mail'
                Notification::route('mail', $email)
                    ->notify(new EndpointRecoveredNotification($event->check->endpoint));
            });
    }
}
