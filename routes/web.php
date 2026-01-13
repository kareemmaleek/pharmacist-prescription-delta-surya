<?php

use App\Http\Controllers\AuditLogsController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TransactionController;
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
        Route::get('/edit/{exam_id}', [ExaminationController::class, 'indexEditExamination'])->name('edit_exam');
        Route::post('/new', [ExaminationController::class, 'createNewExamination'])->name('create_new_exam');
        Route::put('/edit/{exam_id}', [ExaminationController::class, 'updateExamination'])->name('update_exam');
        Route::delete('/delete/{exam_id}', [ExaminationController::class, 'deleteExamination'])->name('delete_exam');
    });

    Route::prefix('transaction')->group(function() {
        Route::get('/', [TransactionController::class, 'indexTransaction'])->name('transaction');
        Route::get('/new/{exam_id}', [TransactionController::class, 'indexNewTransaction'])->name('new_transaction');
        Route::get('/receipt/{tx_code}', [TransactionController::class, 'indexReceipt'])->name('receipt');
        Route::get('/receipt/{tx_code}/download', [TransactionController::class, 'createReceipt'])->name('create_receipt');
        Route::post('/new/{exam_id}', [TransactionController::class, 'createNewTransaction'])->name('create_new_transaction');
    });

    Route::prefix('users')->group(function (){
        Route::get('/', [UserController::class, 'indexUser'])->name('users');
        Route::get('/new', [UserController::class, 'indexNewUser'])->name('users_new');
        Route::get('/edit/{uid}', [UserController::class, 'indexEditUser'])->name('users_edit');
        Route::post('/new', [UserController::class, 'createNewUser'])->name('create_new_users');
        Route::post('/status/change', [UserController::class, 'proceedChangeStatus'])->name('users_status_change');
        Route::put('/edit/{uid}', [UserController::class, 'updateUser'])->name('update_user');
    });

    Route::prefix('audit-logs')->group(function () {
        Route::get('/', [AuditLogsController::class, 'indexAuditLogs'])->name('audit_logs');
    });
});



Route::prefix('access')->group(function () {
    Route::get('/', [UserController::class, 'indexAccess'])->name('login');
    Route::post('/', [UserController::class, 'proceedLogin']);
    Route::post('/logout', [UserController::class, 'proceedLogout'])->name('proceed_logout');
});


