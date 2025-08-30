<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon; // ✅ import Carbon for date/time

class PaymentController extends Controller
{
    public function show($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // ❌ Prevent booking for past/expired time
        if (Carbon::parse($booking->start_time)->isPast()) {
            return redirect()->back()->with('error', '❌ You cannot book a past or expired slot. Please select a future time.');
        }

        // ❌ Check for conflict with other bookings on the same slot
        $conflict = Booking::where('slot_number', $booking->slot_number)
            ->where('id', '!=', $booking->id)
            ->where(function ($query) use ($booking) {
                $query->whereBetween('start_time', [$booking->start_time, $booking->end_time])
                      ->orWhereBetween('end_time', [$booking->start_time, $booking->end_time])
                      ->orWhere(function ($q) use ($booking) {
                          $q->where('start_time', '<=', $booking->start_time)
                            ->where('end_time', '>=', $booking->end_time);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', '❌ This slot is already booked for the selected time. Please choose another.');
        }

        // ✅ calculate amount: $1 per hour
        $amount = $booking->hours * 1;

        return view('payment', compact('booking', 'amount'));
    }

    public function pay(Request $request, $bookingId)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $booking = Booking::findOrFail($bookingId);

        // ❌ Block payment if booking time is invalid
        if (Carbon::parse($booking->start_time)->isPast()) {
            return redirect()->back()->with('error', '❌ This booking time has already passed. Please book a future slot.');
        }

        // ❌ Block payment if there is a conflict
        $conflict = Booking::where('slot_number', $booking->slot_number)
            ->where('id', '!=', $booking->id)
            ->where(function ($query) use ($booking) {
                $query->whereBetween('start_time', [$booking->start_time, $booking->end_time])
                      ->orWhereBetween('end_time', [$booking->start_time, $booking->end_time])
                      ->orWhere(function ($q) use ($booking) {
                          $q->where('start_time', '<=', $booking->start_time)
                            ->where('end_time', '>=', $booking->end_time);
                      });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', '❌ Payment failed! Slot already booked at this time. Please select another.');
        }

        // ✅ Mark booking as paid
        $booking->is_paid = true;
        $booking->payment_method = $request->payment_method;
        $booking->save();

        // ✅ Create transaction record
        Transaction::create([
            'booking_id' => $booking->id,
            'user_id' => $booking->user_id,
            'transaction_id' => uniqid('TXN-'),
            'is_approved' => false,
        ]);

        return redirect('/')->with('status', '✅ Payment successful! Your slot is booked.');
    }
}
