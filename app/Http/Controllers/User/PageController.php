<?php

namespace App\Http\Controllers\User;

use App\Models\Quiz;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Home Page
     */
    public function index(Request $request)
    {
        return dd(auth()->user());

        $quizzes = Quiz::public();

        if($request->has('search')) {
            $quizzes = $quizzes->searchBy($request->search);
        }

        $this->data['quizzes'] = $quizzes->latest()->paginate();

        return $this->view('index');
    }
}
