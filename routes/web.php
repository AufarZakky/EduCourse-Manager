<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TransactionController;
use App\Exports\CoursesExport;
use Maatwebsite\Excel\Facades\Excel;

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

    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/dashboard', [CourseController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [CourseController::class, 'getCourses'])->name('dashboard.data');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');

    Route::post('/courses/import', [CourseController::class, 'import'])->name('courses.import');
    // Route::get('/courses/export', [CourseController::class, 'export'])->name('courses.export');
    Route::get('/courses/export', function () {
        return Excel::download(new CoursesExport, 'courses.xlsx');
    })->name('courses.export');
    Route::get('/courses/print-pdf', [CourseController::class, 'printPDF'])->name('courses.print-pdf');
    
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaction', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/data', [TransactionController::class, 'getData'])->name('transactions.data');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('/transactions/{id}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::put('/transactions/{id}', [TransactionController::class, 'update'])->name('transactions.update');

});

require __DIR__.'/auth.php';
