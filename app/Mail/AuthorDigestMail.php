<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorDigestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     * @throws \Exception
     */
    public function build()
    {
        $quizzes = $this->user->quizzes()
            ->where('author_digest', 1)
            ->with('attempts', function ($query) {
                $query->whereDate('submitted_at', today()->subDay())
                    ->groupByRaw('quiz_id, user_id')
                    ->with('user')
                    ->selectRaw("`quiz_id`, `user_id`, COUNT(`user_id`) as attempts_count, MAX(`marks`) as `max_marks`, MIN(`marks`) as min_marks, AVG(`marks`) as avg_marks");
            })
            ->get();

        if (empty($quizzes)) {
            throw new \Exception();
        }

        return $this->subject('Daily Digest from '.config('app.name'))
            ->markdown('emails.author_digest', [
                'quizzes' => $quizzes,
            ]);
    }
}
