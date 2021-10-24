<?php

namespace App\Http\Controllers\User;

use App\Models\Attempt;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AttemptController extends Controller
{
    public function __construct()
    {
        $this->setView('attempts');
        parent::__construct();
        $this->breadcrumbs[] = ['name' => 'Quizzes', 'url' => route('user.quizzes.index')];
        $this->breadcrumbs[] = ['name' => 'Attempts', 'url' => route('user.attempts.index')];
    }

    /**
     * Display a listing of user's attempts.
     */
    public function index()
    {
        $this->header();

        $this->data['attempts'] = $this->user->attempts()->with(['quiz'])->paginate();

        return $this->view('index');
    }

    /**
     * Display a single attempt.
     *
     * @param  Attempt  $attempt
     */
    public function show(Attempt $attempt)
    {
        $this->header();

        if ($this->user->id != $attempt->user_id) {
            return redirect()->route('user.quizzes.start', $attempt->quiz_id)->withErrors('Please start again.');
        }

        if (! $attempt->examined_at) {
            $attempt->examine();
        }

        $this->data['attempt'] = $attempt;
        $this->data['quiz'] = $attempt->quiz;
        $this->data['questions'] = $attempt->questions;
        $this->breadcrumbs[] = ['name' => 'Details', 'url' => route('user.attempts.show', $attempt->id)];

        return $this->view('show');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Attempt  $attempt
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Attempt $attempt)
    {
        $user = auth()->user();

        if ($user->id != $attempt->user_id) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        if ($attempt->submitted_at) {
            return response()->json([
                'message' => 'Already submitted. Redirecting to result page...',
                'redirect' => route('user.attempts.show', $attempt->id),
            ]);
        }

        if ($request->has('answers')) {
            $answers = $attempt->answers;
            foreach ($attempt->answers as $qid => $answer) {
                if (isset($request->answers[$qid])) {
                    $answers->{$qid} = $request->answers[$qid];
                }
            }
            $attempt->answers = $answers;
        }

        if ($request->get('submit', false) || $attempt->time_remaining <= 0) {
            $attempt->submitted_at = now();
        }

        if ($attempt->save()) {
            if ($attempt->submitted_at) {
                return response()->json([
                    'message' => 'Answers have been submitted successfully. Redirecting to result page...',
                    'redirect' => route('user.attempts.show', $attempt->id),
                ]);
            }

            return response()->json(['message' => 'Progress saved successfully.'], 202);
        }

        return response()->json(['message' => 'Unable to submit answers. Please click again...'], 501);
    }

    /**
     * Running Quiz.
     *
     * @param  Attempt  $attempt
     */
    public function running(Attempt $attempt)
    {
        //if ($attempt->started_at->addSeconds($attempt->quiz->time_limit) < now()) {
        //$attempt->submitted_at = now();
        //return redirect()->route('user.attempts.show', $attempt->id);
        //}

        $this->header();

        if ($this->user->id != $attempt->user_id) {
            return redirect()->route('user.quizzes.index')->withErrors('Please start again.');
        }

        $this->data['attempt'] = $attempt;
        $this->data['quiz'] = $attempt->quiz;
        $this->data['questions'] = $attempt->quiz->questions()->whereIn('id',
            array_keys(get_object_vars($attempt->answers)))->get();

        return $this->view('running');
    }

    /**
     * Start attempting new Quiz
     * Route = /user/quizzes/{quiz}/start.
     */
    public function start(Quiz $quiz)
    {
        $this->header();

        if ($quiz->author_id == $this->user->id) {
            return redirect()
                ->route('user.quizzes.show', $quiz->id)
                ->withErrors('You can not participate on your own quiz.');
        }

        $this->breadcrumbs[] = ['name' => 'Start Test', 'url' => ''];

        $this->data['quiz'] = $quiz;

        return $this->view('start');
    }

    /**
     * Start Quiz Now.
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
            ->route('user.attempts.running', $attempt->id);
    }
}
