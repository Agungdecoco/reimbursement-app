<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\EmployeeController;

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

Route::middleware(['checkRole:STAFF'])->group(function () {
    Route::get('/home-staff', [HomeController::class, 'indexStaff'])->name('staff.home');
    Route::get('/form_reimbursement', [ReimbursementController::class, 'create'])->name('staff.create');
    Route::post('/form_reimbursement', [ReimbursementController::class, 'store'])->name('staff.store');
});

Route::middleware(['checkRole:FINANCE'])->group(function () {
    Route::get('/home-finance', [HomeController::class, 'indexFinance'])->name('finance.home');
});

Route::middleware(['checkRole:DIREKTUR'])->group(function () {
    Route::get('/home-director', [HomeController::class, 'indexDirector'])->name('director.home');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    Route::get('/add_employee', [EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/add_employee', [EmployeeController::class, 'store'])->name('employee.store');

    Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');

    Route::get('/employee/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/{id}', [EmployeeController::class, 'update'])->name('employee.update');
});

Route::middleware(['checkRole:FINANCE,DIREKTUR'])->group(function () {
    Route::post('/home-update/{id}', [ReimbursementController::class, 'update'])->name('submission.update');
});

Route::get('/download/{filename}', [ReimbursementController::class, 'download'])->name('download.document');

Route::get('/', [LoginController::class, 'index'])->name('root-login');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticated'])->name('login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
