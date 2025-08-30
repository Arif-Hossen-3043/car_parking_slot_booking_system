<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #0083b0;
            color: #fff;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 22px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-weight: bold;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #00b4db;
        }

        /* Content area */
        .content {
            margin-left: 250px; /* same as sidebar width */
            padding: 40px;
            flex: 1;
        }

        .content h2 {
            margin-top: 0;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 20px;
            background: #00b4db;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0083b0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .sidebar { width: 100%; position: relative; }
            .content { margin-left: 0; padding: 20px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>🚗 Dashboard</h2>
        <a href="{{ url('/dashboard') }}">🏠 Home</a>
        <a href="{{ url('/parking') }}">📍 Parking Slots</a>
        <a href="{{ url('/myBookedSlot') }}">🅿 My Bookings</a>
        <a href="{{ url('/cancelBooking') }}">❌ Cancel Booking</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           🔒 Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main content -->
    <div class="content">
        @yield('content')  {{-- <-- THIS IS CRUCIAL for child views like parkingSlots.blade --}}
    </div>

</body>
</html>
