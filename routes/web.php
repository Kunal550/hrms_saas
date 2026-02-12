<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function(){

    // Dashboard
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard'); 

    Route::resource('employees', EmployeeController::class); 

    Route::get('attendance', [AttendanceController::class,'index'])->name('attendance.index');
    Route::post('attendance/clock-in', [AttendanceController::class,'clockIn'])->name('attendance.clockIn');
    Route::post('attendance/clock-out', [AttendanceController::class,'clockOut'])->name('attendance.clockOut');

    Route::resource('leaves', LeaveController::class)->only(['index','store']);
    Route::post('leaves/{leave}/approve',[LeaveController::class,'approve'])->name('leaves.approve');
    Route::post('leaves/{leave}/reject',[LeaveController::class,'reject'])->name('leaves.reject');
});

