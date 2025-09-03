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

        /* Packages Section */
        .packages {
            margin-top: 50px;
        }

        .packages h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 26px;
            color: #333;
        }

        .package-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .package-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            transition: 0.3s;
        }

        .package-card:hover {
            transform: translateY(-5px);
        }

        .package-card h4 {
            margin-bottom: 15px;
            color: #0083b0;
        }

        .package-card ul {
            list-style: none;
            padding: 0;
            margin: 0 0 15px;
        }

        .package-card ul li {
            padding: 6px 0;
            color: #555;
            font-size: 14px;
        }

        .package-card span {
            font-weight: bold;
            color: #000;
        }

        .btn-book {
            display: inline-block;
            padding: 10px 16px;
            background: #00b4db;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-book:hover {
            background: #0083b0;
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
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        <p>You're logged in. Use the sidebar to navigate your bookings.</p>

        <a href="{{ url('/myBookedSlot') }}" class="btn">Go to Slots You Booked</a>

        <!-- Parking Packages Section -->
        <section class="packages">
          <h2>🚗 Parking Packages</h2>
          <div class="package-container">

            <!-- Two-Wheeler Package -->
            <div class="package-card">
              <h4>🏍️ Two-Wheeler</h4>
              <ul>
                <li>⏰ 1 Hour - <span>20 BDT</span></li>
                <li>⏰ 2 Hours - <span>35 BDT</span></li>
                <li>🌙 Half Day - <span>100 BDT</span></li>
                <li>🕛 24 Hours - <span>150 BDT</span></li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Book Now</a>
            </div>

            <!-- Four-Wheeler Package -->
            <div class="package-card">
              <h4>🚘 Four-Wheeler</h4>
              <ul>
                <li>⏰ 1 Hour - <span>50 BDT</span></li>
                <li>⏰ 2 Hours - <span>90 BDT</span></li>
                <li>🌙 Half Day - <span>250 BDT</span></li>
                <li>🕛 24 Hours - <span>400 BDT</span></li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Book Now</a>
            </div>

            <!-- Two-Wheeler Monthly Subscription -->
            <div class="package-card">
              <h4>📅 🏍️ Two-Wheeler Monthly</h4>
              <ul>
                <li>✔️ Unlimited access</li>
                <li>✔️ Priority Slots</li>
                <li>💳 <span>3000 BDT</span></li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Subscribe</a>
            </div>

            <!-- Four-Wheeler Monthly Subscription -->
            <div class="package-card">
              <h4>📅 🚘 Four-Wheeler Monthly</h4>
              <ul>
                <li>✔️ Unlimited access</li>
                <li>✔️ Priority Slots</li>
                <li>💳 <span>6000 BDT</span></li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Subscribe</a>
            </div>

            <!-- VIP Reserved Parking -->
            <div class="package-card">
              <h4>⭐ VIP Reserved</h4>
              <ul>
                <li>🚘 Reserved Spot</li>
                <li>⏱️ 24/7 Access</li>
                <li>🔒 Security Priority</li>
                <li>💳 <span>10,000 BDT / Month</span></li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Reserve Now</a>
            </div>

            <!-- Weekend Special -->
            <div class="package-card">
              <h4>🎉 Weekend Special</h4>
              <ul>
                <li>🏍️ Two-Wheeler - <span>100 BDT</span></li>
                <li>🚘 Four-Wheeler - <span>250 BDT</span></li>
                <li>📅 Saturday & Sunday</li>
                <li>🕛 24 Hours Valid</li>
              </ul>
              <a href="{{ route('user.parking') }}" class="btn-book">Grab Offer</a>
            </div>

          </div>
        </section>
<!-- Features Section -->
<section class="features">
  <h2>✨ System Features</h2>
  <div class="feature-list">
    <div class="feature-card">
      <h3>📍 Real-Time Slot Booking</h3>
      <p>Check availability and book parking slots instantly with just a click.</p>
    </div>
    <div class="feature-card">
      <h3>💳 Secure Payments</h3>
      <p>Pay for your booked slots easily through our secure payment gateway.</p>
    </div>
    <div class="feature-card">
      <h3>📊 Booking History</h3>
      <p>Keep track of your bookings, payments, and parking usage in one place.</p>
    </div>
    <div class="feature-card">
      <h3>🔔 Smart Notifications</h3>
      <p>Get reminders for your bookings and updates about parking availability.</p>
    </div>
  </div>
</section>

<!-- Steps Section -->
<section class="how-it-works">
  <h2>🚦 How It Works</h2>
  <p>
    Our Car Parking System puts the power to park in your hands. 
    Whether you're booking a spot now or reserving for later, we've got you covered.
  </p>

  <div class="steps">
    <div class="step">
      <div class="circle">1</div>
      <h3>Enter Your Zone Number</h3>
    </div>
    <div class="step">
      <div class="circle">2</div>
      <h3>Set Your Time</h3>
    </div>
    <div class="step">
      <div class="circle">3</div>
      <h3>Select Your Slot</h3>
    </div>
    <div class="step">
      <div class="circle">4</div>
      <h3>Pay & Go To Your Spot</h3>
    </div>
  </div>
</section>
 <!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-left">
      <h3>🚗 Car Parking System</h3>
      <p>Smart, fast and reliable parking solution.</p>
    </div>

    <div class="footer-links">
      <a href="#">Home</a>
      <a href="#">Packages</a>
      <a href="#">Features</a>
      <a href="#">Contact</a>
    </div>

    <div class="footer-right">
      <p>© 2025 Car Parking System | All Rights Reserved</p>
      <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- Add FontAwesome for icons -->
<script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>

<style>
.footer {
  background: linear-gradient(135deg, #00b4db, #0083b0);
  color: #fff;
  padding: 40px 20px;
  margin-top: 50px;
}
.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  align-items: flex-start;
  max-width: 1200px;
  margin: auto;
}
.footer-left h3 {
  margin-bottom: 10px;
}
.footer-left p {
  font-size: 14px;
  color: #e0f7fa;
}
.footer-links {
  display: flex;
  gap: 20px;
  margin: 15px 0;
}
.footer-links a {
  color: #fff;
  text-decoration: none;
  transition: 0.3s;
}
.footer-links a:hover {
  text-decoration: underline;
}
.footer-right {
  text-align: right;
}
.footer-right p {
  margin-bottom: 10px;
  font-size: 14px;
  color: #e0f7fa;
}
.social-icons a {
  color: #fff;
  margin: 0 8px;
  font-size: 16px;
  transition: 0.3s;
}
.social-icons a:hover {
  color: #ffd700;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    text-align: center;
  }
  .footer-right {
    text-align: center;
    margin-top: 20px;
  }
  .footer-links {
    justify-content: center;
    flex-wrap: wrap;
  }
}
</style>

    </div>


</body>

<style>
/* Features Section */
.features {
  padding: 60px 20px;
  background: #f9f9f9;
  text-align: center;
}
.features h2 {
  font-size: 28px;
  margin-bottom: 30px;
  color: #0083b0;
}
.feature-list {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
}
.feature-card {
  background: #fff;
  border-radius: 12px;
  padding: 20px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transition: 0.3s;
}
.feature-card:hover {
  transform: translateY(-5px);
}
.feature-card h3 {
  color: #00b4db;
  margin-bottom: 10px;
}

/* Steps Section */
.how-it-works {
  padding: 60px 20px;
  text-align: center;
  background: #fff;
}
.how-it-works h2 {
  font-size: 28px;
  margin-bottom: 15px;
  color: #0083b0;
}
.how-it-works p {
  max-width: 600px;
  margin: 0 auto 40px;
  color: #555;
}
.steps {
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  gap: 25px;
}
.step {
  flex: 1 1 200px;
  max-width: 220px;
  text-align: center;
}
.circle {
  width: 50px;
  height: 50px;
  margin: 0 auto 15px;
  background: #00b4db;
  color: #fff;
  border-radius: 50%;
  font-size: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.step h3 {
  font-size: 16px;
  color: #333;
}
</style>
</html>
