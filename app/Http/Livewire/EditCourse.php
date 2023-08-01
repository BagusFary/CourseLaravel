<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditCourse extends Component
{
    public $title;
    public $description;
    public $price;
    public $video;
    public $thumbnail;
    public $tags;

    public function mount($dataCourse)
    {
        $this->title = $dataCourse->title;
        $this->description = $dataCourse->description;
        $this->price = $dataCourse->price;
        $this->thumbnail = $dataCourse->thumbnail;
        $this->video = $dataCourse->video;
        $this->tags = $dataCourse->tags;
        
    }
    public function render()
    {
        return view('livewire.edit-course');
    }
}
