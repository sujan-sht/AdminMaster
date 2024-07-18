<?php

namespace SujanSht\AdminMaster\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public $imageName;
    public $class;
    public $id;
    public $multiple;
    public $height;
    public $imageCount;
    public $model;

    /**
     * Create a new component instance.
     */
    public function __construct($imageName,$class,$id,$model,$multiple=false,$height="200px",$imageCount=10)
    {
        $this->imageName=$imageName;
        $this->class=$class;
        $this->id=$id;
        $this->multiple=$multiple;
        $this->height = $height;
        $this->imageCount=$imageCount;
        $this->model = $model;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin-master::components.image-upload');
    }
}
