<?php

namespace SujanSht\LaraAdmin\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class EditPage extends Component
{
    public $name;
    public $route;
    public $model;
    public $formclass;
    public $formid;
    /**
     * Create a new component instance.
     */
    public function __construct($name,$route,$model,$formclass=null,$formid=null)
    {
        $this->name = Str::ucfirst($name);
        $this->route = $route;
        $this->model = $model;
        $this->formclass = $formclass;
        $this->formid = $formid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-page');
    }
}
