<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("auth");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [BookController::class, "showBooks"]);
    Route::get('/book/{book}', [BookController::class, "bookDetails"]);
});

require __DIR__ . '/auth.php';
