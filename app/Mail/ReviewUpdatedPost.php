<?php

namespace App\Mail;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewUpdatedPost extends Mailable
{
    public $sender;
    public $recipient;
    public $post;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender, User $recipient, Post $post)
    {
        //
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A post was updated.')->markdown('emails.posts.review-updated-post');
    }
}
