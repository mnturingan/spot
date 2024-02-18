<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\VenueTypeController;

use App\Http\Controllers\VenueController;

use App\Http\Controllers\ReservationController;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    Route::post('/logout', [HomeController::class, 'userLogout'])->name('user.logout');

    Route::get('reservation/create', [ReservationController::class, 'userReservation']);

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::post('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

        //VenueType Routes
        Route::get('admin/venueType/{id}/delete', [VenueTypeController::class, 'destroy']);
        Route::resource('admin/venueType', VenueTypeController::class);
        //Delete Image
        Route::get('admin/venueTypeImage/delete/{id}', [VenueTypeController::class, 'destroy_image']);

        //Venue Routes
        Route::get('admin/venue/{id}/delete', [VenueController::class, 'destroy']);
        Route::resource('admin/venue', VenueController::class);

        //Reservation Action
        Route::get('admin/reservation/{id}/acknowledge', [ReservationController::class, 'acknowledge'])->name('admin.reservation.acknowledge');
        Route::get('admin/reservation/{id}/reject', [ReservationController::class, 'reject'])->name('admin.reservation.reject');


    });// End Group Admin Middleware

});


// Reservation
Route::get('reservation/{id}/delete', [ReservationController::class, 'destroy']);
Route::match(['get', 'post'], 'reservation/available-venues', [ReservationController::class, 'available_venues']);
Route::resource('admin/reservation', ReservationController::class);

// Route::get('admin/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('admin.reservation.edit');
// Route::put('admin/reservation/{id}', [ReservationController::class, 'update'])->name('admin.reservation.update');


Route::get('my-reservations', [ReservationController::class, 'myReservations'])->name('reservation.my-reservations');
