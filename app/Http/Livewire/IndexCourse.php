<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCourse extends Component
{
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function render()
    {
        sleep(2);
        $dataCourse = Course::with('tags:id,name_tags')
                            ->where('title', 'LIKE', '%'.$this->search.'%')
                            ->orWhereHas('tags', function($query){
                                $query->where('name_tags', 'LIKE', '%'.$this->search.'%');
                            })
                            ->paginate(3);

        return view('livewire.index-course', ['dataCourse' => $dataCourse]);
    }
}