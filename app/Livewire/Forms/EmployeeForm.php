<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;

class EmployeeForm extends Component
{
    public $name;
    public $email;
    public $cp;
    public $dob;
    public $msg;

    public function save() {
        $validatedData = $this->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'], 
            'cp' => ['required', 'numeric'],
            'dob' => ['required', 'date']
        ]);

        $validatedData['password'] = Hash::make($this->dob);

        try {
            User::create($validatedData);
            session()->flash('msg', 'Employee created.'); 
        } catch (\Exception $err) {
            $this->addError('success', $err->getMessage());   
        }

        $this->reset();
        $this->dispatch('employees-table');
        $this->dispatch('room-form');
    }

    #[Title('Cleasing System')]
    public function render()
    {
        return view('livewire.forms.employee-form');
    }
}
