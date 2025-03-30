<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("auth");
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [BookController::class, "showBooks"]);
    Route::get('/book/{book}', [BookController::class, "bookDetails"]);
    Route::post('/borrow/{book}', [BorrowingController::class, "borrow"]);
});

require __DIR__ . '/auth.php';
