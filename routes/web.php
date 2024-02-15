<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\VenueTypeController;

use App\Http\Controllers\VenueController;

use App\Http\Controllers\ReservationController;

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
    return view('welcome');
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
    });// End Group Admin Middleware

});


// Reservation
Route::get('admin/reservation/{id}/delete', [ReservationController::class, 'destroy']);
Route::match(['get', 'post'], 'admin/reservation/available-venues', [ReservationController::class, 'available_venues']);
Route::resource('admin/reservation', ReservationController::class);

