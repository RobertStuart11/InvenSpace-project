<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

    Route::post('/peminjaman', [LoanController::class, 'store'])
        ->middleware('role:siswa')->name('loans.store');
    Route::post('/peminjaman/{loan}/setujui', [LoanController::class, 'approve'])
        ->middleware('role:guru')->name('loans.approve');
    Route::post('/peminjaman/{loan}/tolak', [LoanController::class, 'reject'])
        ->middleware('role:guru')->name('loans.reject');
    Route::post('/peminjaman/{loan}/serahkan', [LoanController::class, 'handover'])
        ->middleware('role:admin')->name('loans.handover');
    Route::post('/peminjaman/{loan}/kembalikan', [LoanController::class, 'receiveReturn'])
        ->middleware('role:admin')->name('loans.return');
});

require __DIR__.'/preview.php';