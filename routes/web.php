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

Route::get('/verify-email', [HomeController::class, 'verifyEmail'])->name('verify-email');

Route::get('/Emailchecking', [HomeController::class, 'Emailchecking'])->name('Emailchecking');


//Admin Routes

Route::middleware('auth')->group(function () {

    Route::get('/Admin-List', [AdminController::class, 'index'])->name('admin.reservationlist');
    Route::post('/Each-timeslot', [AdminController::class, 'each_time_slot'])->name('admin.eachtimeslot');
    Route::post('/each-date', [AdminController::class, 'each_date'])->name('admin.eachdate');

    Route::get('/Assign-table/{id}', [AdminController::class, 'assign_table'])->name('admin.assigntable');
    Route::post('/Selection-table', [AdminController::class, 'selectiontable'])->name('admin.selectiontable');
    Route::post('/Selection-section', [AdminController::class, 'selectionsection'])->name('admin.selectionsection');
    Route::get('/Assign-edit-table/{id}', [AdminController::class, 'assign_table_edit'])->name('admin.assigntableedit');
    Route::post('/Removetable', [AdminController::class, 'Removetable'])->name('admin.removetable');
    Route::get('/Add-reservation', [AdminController::class, 'addreservation'])->name('admin.addreservation');
    Route::get('/autocomplete-mobile', [AdminController::class, 'autocomplete'])->name('autocomplete.mobile');
    Route::post('/reservation-date', [AdminController::class, 'reservation_date'])->name('admin.reservationdate');
    Route::post('/Add-newreservation', [AdminController::class, 'addnewreservation'])->name('admin.addnewreservation');
});







require __DIR__ . '/auth.php';
