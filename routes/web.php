<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RestoreController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Account Management Routes
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::post('/accounts', [AccountController::class, 'store'])->name('accounts.store');
    Route::get('/accounts/{id}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
    Route::post('/accounts/{id}/update', [AccountController::class, 'update'])->name('accounts.update');
    Route::delete('/accounts/{id}/delete', [AccountController::class, 'destroy'])->name('accounts.delete');


    // Journal Entries Routes
    Route::get('/journal', [JournalEntryController::class, 'index'])->name('journal.index');
    Route::post('/journal', [JournalEntryController::class, 'store'])->name('journal.store');
    Route::get('/journal/{id}/edit', [JournalEntryController::class, 'edit'])->name('journal.edit');
    Route::post('/journal/{id}/update', [JournalEntryController::class, 'update'])->name('journal.update');
    Route::delete('/journal/{id}/delete', [JournalEntryController::class, 'destroy'])->name('journal.delete');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export/pdf', [ReportController::class, 'exportPDF'])->name('reports.export.pdf');
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

    // Backup & Restore
    Route::get('/restore', [RestoreController::class, 'index'])->name('restore.index');
    Route::post('/restore', [RestoreController::class, 'restore'])->name('restore.restore');

    Route::post('/backup', [BackupController::class, 'create'])->name('backup.create');
    Route::get('/backup/download/{file}', [BackupController::class, 'download'])->name('backup.download');
});

// User Profile Management (Default Breeze)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes (Handled by Laravel Breeze)
require __DIR__.'/auth.php';
