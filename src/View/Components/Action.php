<?php

namespace SujanSht\LaraAdmin\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    public $model;
    public $route;
    public $show;
    public $edit;
    public $delete;
    /**
     * Create a new component instance.
     */
    public function __construct($model, $route, $show = true, $edit = true, $delete = true,)
    {
        $this->model = $model;
        $this->route = $route;
        $this->show = $show;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action');
    }
}
