<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Home Page.
     */
    public function index(Request $request)
    {
        $this->header();

        $quizzes = Quiz::public()->with(['author']);

        if ($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        if ($request->has('author_id')) {
            $quizzes = $quizzes->ofAuthor($request->author_id);
        }

        if ($this->user) {
            $quizzes = $quizzes->exceptAuthor($this->user->id);
        }

        $this->data['quizzes'] = $quizzes->latest()->paginate();

        return $this->view('index');
    }
}
