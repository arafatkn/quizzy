<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\QuizStoreRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->setView('quizzes');
        parent::__construct();
        $this->breadcrumbs[] = ['name' => 'Quizzes', 'url' => route('user.quizzes.index')];
    }

    /**
     * All available quiz list.
     */
    public function index(Request $request)
    {
        $this->header();

        $quizzes = Quiz::exceptAuthor($this->user->id)->public()->with(['author']);

        if ($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        if ($request->has('author_id')) {
            $quizzes = $quizzes->ofAuthor($request->author_id);
        }

        $this->data['quizzes'] = $quizzes->latest()->paginate();

        return $this->view('index');
    }

    /**
     * Show a quiz details.
     *
     * @param Quiz  $quiz
     */
    public function show(Quiz $quiz)
    {
        if (auth()->user()->id != $quiz->author_id) {
            abort(404);
        }

        $this->header();
        $this->breadcrumbs[] = ['name' => 'My Quizzes', 'url' => route('user.my_quizzes')];
        $this->breadcrumbs[] = ['name' => 'Details', 'url' => ''];

        $this->data['quiz'] = $quiz;
        $this->data['questions'] = $quiz->questions()->paginate();

        return $this->view('show');
    }

    /**
     * Quizzes created by current logged-in users.
     */
    public function myQuizzes(Request $request)
    {
        $this->header();
        $this->breadcrumbs[] = ['name' => 'My Quizzes', 'url' => ''];

        $quizzes = Quiz::ofAuthor($this->user->id);

        if ($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        $this->data['quizzes'] = $quizzes->withCount(['questions', 'attempts'])->latest()->paginate();

        return $this->view('my_quizzes');
    }

    /**
     * Add New Quiz Page
     */
    public function create()
    {
        $this->header();
        $this->breadcrumbs[] = ['name' => 'My Quizzes', 'url' => route('user.my_quizzes')];
        $this->breadcrumbs[] = ['name' => 'Create', 'url' => ''];

        return $this->view('create');
    }

    /**
     * Store quiz in database.
     *
     * @param QuizStoreRequest $request
     */
    public function store(QuizStoreRequest $request)
    {
        $quiz = new Quiz();

        $quiz->fill($request->only([
            'name', 'status', 'time_limit', 'total_marks', 'total_questions', 'author_digest',
        ]));
        $quiz->author_digest = $request->has('author_digest');
        $quiz->author_id = auth()->user()->id;

        if ($quiz->save()) {
            return redirect()->route('user.quizzes.show',
                $quiz->id)->withSuccess('Quiz has been created successfully. Add Questions now.');
        }

        return back()->withErrors('Something is wrong here... Please try again later.');
    }

    /**
     * Edit Quiz Page.
     *
     * @param  Quiz  $quiz
     */
    public function edit(Quiz $quiz)
    {
        if (auth()->user()->id != $quiz->author_id) {
            abort(404);
        }

        $this->header();
        $this->breadcrumbs[] = ['name' => 'My Quizzes', 'url' => route('user.my_quizzes')];
        $this->breadcrumbs[] = ['name' => 'Edit', 'url' => ''];

        $this->data['quiz'] = $quiz;

        return $this->view('edit');
    }

    /**
     * Update quiz in database.
     *
     * @param Quiz  $quiz
     * @param QuizStoreRequest $request
     */
    public function update(Quiz $quiz, QuizStoreRequest $request)
    {
        if (auth()->user()->id != $quiz->author_id) {
            abort(404);
        }

        $quiz->fill($request->only(['name', 'status', 'time_limit', 'total_marks', 'total_questions']));
        $quiz->author_digest = $request->has('author_digest');

        if ($quiz->save()) {
            return back()->withSuccess('Quiz has been updated successfully.');
        }

        return back()->withErrors('Something is wrong here... Please try again later.');
    }

    /**
     * Delete Quiz from Database.
     *
     * @param Quiz  $quiz
     */
    public function destroy(Quiz $quiz)
    {
        // Delete Quiz and It's questions & attempts
        if ($quiz->delete()) {
            return redirect()->route('user.my_quizzes')->withSuccess('Quiz has been deleted successfully.');
        }

        return back()->withErrors('Something is wrong here... Please try again later.');
    }

    /**
     * List attempts of a quiz owned by logged in author/user.
     *
     * @param Quiz  $quiz
     */
    public function attempts(Quiz $quiz)
    {
        if (auth()->user()->id != $quiz->author_id) {
            abort(404);
        }

        $this->header();
        $this->breadcrumbs[] = ['name' => 'My Quizzes', 'url' => route('user.my_quizzes')];
        $this->breadcrumbs[] = ['name' => 'Details', 'url' => route('user.quizzes.show', $quiz->id)];
        $this->breadcrumbs[] = ['name' => 'Attempts', 'url' => ''];

        $this->data['quiz'] = $quiz;
        $this->data['attempts'] = $quiz->attempts()->latest()->paginate();

        return $this->view('attempts');
    }
}
