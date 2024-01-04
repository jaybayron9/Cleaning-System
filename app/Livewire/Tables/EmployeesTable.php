<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class EmployeesTable extends Component
{
    public function viewImages($id) {
        return $this->redirect('/view/employee/' . $id , navigate: true);
    }

    #[On('employees-table')]
    public function render()
    {
        return view('livewire.tables.employees-table', [
            'users' => User::all()
        ]);
    }
}
