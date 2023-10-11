<?php

namespace SujanSht\AdminMaster\Http\Livewire\Admin\Media;

use Livewire\Component;

class SpartanImageUpload extends Component
{
    public $imageName;
    public $divClass="row";
    public $class;
    public $divId;
    public $multiple=false;
    public $height='200px';
    public $imageCount=10;
    public $model;

    public function render()
    {
        return view('admin-master::livewire.admin.media.spartan-image-upload');
    }
}
