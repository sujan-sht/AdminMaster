<?php

namespace SujanSht\LaraAdmin\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class AddEditButton extends Component
{
    public $model;
    public $name;
    /**
     * Create a new component instance.
     */
    public function __construct($model,$name)
    {
        $this->model = $model;
        $this->name = Str::ucfirst($name);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-edit-button');
    }
}
