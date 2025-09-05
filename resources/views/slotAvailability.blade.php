@extends('layouts.userLayout')

@section('content')
<div class="container mt-5">
    <h2>Availability for Slot {{ $slot }}</h2>

    @if($bookings->isEmpty())
        <p class="alert alert-success">✅ This slot is completely free (no upcoming bookings).</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Car Number</th>
                    <th>Driver License</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->car_number }}</td>
                    <td>{{ $booking->driver_license }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d M Y h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ url('/parking') }}" class="btn btn-secondary mt-3">⬅ Back</a>
</div>
@endsection
