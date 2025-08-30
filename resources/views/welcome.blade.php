<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Parking System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    /* Navbar */
    nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      background: linear-gradient(to right, #00b4db, #0083b0);
      color: #fff;
    }

    nav .logo {
      font-size: 24px;
      font-weight: bold;
    }

    nav ul {
      list-style: none;
      display: flex;
    }

    nav ul li {
      margin-left: 30px;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-weight: 500;
      transition: 0.3s;
    }

    nav ul li a:hover {
      color: #ffcc00;
    }

    /* Hero Section */
    .welcome {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      height: 90vh;
      background: linear-gradient(to right, #00b4db, #0083b0);
      color: #fff;
      padding: 20px;
    }

    .welcome h1 {
      font-size: 50px;
      margin-bottom: 20px;
    }

    .welcome p {
      font-size: 20px;
      margin-bottom: 40px;
    }

    .welcome a {
      text-decoration: none;
      background-color: #ffcc00;
      color: #000;
      padding: 15px 30px;
      border-radius: 50px;
      font-size: 18px;
      font-weight: bold;
      transition: 0.3s;
    }

    .welcome a:hover {
      background-color: #fff;
      color: #000;
    }

    /* About Section */
    .about {
      padding: 60px 20px;
      text-align: center;
      background: #fff;
    }

    .about h2 {
      font-size: 32px;
      margin-bottom: 20px;
      color: #0083b0;
    }

    .about p {
      max-width: 800px;
      margin: auto;
      font-size: 18px;
      color: #555;
    }

    /* Features Section */
    .features {
      padding: 60px 20px;
      background: #f9f9f9;
      text-align: center;
    }

    .features h2 {
      font-size: 32px;
      margin-bottom: 40px;
      color: #0083b0;
    }

    .feature-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1000px;
      margin: auto;
    }

    .feature {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .feature:hover {
      transform: translateY(-8px);
    }

    .feature h3 {
      margin-bottom: 15px;
      color: #00b4db;
    }

    .feature p {
      color: #555;
    }
    .features {
    text-align: center;
    padding: 50px 20px;
    background: #fff;
    color: #333;
}

.features h2 {
    font-size: 32px;
    margin-bottom: 15px;
    font-weight: bold;
}

.features p {
    max-width: 600px;
    margin: 0 auto 20px;
    font-size: 16px;
    color: #666;
}

.btn-how {
    display: inline-block;
    background: #7fff00;
    color: #000;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    margin-bottom: 40px;
    transition: 0.3s;
}
.btn-how:hover {
    background: #000;
    color: #fff;
}

.steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
}

