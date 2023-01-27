<?php

use App\Models\Professor;
use App\Models\Room;
use App\Models\Subject;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $roomCount = Room::count();
        $profCount = Professor::count();
        $subjectCount = Subject::count();
        return view('dashboard', compact('roomCount', 'profCount', 'subjectCount'));
    })->name('dashboard');

    Route::get('/schedules', \App\Http\Livewire\Schedules::class)->name('schedules');

    Route::get('/rooms', \App\Http\Livewire\Rooms::class)->name('rooms');
    Route::get('/rooms/{room}', \App\Http\Livewire\RoomShow::class)->name('rooms.show');

    Route::get('/professors', \App\Http\Livewire\Professors::class)->name('professors');
    Route::get('/subjects', \App\Http\Livewire\Subjects::class)->name('subjects');
});
