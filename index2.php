<?php

session_start();
$user = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

$isLoggedIn = false;

// isset checks if the variable is set or not
if (isset($_SESSION['user_id'])) {
    echo "Welcome " . $username;
    $isLoggedIn = true;
} else {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Digital Menu</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="#">DM</a>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="#menu_start">Menu</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#footer">Contact Us</a></li>
                <?php

                ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <script>
        function toggleMenu() {
            const nav = document.querySelector('.nav');
            const toggle = document.querySelector('.menu-toggle');
            nav.classList.toggle('active');
            toggle.classList.toggle('active');
        }
    </script>


    <!-- hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Our Hotel</h1>
            <p>Experience luxury and comfort like never before.</p>
            <a href="#menu_start" class="btn">Explore Menu</a>
            <a href="#about" class="btn btn-secondary">About Us</a>
        </div>
    </section>
    <h1 id="menu_start" style="padding-top:100px;">Hotel Digital Menu</h1>
    <!-- Menu Section -->
    <div class="order-detsils">

        <div id="menu"></div>
        <div class="summary-section">
            <!-- Table Selection Section -->
            <div class="table-selection">
                <h2>Table Selection</h2>
                <div id="tables-container"></div>
            </div>

            <div id="order-summary">
                <!-- Order Summary Section -->
                <h2>Order Summary</h2>
                <ul id="order-items"></ul>
                <p class="total-order">Total: <span id="total">0.00</span></p>
                <button onclick="placeOrder()">Place Order</button>
                <button onclick="clearOrder()">Clear Menu</button>

            </div>
        </div>
    </div>

    <!-- About Section -->
    <section class="about-us" id="about">
        <div class="about-container">
            <div class="about-image">
                <img src="./bg2.jpg" alt="About Us Image">
            </div>
            <div class="about-content">
                <h2>About Us</h2>
                <p>
                    Welcome to our hotel, where luxury meets comfort. Our mission is to provide you with an unforgettable experience, offering world-class services and exquisite hospitality.
                </p>
                <p>
                    Explore our thoughtfully curated digital menu, designed to bring gourmet dining to your fingertips. Whether you're craving a quick bite or a luxurious feast, we have options to satisfy every palate. Your dining experience is our priority—enjoy seamless ordering and exceptional flavors, right where you are. </p>
                <a href="#contact" class="btn">Contact Us</a>
            </div>
        </div>
    </section>

    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section about">
                    <h3>About Us</h3>
                    <p>
                        Welcome to Hotel Digital Menu! We aim to provide a seamless dining experience with a modern touch.
                    </p>
                </div>

                <div class="footer-section links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#menu_start">Menu</a></li>
                        <li><a href="#about">About Us</a></li>
                        <!-- <li><a href="login.html">Logout</a></li> -->
                    </ul>
                </div>

                <div class="footer-section contact">
                    <h3>Contact Us</h3>
                    <p>Email: <a href="mailto:digitalmenu@gmail.com">digitalmenu@gmail.com</a></p>
                    <p>Phone: +977XXXXXXXXXX</p>
                    <p>Address: Butwal,Nepal</p>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 Hotel Digital Menu. All Rights Reserved.</p>
            </div>
        </div>
    </footer>



    <script src="js/main.js"></script>
</body>

</html>