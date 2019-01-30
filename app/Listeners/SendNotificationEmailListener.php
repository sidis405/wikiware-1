<?php

namespace App\Listeners;

use App\User;
use App\Jobs\SendReviewEmail;
use App\Events\PostWasUpdated;

class SendNotificationEmailListener
{
    public function handle(PostWasUpdated $event)
    {
        $admin = User::where('role', 'admin')->first();
        $author = $event->post->user;
        $currentUser = auth()->user();

        $sender = null;
        $recipient = null;

        if ($currentUser->isNotAdmin() && $event->post->isAuthoredBy($currentUser)) {
            $sender = $author;
            $recipient = $admin;

            $this->sendMail($sender, $recipient, $event->post);
        } elseif ($currentUser->isAdmin() && $event->post->isNotAuthoredBy($currentUser)) {
            $sender = $admin;
            $recipient = $author;

            $this->sendMail($sender, $recipient, $event->post);
        }
    }

    private function sendMail($sender, $recipient, $post)
    {
        SendReviewEmail::dispatch($sender, $recipient, $post)->onQueue('mail');
    }
}
