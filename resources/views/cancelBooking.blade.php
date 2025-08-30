<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; }
        .container { max-width: 900px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 12px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 12px; text-align: center; }
        th { background: #0083b0; color: white; }
        .btn-cancel { padding: 8px 15px; background: red; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        .btn-cancel:hover { background: darkred; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 6px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h2>❌ Cancel Your Booking</h2>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if($bookings->count() > 0)
            <table>
                <tr>
                    <th>Slot Number</th>
                    <th>Start Time</th>
                    <th>Hours</th>
                    <th>Amount Paid</th>
                    <th>Action</th>
                </tr>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->slot_number }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->hours }}</td>
                        <td>${{ $booking->hours * 1 }}</td>
                        <td>
                            <form action="{{ route('cancel.booking', $booking->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-cancel">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No active bookings to cancel.</p>
        @endif
    </div>
</body>
</html>
