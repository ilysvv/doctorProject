<?php

use App\Http\Controllers\DoctorController;

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');

use App\Http\Controllers\AppointmentController;

Route::get('/my-appointments', [AppointmentController::class, 'index'])->name('appointments.index');

Route::middleware(['auth'])->group(function () {
    // صفحة الحجز (بتاخد الـ ID بتاع الدكتور)
    Route::get('/appointments/create/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorIndex'])
        ->name('doctor.appointments');

    Route::get('/doctor/profile', [DoctorController::class, 'edit'])
        ->name('doctor.profile.edit');
    // حفظ الحجز في الداتا بيز
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])
        ->name('appointments.updateStatus');
    Route::get('/doctor/profile', [DoctorController::class, 'edit'])->name('doctor.profile.edit');
    Route::put('/doctor/profile', [DoctorController::class, 'update'])->name('doctor.profile.update');
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorIndex'])->name('doctor.appointments');
});

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';
