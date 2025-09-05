<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Slot;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Home (Welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Guest-accessible parking slots
Route::get('/parking-public', function () {
    $slots = Slot::all();
    return view('parkingSlots', compact('slots'));
})->name('parking.slots');

// Authenticated User Parking Slots
Route::middleware('auth')->group(function () {
    Route::get('/parking', function () {
        $slots = Slot::all();
        return view('parkingSlots', compact('slots'));
    })->name('user.parking');
});
//checking avaiblity of the slots 
Route::get('/slot-availability/{slot}', [App\Http\Controllers\BookingController::class, 'checkAvailability'])
    ->name('slot.availability');

// Dashboard for regular users
Route::get('/dashboard', function () {
    $userCount = \App\Models\User::count();
    $bookingCount = \App\Models\Booking::count();
    return view('dashboard', compact('userCount', 'bookingCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Booking routes
Route::middleware('auth')->group(function () {
    Route::get('/book/{slot}', function($slot) {
        return view('bookingInfo', compact('slot'));
    });
    Route::post('/book/{slot}', [BookingController::class, 'store']);
    Route::get('/myBookedSlot', [BookingController::class, 'myBookedSlot'])->name('myBookedSlot');
    Route::get('/cancelBooking', [BookingController::class, 'cancelPage'])->name('cancel.page');
    Route::post('/cancelBooking/{id}', [BookingController::class, 'cancel'])->name('cancel.booking');
});

// Payment routes
Route::middleware('auth')->group(function () {
    Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{booking}', [PaymentController::class, 'pay'])->name('payment.pay');

    Route::get('/sendmoney', function () {
        $number = "01955688562";
        return view('sendmoney', compact('number'));
    })->name('sendmoney');
});

// Transaction routes
Route::get('/transactions/{id}/approve', [TransactionController::class, 'approve'])->name('transactions.approve');
Route::get('/transaction-info', [TransactionController::class, 'showForm'])->name('transaction-info');
Route::post('/transaction-info', [TransactionController::class, 'store'])->name('transaction-info.store');

// Admin routes
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/approve/{id}', [AdminController::class, 'approveBooking'])->name('admin.approve');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');

        // Admin Parking Slots
        Route::get('/parking-slots', [AdminController::class, 'parkingSlots'])->name('admin.parkingSlots');
        Route::post('/parking-slots/add', [AdminController::class, 'addSlot'])->name('admin.parkingSlots.add');
    });

// Logout for regular users
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // redirect to welcome page
})->name('logout');

// Admin logout
Route::post('/admin/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('admin.logout');

require __DIR__.'/auth.php';
