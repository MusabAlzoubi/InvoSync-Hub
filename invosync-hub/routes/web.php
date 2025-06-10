<?php

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



Route::prefix('admin')->middleware(['auth', 'role:Admin|Super Admin'])->group(function () {
    Route::resource('companies', \App\Http\Controllers\Admin\CompanyController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class);
    Route::resource('audit-logs', \App\Http\Controllers\Admin\AuditLogController::class);
});

Route::prefix('accountant')->middleware(['auth', 'role:Accountant|Admin'])->group(function () {
    Route::resource('invoices', \App\Http\Controllers\Accountant\InvoiceController::class);
    Route::resource('customers', \App\Http\Controllers\Accountant\CustomerController::class);
    Route::resource('suppliers', \App\Http\Controllers\Accountant\SupplierController::class);
    Route::resource('payments', \App\Http\Controllers\Accountant\PaymentController::class);
    Route::resource('expenses', \App\Http\Controllers\Accountant\ExpenseController::class);
    Route::resource('bank-accounts', \App\Http\Controllers\Accountant\BankAccountController::class);
});

Route::prefix('sales')->middleware(['auth', 'role:Sales'])->group(function () {
    Route::resource('quick-invoices', \App\Http\Controllers\Accountant\InvoiceController::class)->only(['create', 'store', 'index']);
});

Route::prefix('viewer')->middleware(['auth', 'role:Viewer|Auditor'])->group(function () {
    Route::get('reports', [\App\Http\Controllers\Shared\ReportController::class, 'index']);
    Route::get('invoices', [\App\Http\Controllers\Accountant\InvoiceController::class, 'index']);
});
