<?php

namespace App\Mail;

use App\Models\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorDigestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quiz;

    public $attempts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz, $attempts)
    {
        $this->quiz = $quiz;
        $this->attempts = $attempts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Daily Digest for {$this->quiz->name}")
            ->markdown('emails.author_digest');
    }
}
