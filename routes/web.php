<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('home');
});

Route::get('/products', [FormController::class, 'products']);
Route::post('/submit', [FormController::class, 'submit']);

Route::get('/edit', [FormController::class, 'edit']);
Route::post('/edit', [FormController::class, 'submit_edit']);