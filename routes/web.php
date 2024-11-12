<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCsvController;


Route::get('/', [ProductController::class, 'index']);
Route::get('/productos/categoria/{categoria_id}', [ProductController::class, 'showByCategory'])->name('filament.resources.productos.index');

 


Route::get('/standard', function () {
    return view('standard');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);
});


Route::post('/import-csv', [ProductCsvController::class, 'importCsv'])->name('import.csv');
