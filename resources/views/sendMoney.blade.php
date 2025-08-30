<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #00b4db, #0083b0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .payment-container {
            background: rgba(0,0,0,0.6);
            padding: 40px;
            border-radius: 12px;
            text-align: center;
        }
        .payment-container h2 {
            margin-bottom: 20px;
        }
        .payment-container p {
            font-size: 18px;
            margin: 10px 0;
        }
        .payment-container .number {
            font-weight: bold;
            font-size: 22px;
            color: #ffcc00;
        }
        .payment-container a {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 25px;
            background: #ffcc00;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        .payment-container a:hover {
            background: #e6b800;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Send Your Payment</h2>
        <p>Please pay the amount via mobile banking to the following number:</p>
        <p class="number">{{ $number }}</p>
        <p>After sending the payment, confirm your transaction with the admin.</p>
        <a href="{{ route('transaction-info') }}"> Temorary reserve slot by Confirm payment</a>
    </div>
</body>
</html>