.step {
    background: #f9f9f9;
    padding: 25px;
    width: 220px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.step:hover {
    transform: translateY(-5px);
}

.step-number {
    background: #7fff00;
    color: #000;
    font-weight: bold;
    display: inline-block;
    padding: 6px 12px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.step h3 {
    font-size: 18px;
    margin-bottom: 15px;
    min-height: 50px;
}

.step button {
    background: #fff;
    border: 2px solid #ccc;
    padding: 8px 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}
.step button:hover {
    background: #7fff00;
    border-color: #7fff00;
}

.review-section {
  background: #fff;
  padding: 50px 20px;
}

.review-container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 40px;
  max-width: 1000px;
  margin: auto;
  flex-wrap: wrap;
}

.review-text {
  flex: 1;
  min-width: 280px;
}

.review-text h2 {
  font-size: 28px;
  margin-bottom: 10px;
  font-weight: bold;
}

.review-text .highlight {
  color: #28a745; /* Green accent */
}

.stars {
  color: #fbc02d;
  font-size: 20px;
  margin: 10px 0;
}

.review-quote {
  font-size: 16px;
  color: #555;
  margin-bottom: 15px;
}

.review-author {
  font-weight: bold;
  margin-bottom: 20px;
}

.review-nav {
  display: flex;
  gap: 10px;
}

.review-nav button {
  width: 35px;
  height: 35px;
  border: 1px solid #ccc;
  background: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-size: 18px;
  transition: 0.3s;
}

.review-nav button:hover {
  background: #28a745;
  color: #fff;
  border-color: #28a745;
}

.review-image {
  flex: 1;
  display: flex;
  justify-content: center;
}

.review-image img {
  max-width: 250px;
  border-radius: 15px;
  box-shadow: 0px 6px 15px rgba(0,0,0,0.1);
}

    /* Footer */
    footer {
      background: #0083b0;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav>
    <div class="logo">🚗 Parking System</div>
    <ul>
      <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
      <li>
        <a href="{{ auth()->check() ? url('/parking') : url('/login') }}">Get Started</a>
      </li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <div class="welcome">
    <h1>Welcome to Smart Car Parking Slot Booking System</h1>
    <p>Book your parking slot easily with just a click.</p>
    <a href="{{ auth()->check() ? url('/parking') : url('/login') }}">Get Started</a>
  </div>

  <!-- About Section -->
  <section class="about">
    <h2>About Our System</h2>
    <p>
      Our Car Parking Booking System is designed to make parking management simple and efficient. 
      Whether you are a user booking a slot or an admin managing the spaces, 
      our system ensures hassle-free parking with real-time slot availability, 
      easy payments, and booking history tracking.
    </p>
  </section>

  <!-- Features Section -->
  <section class="features">
    <h2>System Features</h2>
    <div class="feature-list">
      <div class="feature">
        <h3>📍 Real-Time Slot Booking</h3>
        <p>Check availability and book parking slots instantly with just a click.</p>
      </div>
      <div class="feature">
        <h3>💳 Secure Payments</h3>
        <p>Pay for your booked slots easily through our secure payment gateway.</p>
      </div>
      <div class="feature">
        <h3>📊 Booking History</h3>
        <p>Keep track of your bookings, payments, and parking usage in one place.</p>
      </div>
      <div class="feature">
        <h3>🔔 Notifications</h3>
        <p>Get reminders for your bookings and updates about parking availability.</p>
      </div>
    </div>
  </section>
<section class="features">
    <h2>We Make It Difference</h2>
    <p>
        Our Car Parking System puts the power to park in your hands. 
        Whether you're booking a spot now or reserving for later, we've got you covered.
    </p>
    <a href="#" class="btn-how">HOW IT WORKS</a>

    <div class="steps">
        <div class="step">
            <div class="step-number">1</div>
            <h3>Enter Your Zone Number</h3>
            <button>▶</button>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <h3>Set Your Time</h3>
            <button>▶</button>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <h3>Select Your Slot </h3>
            <button>▶</button>
        </div>
        <div class="step">
            <div class="step-number">4</div>
            <h3>Pay & Go To Your Spot</h3>
            <button>▶</button>
        </div>
    </div>
</section>


<section class="review-section">
  <div class="review-container">
    <!-- Left side (text) -->
    <div class="review-text">
      <h2>People Love <span class="highlight">SMART-CAR-PARKING</span></h2>
      <div class="stars">★★★★★</div>
      <p class="review-quote">
        Having this app means I get to choose not only the price and see the savings but the location and what fits my needs the best. It's the most useful app I have.
      </p>
      <p class="review-author">— Mira Dias</p>

      <!-- navigation -->
      <div class="review-nav">
        <button class="prev">‹</button>
        <button class="next">›</button>
      </div>
    </div>

    <!-- Right side (image) -->
    <div class="review-image">
      <img src="https://via.placeholder.com/250x450" alt="App Screenshot">
    </div>
  </div>
</section>


  <!-- Footer -->
  <footer>
    <p>© 2025 Car Parking System | All Rights Reserved</p>
  </footer>

  <!-- //FOR REVIEW  -->
<script>
const reviews = [
  {
    text: "Having this app means I get to choose not only the price and see the savings but the location and what fits my needs the best. It's the most useful app I have.",
    author: "Mira Dias"
  },
  {
    text: "This app made parking so much easier. No more stress in finding spots!",
    author: "John Smith"
  },
  {
    text: "Affordable, simple, and reliable. I love it!",
    author: "Ayesha Rahman"
  }
];

let current = 0;
const quoteEl = document.querySelector(".review-quote");
const authorEl = document.querySelector(".review-author");

document.querySelector(".next").addEventListener("click", () => {
  current = (current + 1) % reviews.length;
  quoteEl.textContent = reviews[current].text;
  authorEl.textContent = "— " + reviews[current].author;
});

document.querySelector(".prev").addEventListener("click", () => {
  current = (current - 1 + reviews.length) % reviews.length;
  quoteEl.textContent = reviews[current].text;
  authorEl.textContent = "— " + reviews[current].author;
});
</script>
</body>
</html>
