<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);

 


Route::get('/standard', function () {
    return view('standard');
});

