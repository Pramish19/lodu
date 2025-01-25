<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/header.css">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#">Hotel Logo</a>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="#login">Login/Sign Up</a></li>
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
</body>
</html>
