<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot {{ $slot }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .booking-form {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .booking-form h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .booking-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .booking-form input[type="text"],
        .booking-form input[type="number"],
        .booking-form input[type="time"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .booking-form button {
            width: 100%;
            padding: 12px;
            background: #00b4db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .booking-form button:hover {
            background: #0083b0;
        }
    </style>
</head>
<body>

<div class="booking-form">
    <h2>Book Slot {{ $slot }}</h2>
    <form action="{{ url('/book/'.$slot) }}" method="POST">
        @csrf
        <label for="car_number">Car Number</label>
        <input type="text" name="car_number" id="car_number" required>

        <label for="driver_license">Driver License No</label>
        <input type="text" name="driver_license" id="driver_license" required>

      <label for="start_time">Time of Parking</label>
    <input type="datetime-local" name="start_time" id="start_time" required>


        <label for="hours">Number of Hours</label>
        <input type="number" name="hours" id="hours" min="1" required>

        <button type="submit">Reserve Slot</button>
    </form>
</div>

<!-- Success popup and redirect -->
@if(session('success'))
<script>
    alert("{{ session('success') }}"); // Show popup
    window.location.href = "{{ url('/dashboard') }}"; // Redirect to dashboard
</script>
@endif

<!-- Optional: conflict alert -->
@if(session('conflict'))
<script>
    alert("{{ session('conflict') }}"); // Show conflict message
</script>
@endif

</body>
</html>
