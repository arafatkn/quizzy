<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\QuizStoreRequest;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    function __construct()
    {
        $this->setView('quizzes');
        parent::__construct();
    }

    /**
     * All available quiz list.
     * Route = /user/quizzes
     */
    public function index(Request $request)
    {
        $this->header();

        $quizzes = Quiz::public()->with(['author']);

        if($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        if($request->has('author_id')) {
            $quizzes = $quizzes->ofAuthor($request->author_id);
        }

        $this->data['quizzes'] = $quizzes->latest()->paginate();

        return $this->view('index');
    }

    /**
     * Quizzes created by current logged-in users.
     * Route = /user/my-quizzes
     */
    public function myQuizzes(Request $request)
    {
        $this->header();

        $quizzes = Quiz::ofAuthor($this->user->id);

        if($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        $this->data['quizzes'] = $quizzes->latest()->paginate();

        return $this->view('my_quizzes');
    }

    /**
     * Add New Quiz Page
     * Route = /user/quizzes/create
     */
    public function create()
    {
        $this->header();

        return $this->view('create');
    }

    /**
     * Store quiz in database.
     * Route = /user
     * Method = POST
     */
    public function store(QuizStoreRequest $request)
    {
        

    }
}
