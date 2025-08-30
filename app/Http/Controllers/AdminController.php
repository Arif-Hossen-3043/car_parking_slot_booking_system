<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Booking;
use App\Models\User;
use App\Models\Slot;

class AdminController extends Controller
{
    // Admin Dashboard (Transactions + Stats)
    public function index()
    {
        $transactions = Transaction::with('user', 'booking')->latest()->get();

        // Stats counts
        $userCount = User::count();
        $bookingCount = Booking::count();
        $transactionCount = Transaction::count();

        return view('admin.dashboard', compact('transactions', 'userCount', 'bookingCount', 'transactionCount'));
    }

    // Approve a transaction/booking
    public function approveBooking($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['is_approved' => true]);

        // Mark related slot as paid
        $booking = Booking::find($transaction->booking_id);
        if ($booking) {
            $booking->update(['is_paid' => true]);
        }

        return redirect()->back()->with('success', 'Booking approved successfully!');
    }

    // Show all registered users
    public function users()
    {
        $users = User::all();
        return view('layouts.users', compact('users'));
    }

    // Show all bookings
    public function bookings()
    {
        $bookings = Booking::with('user')->latest()->get();
        return view('layouts.bookings', compact('bookings'));
    }

    // Show parking slots to admin
    public function parkingSlots()
    {
        $slots = Slot::all(); // Now fetch from DB
        return view('parkingSlots', compact('slots'));
    }

    // Add a new slot dynamically
  public function addSlot()
{
    $lastSlot = Slot::orderBy('id', 'desc')->first();
    $newNumber = $lastSlot ? ((int) filter_var($lastSlot->slot_number, FILTER_SANITIZE_NUMBER_INT)) + 1 : 1;

    Slot::create([
        'slot_number' => 'S'.$newNumber,
        'is_booked' => false, // boolean instead of 'status'
    ]);

    return redirect()->back()->with('success', "Slot S{$newNumber} added successfully!");
}



}
