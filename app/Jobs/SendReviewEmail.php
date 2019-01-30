<?php

namespace App\Jobs;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\ReviewUpdatedPost;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReviewEmail implements ShouldQueue
{
    protected $sender;
    protected $recipient;
    protected $post;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $sender, User $recipient, Post $post)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->recipient->email)
            ->send(new ReviewUpdatedPost($this->sender, $this->recipient, $this->post));
    }
}
