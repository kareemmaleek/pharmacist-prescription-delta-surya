<?php

use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\UserController;
use App\Services\ExternalApiAuth;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'indexDashboard'])->name('dashboard');

    Route::prefix('patient')->group(function(){
        Route::get('/', [PatientController::class, 'indexPatient'])->name('patient');
        Route::get('/new-patient', [PatientController::class, 'indexNewPatient'])->name('new_patient');
        Route::post('/new-patient', [PatientController::class, 'proceedNewPatient'])->name('create_new_patient');
    });

    Route::prefix('examination')->group(function () {
        Route::get('/', [ExaminationController::class, 'indexExamination'])->name('examination');
        Route::get('/new', [ExaminationController::class, 'indexNewExamination'])->name('new_exam');
        Route::post('/new', [ExaminationController::class, 'createNewExamination'])->name('create_new_exam');
    });
});



Route::prefix('access')->group(function () {
    Route::get('/', [UserController::class, 'indexAccess'])->name('login');
    Route::post('/', [UserController::class, 'proceedLogin']);
    Route::post('/logout', [UserController::class, 'proceedLogout'])->name('proceed_logout');
});


