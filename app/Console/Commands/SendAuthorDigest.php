<?php

namespace App\Console\Commands;

use App\Jobs\ProcessAuthorDigest;
use App\Models\Quiz;
use Illuminate\Console\Command;

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
        $quizzes = Quiz::where('author_digest', 1)->get();

        foreach ($quizzes as $quiz) {
            ProcessAuthorDigest::dispatch($quiz);
        }

        return Command::SUCCESS;
    }
}
