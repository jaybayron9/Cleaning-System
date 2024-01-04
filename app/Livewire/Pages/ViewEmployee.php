<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use App\Models\Assigned; 
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\PHPMailer\Mailer;

class ViewEmployee extends Component
{ 
    public $id; 

    public function mount() {
        $this->id = request()->id; 
    }

    public function downloadImage($imageName)
    { 
        $filepath = public_path('storage/photos/').$imageName;
        return Response::download($filepath);
    } 

    public function assignedTable($user_id, $assign_id = null, $first = false) {
        $ass = Assigned::leftJoin('rooms', 'assigneds.room_id', 'rooms.id')
            ->leftJoin('users', 'assigneds.employee_id', 'users.id')
            ->select(
                'users.id as user_id',
                'users.name as user_name',
                'users.email as user_email',
                'rooms.id as room_id',
                'rooms.name as room_name',
                'assigneds.id as assign_id',
                'assigneds.images as image',
                'assigneds.status as assign_status',
                'assigneds.created_at as room_created'
            )
            ->where('users.id', $user_id);

        if ($assign_id)
            $ass = $ass->where('assigneds.id', $assign_id); 

        if ($first) 
            return $ass->first();

        return $ass->get();
    }

    public function adminDecide($assign_id, $status) {
        Assigned::where('id', $assign_id)
            ->update([
                'status' => $status
            ]);
    }

    public function approve($assign_id, $user_id) { 
        $employee = $this->assignedTable($user_id, $assign_id, first: true); 

        $this->adminDecide($assign_id, 'approved');

        (new Mailer)->send(
            $employee->user_email,
            'Assign Room Status',
            (new Mailer)->assignedRoomStatusTemplate($employee->room_name, 'Approved')
        );  

        $this->dispatch('viewEmployee');
    } 

    public function reject($assign_id, $user_id) { 
        $employee = $this->assignedTable($user_id, $assign_id, first: true);

        $this->adminDecide($assign_id, 'rejected');

        (new Mailer)->send(
            $employee->user_email,
            'Assign Room Status',
            (new Mailer)->assignedRoomStatusTemplate($employee->room_name, 'Rejected')
        ); 

        $this->dispatch('viewEmployee');
    } 

    #[On('viewEmployee')]
    public function render()
    { 
        $employee = User::where('id', $this->id)->first();

        $employeeAssigned = function ($id) {
            return $this->assignedTable($id);
        };

        $roomImages = function($image) { 
            $images = explode('~', $image);
            return $images;
        }; 

        return view('livewire.pages.view-employee', [
            'employee' => $employee,
            'employeeAssigned' => $employeeAssigned,
            'roomImages' => $roomImages
        ]);
    }
}
