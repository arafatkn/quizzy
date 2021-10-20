<?php

namespace App\View\Components\User;

use App\Models\Quiz;
use Illuminate\View\Component;

class MyQuizList extends Component
{
    /**
     * My Quizzes.
     */
    public $quizzes = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($quizzes)
    {
        $this->quizzes = $quizzes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.my-quiz-list');
    }
}
