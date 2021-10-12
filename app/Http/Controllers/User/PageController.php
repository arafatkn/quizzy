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
        $this->header();

        $this->data['quizzes'] = Quiz::public()->latest()->take(20)->get();

        return $this->view('index');
    }
}
