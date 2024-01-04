<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Assigned;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithFileUploads; 
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class EmployeeRoomsTable extends Component
{
    use WithFileUploads;

    #[Validate(['images.*' => 'image|max:1024'])]
    public $images = [];
    public $assign_id;

    public function modalId($id) { 
        $this->assign_id = $id;
    }

    public function uploadImages() {
        $this->validate(); 

        $newNamedImages = '';
        foreach ($this->images as $image) {
            $replaceNewName =  Str::random(40) . '.' . $image->extension(); 
            $image->storeAs('photos', $replaceNewName, 'public');
            $newNamedImages .= $replaceNewName . '~';
        }  
        $newNamedImages = rtrim($newNamedImages, '~');

        Assigned::where('id', $this->assign_id)
            ->update([
                'images' => $newNamedImages
            ]);

        $this->addError('images', 'Images successfully uploaded.');   
    }

    public function render()
    {
        $assignedRooms = Assigned::leftJoin('rooms', 'assigneds.room_id', 'rooms.id')
            ->leftJoin('users', 'assigneds.employee_id', 'users.id')
            ->select(
                'assigneds.id as assign_id',
                'rooms.id as room_id', 
                'rooms.name as room_name', 
                'users.name as employee_name',
                'assigneds.created_at as room_created')
            ->where('users.id', Auth::user()->id)
            ->get(); 
        return view('livewire.tables.employee-rooms-table', [
            'assignedRooms' => $assignedRooms
        ]);
    }
}
