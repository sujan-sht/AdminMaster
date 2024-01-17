<?php

namespace SujanSht\AdminMaster\Http\Livewire\Admin\Media;

use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UploadImage extends Component
{
    public $model;

    public $attribute;

    public $multiple = false;

    public function mount($model = null, $attribute = 'image', $multiple = false)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->multiple = $multiple;
    }

    public function render()
    {
        return view('admin-master::livewire.admin.media.image-upload');
    }

    public function removeImage(Media $media, $collection = null)
    {
        $media->delete();
        $this->model = null;
    }
}
