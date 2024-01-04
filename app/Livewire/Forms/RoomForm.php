<?php

namespace App\Livewire\Forms;

use App\Models\Room;
use App\Models\User;
use Livewire\Component;
use App\Models\Assigned;
use Livewire\Attributes\On;

class RoomForm extends Component
{
    public $name;
    public $capacity;
    public $assigned_rooms = [];
    public $msg;

    public function save() {
        $validatedData = $this->validate([
            'name' => ['required', 'string'],
            'capacity' => ['required', 'numeric'],
            'assigned_rooms' => ['required']
        ]);  

        // Filter the assigned_rooms array to keep only items with a value of true
        $selectedEmployees = collect($this->assigned_rooms)
        ->filter(function ($value) {
            return $value === true;
        })
        ->keys()
        ->toArray();

        try {
            $room = Room::create([
                'name' => $this->name,
                'capacity' => $this->capacity,
            ]);
    
            $assignedData = collect($selectedEmployees)->map(function ($id) use ($room) {
                return [
                    'room_id' => $room->id,
                    'employee_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray(); 
    
            Assigned::insert($assignedData);
            
            $this->reset();
            session()->flash('msg', 'Room created with employees assigned.');  
            $this->dispatch('rooms-table');
        } catch (\Exception $err) {
            $this->addError('msg', $err->getMessage());   
        }
    }

    #[On('room-form')]
    public function render()
    {
        return view('livewire.forms.room-form', [
            'users' => User::all()
        ]);
    }
}
