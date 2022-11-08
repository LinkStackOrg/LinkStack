<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Cohensive\OEmbed\Facades\OEmbed;


class PageItemDisplay extends Component
{
    public $link;
    public $id = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        // $this->title = $title;
         $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $params = json_decode($this->link->type_params);



        return view('components.pageitems.'.$this->link->typename.'-display', ['link' => $this->link, 'params' => $params]);
    }

    public function getModalIdString(): string
    {
        if ($this->id != '') {
            return $this->id;
        }

        return "model" . rand(1111, 9999);
    }
}
