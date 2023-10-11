<?php

namespace SujanSht\AdminMaster\Http\Livewire\Admin\Media;

use Livewire\Component;

class VideoLink extends Component
{
    public $videos = [];
    public $model;

    public function mount($model = null)
    {
        $this->model = $model;
        if(!is_null($model)){
            $this->videos = $model->videos()->pluck('url');
        }
    }

    public function addVideos()
    {
        $videos = $this->videos;
        $videos[] = null;
        $this->videos = $videos;
    }

    public function removeVideo($index)
    {
        $videos = $this->videos;
        unset($videos[$index]);
        $this->videos = $videos;
    }

    public function removeAllVideo()
    {
        $this->videos = null;
    }

    public function render()
    {
        return view('admin-master::livewire.admin.media.video-link');
    }

}
