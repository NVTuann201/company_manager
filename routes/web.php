<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function() {
    Route::prefix('/companies')->name('companies.')->group(function() {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/add', [CompanyController::class, 'add'])->name('add');
        Route::post('/add', [CompanyController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('edit');
        Route::post('/update', [CompanyController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [CompanyController::class, 'destroy'])->name('delete');
    });
});
