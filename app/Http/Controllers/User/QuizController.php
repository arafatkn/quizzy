<?php

namespace App\Http\Controllers\User;

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
}
