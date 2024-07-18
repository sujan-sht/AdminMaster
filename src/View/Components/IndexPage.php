<?php

namespace SujanSht\AdminMaster\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class IndexPage extends Component
{
    public $name;
    public $plural_name;
    public $route;

    /**
     * Create a new component instance.
     */
    public function __construct($name,$route)
    {
        $this->name = Str::ucfirst($name);
        $this->plural_name = Str::plural($this->name);
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin-master::components.index-page');
    }
}
