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

    // Show parking slots (with optional vehicle_type filter)
    public function parkingSlots(Request $request)
    {
        $query = Slot::query();

        if ($request->has('vehicle_type') && $request->vehicle_type) {
            $query->where('vehicle_type', $request->vehicle_type);
        }

        $slots = $query->get();

        return view('parkingSlots', compact('slots'));
    }

    // Add a new slot dynamically (unique per vehicle_type)
    public function addSlot(Request $request)
    {
        $request->validate([
            'vehicle_type' => 'required|in:two_wheeler,four_wheeler',
        ]);

        // Prefix based on vehicle type
        $prefix = $request->vehicle_type === 'two_wheeler' ? 'T' : 'F';

        // Find last slot for this vehicle type
        $lastSlot = Slot::where('vehicle_type', $request->vehicle_type)
                        ->orderBy('id', 'desc')
                        ->first();

        if ($lastSlot) {
            // Extract number from slot_number (T1, F3, etc.)
            $lastNumber = (int) filter_var($lastSlot->slot_number, FILTER_SANITIZE_NUMBER_INT);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $slotNumber = $prefix . $nextNumber;

        try {
            // Ensure slot_number + vehicle_type pair is unique
            $exists = Slot::where('vehicle_type', $request->vehicle_type)
                          ->where('slot_number', $slotNumber)
                          ->exists();

            if ($exists) {
                return redirect()->back()->with('error', "Slot {$slotNumber} already exists for this vehicle type!");
            }

            Slot::create([
                'slot_number' => $slotNumber,
                'vehicle_type' => $request->vehicle_type,
                'is_booked'   => false,
            ]);

            return redirect()->back()->with('success', "Slot {$slotNumber} added successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error adding slot: " . $e->getMessage());
        }
    }
}
