<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FrontLayout extends Component
{

    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        // لو الصفحه ملهاش عنوان حط اس البرنامج الي في الكونفيج
        $this->title = $title ?? config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.front');
    }
}
