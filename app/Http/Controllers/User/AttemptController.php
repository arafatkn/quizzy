<?php

namespace App\Http\Controllers\User;

use App\Models\Attempt;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    function __construct()
    {
        $this->setView('attempts');
        parent::__construct();
        $this->breadcrumbs[] = ['name' => 'Quizzes', 'url' => route('user.quizzes.index')];
        $this->breadcrumbs[] = ['name' => 'Attempts', 'url' => route('user.attempts.index')];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Running Quiz
     *
     * @param Attempt $attempt
     */
    public function running(Attempt $attempt)
    {
        if ($attempt->started_at->addSeconds($attempt->quiz->time_limit) < now()) {
            return redirect()->route('user.attempts.update', $attempt->id);
        }

        $this->header();

        if ($this->user->id != $attempt->user_id) {
            return redirect()->route('user.quizzes.index')->withErrors('Please start again.');
        }

        $this->data['attempt'] = $attempt;
        $this->data['quiz'] = $attempt->quiz;
        $this->data['questions'] = $attempt->quiz->questions()->whereIn('id', array_keys(get_object_vars($attempt->answers)))->get();

        return $this->view('running');
    }

    /**
     * Start Quiz Now
     *
     * @param  Quiz  $quiz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function startQuiz(Quiz $quiz)
    {
        $user = auth()->user();

        if ($user->id == $quiz->author_id) {
            return redirect()
                ->route('user.quizzes.show', $quiz->id)
                ->withErrors('You can not participate on your own quiz.');
        }

        $attempt = $user->attempts()->whereNull('submitted_at')->first();

        if ($attempt) {
            return redirect()
                ->route('user.attempts.running', $attempt->id)
                ->withErrors('You can not start until completing previous attempt.');
        }

        $answers = $quiz->questions()
            ->inRandomOrder()
            ->take($quiz->total_questions)
            ->get(['id'])
            ->mapWithKeys(function ($item) {
                return [$item->id => null];
            })
            ->toArray();

        $attempt = $user->attempts()->create([
            'quiz_id' => $quiz->id,
            'answers' => $answers,
        ]);

        return redirect()
            ->route('user.attempts.running', $attempt->id)
            ->withErrors('You can not start until completing previous attempt.');
    }
}
