<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Employee extends Component
{
    public function mount() {
        if (!Auth::check()) {
            return redirect('login', true);
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('login'); 
    }
    public function render()
    {
        return view('livewire.pages.employee');
    }
}
