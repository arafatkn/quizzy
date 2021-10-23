<?php

namespace App\Http\Controllers\User;

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

        $this->data['quizzes'] = Quiz::exceptAuthor($this->user->id)->public()->with('author')->latest()->take(5)->get();
        $this->data['my_quizzes'] = $this->user->quizzes()->withCount(['questions', 'attempts'])->latest()->take(7)->get();

        return $this->view('index');
    }
}
