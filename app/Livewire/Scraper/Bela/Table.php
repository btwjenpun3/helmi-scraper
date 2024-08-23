<?php

namespace App\Livewire\Scraper\Bela;

use App\Models\Bela;
use Livewire\WithPagination;
use Livewire\Component;

class Table extends Component
{
    use WithPagination;
    
    public function render()
    {
        $data = Bela::paginate(25);

        return view('livewire.scraper.bela.table', [
            'data' => $data
        ]);
    }
}
