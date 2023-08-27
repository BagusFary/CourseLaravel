<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ListOrderAdmin extends Component
{
    public $search = '';
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public function render()
    {
        sleep(1.5);
        $dataOrder = Order::with(['user:id,name','course:id,title'])
                            ->paginate(3);
        return view('livewire.list-order-admin',['dataOrder' => $dataOrder]);
    }
}
