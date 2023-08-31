<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCourse extends Component
{
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    
    protected $queryString = ['search'];
    
    use WithPagination;

    public function render()
    {
        sleep(1.8);
        $dataCourse = Course::with('tags:id,name_tags')
                            ->where('title', 'LIKE', '%'.$this->search.'%')
                            ->orWhereHas('tags', function($query){
                                $query->where('name_tags', 'LIKE', '%'.$this->search.'%');
                            })
                            ->paginate(3);

        return view('livewire.index-course', ['dataCourse' => $dataCourse]);
    }
}
