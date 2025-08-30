<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Store a new booking
    public function store(Request $request, $slot)
    {
        $request->validate([
            'car_number' => 'required|string|max:20',
            'driver_license' => 'required|string|max:50',
            'start_time' => 'required',
            'hours' => 'required|integer|min:1',
        ]);

        $userId = auth()->id();

        // Check if user already has a booking
        $existingBooking = Booking::where('user_id', $userId)->first();
        if ($existingBooking) {
            // Redirect to booked slot page if already booked
            return redirect()->route('myBookedSlot')->with('info', 'You already have a booked slot.');
        }

        // Create a new booking
        $booking = Booking::create([
            'user_id' => $userId,
            'slot_number' => $slot,
            'car_number' => $request->car_number,
            'driver_license' => $request->driver_license,
            'start_time' => $request->start_time,
            'hours' => $request->hours,
            'is_paid' => false,
        ]);

        // Redirect to payment page
        return redirect()->route('payment.show', ['booking' => $booking->id]);
    }

    // Show the booked slot for the logged-in user
    public function myBookedSlot()
    {
        $booking = Booking::where('user_id', auth()->id())->first();
        return view('myBookedSlot', compact('booking'));
    }

    // Cancel page -> show all user bookings
    public function cancelPage()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->where('is_paid', true)
            ->get();

        return view('cancelBooking', compact('bookings'));
    }

    // Cancel a booking
    public function cancel(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id != auth()->id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $bookingTime = Carbon::parse($booking->start_time);
        $now = Carbon::now();

        // Must be 3 hours before
        if ($now->diffInHours($bookingTime, false) < 3) {
            return back()->with('error', 'You can only cancel at least 3 hours before the booking.');
        }

        // Refund = 60% of payment (assuming $1 per hour)
        $refund = $booking->hours * 1 * 0.6;

        // Mark booking as cancelled
        $booking->is_paid = false;
        $booking->status = 'cancelled';
        $booking->save();

        // Store refund transaction
        Transaction::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'transaction_id' => uniqid('REFUND-'),
            'is_approved' => true,
        ]);

        return back()->with('status', "Booking cancelled! Refund: $$refund");
    }
}
