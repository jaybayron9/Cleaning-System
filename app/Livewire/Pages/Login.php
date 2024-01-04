<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    public function mount() {
        if (Auth::check()) {
            return redirect('employee');
        }
    }

    public function proccessLogin() {
        $validatedData = $this->validate([
            'email' => ['email', 'required'],
            'password' => ['nullable']
        ]);

        if (isset($validatedData['password'])) { 
            if (Auth::attempt($validatedData))
                return redirect('employee', true); 

            $this->addError('invalid', 'Invalid email or password.'); 
        } else {
            $user = User::where('email', $this->email)->first(); 

            if ($user === null) {
                $this->addError('invalid', 'Email address not found.');   
                return;
            } 

            if (Auth::attempt([
                'email' => $validatedData['email'], 
                'password' => $user->dob
            ]))

            return redirect('employee', true);   
        } 
    }
    public function render()
    {
        return view('livewire.pages.login');
    }
}
