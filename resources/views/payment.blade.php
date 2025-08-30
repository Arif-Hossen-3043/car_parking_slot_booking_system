<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Slot {{ $booking->slot_number }}</title>
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

        .payment-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .payment-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .payment-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .payment-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .payment-container button {
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

        .payment-container button:hover {
            background: #0083b0;
        }

        .info {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }
        .alert-error {
            background: #ffdddd;
            color: #d8000c;
        }
        .alert-success {
            background: #ddffdd;
            color: #4f8a10;
        }
    </style>
</head>
<body>

<div class="payment-container">
    <h2>Payment for Slot {{ $booking->slot_number }}</h2>

    {{-- ✅ Show error or success messages --}}
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    
    <div class="info">
        <strong>Car Number:</strong> {{ $booking->car_number }} <br>
        <strong>Hours:</strong> {{ $booking->hours }} <br>
        <strong>Amount:</strong> ${{ $amount }}
    </div>

    <form action="{{ route('payment.pay', $booking->id) }}" method="POST">
        @csrf
        <label for="payment_method">Select Payment Method</label>
        <select name="payment_method" id="payment_method" required>
            <option value="">-- Choose Method --</option>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="cash">Cash</option>
            <option value="mobile_banking">Mobile Banking</option>
        </select>

        {{-- ✅ Disable button if there is an error --}}
        <button type="submit" {{ session('error') ? 'disabled' : '' }}>
            Pay ${{ $amount }}
        </button>
    </form>
</div>

</body>
</html>
