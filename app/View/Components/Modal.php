<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title = '';
    public $id = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $id = '')
    {
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }

    public function getModalIdString(): string
    {
        if ($this->id != '') {
            return $this->id;
        }

        return "model" . rand(1111, 9999);
    }
}
