<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Doctors
    Route::resource('doctors', DoctorController::class);

    // Patients
    Route::resource('patients', PatientController::class);

    // Appointments
    Route::resource('appointments', AppointmentController::class);

    // Schedules
    Route::resource('schedules', ScheduleController::class)->except(['show']);

    // Departments
    Route::resource('departments', DepartmentController::class)->except(['create', 'show', 'edit']);

    // Employees
    Route::resource('employees', EmployeeController::class);

    // Accounts
    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::get('/invoices', [AccountController::class, 'invoices'])->name('invoices');
        Route::post('/invoices', [AccountController::class, 'storeInvoice'])->name('invoices.store');

        Route::get('/payments', [AccountController::class, 'payments'])->name('payments');
        Route::post('/payments', [AccountController::class, 'storePayment'])->name('payments.store');

        Route::get('/expenses', [AccountController::class, 'expenses'])->name('expenses');
        Route::post('/expenses', [AccountController::class, 'storeExpense'])->name('expenses.store');
    });
});
