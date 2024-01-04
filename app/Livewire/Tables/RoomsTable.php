<?php

namespace App\Livewire\Tables;

use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\On;

class RoomsTable extends Component
{
    #[On('rooms-table')]
    public function render()
    {
        return view('livewire.tables.rooms-table', [
            'rooms' => Room::all()
        ]);
    }
}
