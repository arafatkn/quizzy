<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormModal extends Component
{
    public $id;
    public $title;
    public $formId;
    public $method;
    public $action;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $formId = '', $method = 'GET', $action = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->formId = $formId;
        $this->method = $method;
        $this->action = $action;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-modal');
    }
}
