<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('Reservation.index');
// });



Route::get('/', [HomeController::class, 'index']);

Route::post('/Save_Reservation', [HomeController::class, 'Save_Reservation'])->name('Save_Reservation');

Route::get('/SendEmail', [HomeController::class, 'sendEmail'])->name('SendEmail');

Route::get('/verify-email', [HomeController::class, 'verifyEmail'])->name('verify.email');

Route::get('/Emailchecking', [HomeController::class, 'Emailchecking'])->name('Emailchecking');