<?php

namespace App\Jobs;

use App\Mail\AuthorDigestMail;
use App\Models\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessAuthorDigest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Quiz
     */
    private $quiz;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send email
        Mail::to($this->quiz->author->email)
            ->send(new AuthorDigestMail($this->quiz, $this->quiz->attempts));
    }
}
