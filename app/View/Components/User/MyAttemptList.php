<?php

namespace App\View\Components\User;

use Illuminate\View\Component;

class MyAttemptList extends Component
{
    public $attempts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attempts)
    {
        $this->attempts = $attempts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.my-attempt-list');
    }
}
