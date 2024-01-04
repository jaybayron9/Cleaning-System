<?php

use App\Livewire\Pages\Login;
use App\Livewire\Pages\Welcome;
use App\Livewire\Pages\Employee;
use App\Livewire\Pages\ViewEmployee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PHPMailer\Mailer;

Route::get('/', Welcome::class)->name('welcome');
Route::get('/login', Login::class)->name('login');
Route::get('/view/employee/{id}', ViewEmployee::class)->name('view.employee');
Route::get('/download/image/{image}', [ViewEmployee::class, 'downloadImage'])->name('download.image');
Route::get('/employee', Employee::class)->name('employee')->middleware(['auth']);
Route::get('/logout', [Employee::class, 'logout'])->name('logout');
Route::get('/test/config/{room}/{status}', [Mailer::class, 'assignedRoomStatusTemplate']);