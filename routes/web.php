<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/Admin-login', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::get('/', function () {
//     return view('Reservation.index');
// });



Route::get('/', [HomeController::class, 'index']);

Route::post('/Save_Reservation', [HomeController::class, 'Save_Reservation'])->name('Save_Reservation');

Route::get('/SendEmail', [HomeController::class, 'sendEmail'])->name('SendEmail');

Route::get('/verify-email', [HomeController::class, 'verifyEmail'])->name('verify.email');

Route::get('/Emailchecking', [HomeController::class, 'Emailchecking'])->name('Emailchecking');


//Admin Routes

Route::get('/Admin-List', [AdminController::class, 'index'])->name('admin.reservationlist');




require __DIR__ . '/auth.php';
