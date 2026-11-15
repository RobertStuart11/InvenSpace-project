<?php

use App\Http\Controllers\PreviewController;
use Illuminate\Support\Facades\Route;

Route::get('/masuk', [PreviewController::class, 'login'])->name('preview.login');

Route::prefix('preview')->name('preview.')->group(function () {
    Route::get('/',                 [PreviewController::class, 'dashboard'])->name('dashboard');

    Route::get('/items',            [PreviewController::class, 'items'])->name('items');
    Route::get('/items/create',     [PreviewController::class, 'createItem'])->name('items.create');
    Route::get('/items/{id}/edit',  [PreviewController::class, 'editItem'])->name('items.edit');

    Route::get('/loans',            [PreviewController::class, 'loans'])->name('loans');
    Route::get('/loans/create',     [PreviewController::class, 'createLoan'])->name('loans.create');
    Route::get('/loans/{id}',       [PreviewController::class, 'showLoan'])->name('loans.show');

    Route::get('/complaints',        [PreviewController::class, 'complaints'])->name('complaints');
    Route::get('/complaints/create', [PreviewController::class, 'createComplaint'])->name('complaints.create');

    Route::get('/stock-mutations',  [PreviewController::class, 'stockMutations'])->name('stock-mutations');
    Route::get('/users',            [PreviewController::class, 'users'])->name('users');
});
