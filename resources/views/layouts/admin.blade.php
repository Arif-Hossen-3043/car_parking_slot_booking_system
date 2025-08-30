<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            min-height: 100vh;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin-bottom: 5px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #495057;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
            flex-grow: 1;
            width: 100%;
        }

        /* Hamburger Button */
        .hamburger {
            display: none;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.active {
                transform: translateX(0);
            }
            .content {
                margin-left: 0;
            }
            .hamburger {
                display: block;
                background: #343a40;
                color: white;
                border: none;
                padding: 10px 15px;
                font-size: 22px;
                cursor: pointer;
                position: fixed;
                top: 15px;
                left: 15px;
                z-index: 1100;
                border-radius: 5px;
            }
        }
    </style>
</head>
<body>

    <!-- Hamburger Button -->
    <button class="hamburger" onclick="toggleSidebar()">☰</button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4 class="mb-4">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        <a href="{{ route('admin.users') }}">👥 Registered Users</a>
        <a href="{{ route('admin.parkingSlots') }}">🅿️ See Parking Slots</a>
        <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger w-100">🚪 Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("active");
        }
    </script>
</body>
</html>
