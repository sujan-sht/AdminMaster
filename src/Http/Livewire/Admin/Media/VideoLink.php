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
        if (!is_null($model)) {
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

        if (count($videos) > 1) {
            unset($videos[$index]);
            $this->videos = $videos;
        } else {
            $this->model->videos()->delete();
            $this->videos = null;
        }
    }


    public function removeAllVideo()
    {
        $this->model->videos()->delete();
        $this->videos = null;
    }

    public function render()
    {
        return view('admin-master::livewire.admin.media.video-link');
    }
}
