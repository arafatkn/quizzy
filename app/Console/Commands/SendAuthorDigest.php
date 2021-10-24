<?php

namespace App\Console\Commands;

use App\Mail\AuthorDigestMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendAuthorDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:author-digest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Digest Email to Quiz Authors who have enabled this feature.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereHas('quizzes', function ($query) {
            $query->where('author_digest', 1);
        })->get();

        foreach ($users as $user) {
            // ProcessAuthorDigest::dispatch($user);
            Mail::to($user->email)
                ->send(new AuthorDigestMail($user));
        }

        return Command::SUCCESS;
    }
}
