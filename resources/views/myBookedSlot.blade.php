<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard - Car Parking System</title>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        display: flex;
        min-height: 100vh;
        overflow-x: hidden;
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
        transition: transform 0.3s ease-in-out;
        z-index: 1000;
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

    /* Sidebar overlay for mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        z-index: 900;
    }

    /* Content area */
    .content {
        margin-left: 250px;
        padding: 40px;
        flex: 1;
        transition: margin-left 0.3s ease-in-out;
    }

    .booking-card {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        max-width: 600px;
        margin: auto;
        text-align: center;
    }

    .booking-card h2 {
        margin-top: 0;
        color: #333;
    }

    .booking-card p {
        font-size: 16px;
        margin: 10px 0;
    }

    .status-paid {
        color: green;
        font-weight: bold;
    }

    .status-pending {
        color: orange;
        font-weight: bold;
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

    /* Sidebar toggle button for mobile */
    .sidebar-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        font-size: 24px;
        background: #0083b0;
        color: #fff;
        border: none;
        border-radius: 6px;
        padding: 10px 15px;
        cursor: pointer;
        z-index: 1100;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .sidebar.active {
            transform: translateX(0);
        }
        .content {
            margin-left: 0;
            padding: 80px 20px 20px 20px; /* add top padding for toggle button */
        }
        .sidebar-toggle {
            display: block;
        }
        .sidebar-overlay.active {
            display: block;
        }
        .booking-card {
            width: 100%;
            padding: 20px;
        }
    }

    @media (max-width: 480px) {
        .booking-card h2 {
            font-size: 18px;
        }
        .booking-card p {
            font-size: 14px;
        }
        .btn {
            padding: 10px 15px;
            font-size: 14px;
        }
    }
</style>
</head>
<body>

<!-- Sidebar Toggle Button -->
<button class="sidebar-toggle" onclick="toggleSidebar()">☰ Menu</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
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

<!-- Sidebar overlay for mobile -->
<div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

<!-- Main content -->
<div class="content">
    <h2>Welcome, {{ Auth::user()->name }}!</h2>

    @if($booking)
        <div class="booking-card">
            <h2>📌 Your Booked Slot</h2>
            <p>Slot Number: <strong>{{ $booking->slot_number }}</strong></p>
            <p>Status: 
                @if($booking->is_paid)
                    <span class="status-paid">✅ Paid</span>
                @else
                    <span class="status-pending">⏳ Pending Payment</span>
                @endif
            </p>
            <p>Booking Start Time: {{ \Carbon\Carbon::parse($booking->start_time)->format('d M Y, h:i A') }}</p>
            <p>Total Hours: {{ $booking->hours }}</p>
            <a href="{{ route('payment.show', $booking->id) }}" class="btn">Proceed to Payment</a>
        </div>
    @else
        <div class="booking-card">
            <h2>❌ You haven’t booked any slots yet.</h2>
            <a href="{{ url('/parking') }}" class="btn">Book a Slot Now</a>
        </div>
    @endif
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }
</script>

</body>
</html>

