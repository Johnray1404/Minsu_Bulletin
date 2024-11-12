<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - MINSU News Bulletin</title>
    <link rel="stylesheet" href="public/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="header">
    <img src="public/images/minsu.jpg" alt="MINSU Logo">
    <div class="nav-links">
        <a class="nav-link" href="/home"><i class="fas fa-home"></i>Home</a>
        <a class="nav-link" href="/news"><i class="fas fa-newspaper"></i>News</a>
        <a class="nav-link" href="/blog"><i class="fas fa-blog"></i>Blog</a>
        <a class="nav-link" href="/gallery"><i class="fas fa-image"></i>Gallery</a>
        <a class="nav-link" href="/contact"><i class="fas fa-envelope"></i>Contact</a>
    </div>
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search here">
    </div>

    <!-- User Profile Icon and Dropdown -->
    <div class="user-profile">
        <i class="fas fa-user-circle" onclick="toggleDropdown()"></i>
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="/profile">User Profile</a>
            <a href="/change-password">Change Password</a>
            <a href="#" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
</div>

<div class="main">
    <div class="contact-header">
        <h1>Contact Us</h1>
        <p>Feel free to reach out to us via any of the methods below. We're here to assist you!</p>
    </div>

    <div class="contact-details">
        <div class="contact-card">
            <i class="fas fa-phone-alt"></i>
            <h3>Phone</h3>
            <p>0912-457-7314</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-envelope"></i>
            <h3>Email</h3>
            <p>minsu@gmail.com</p>
        </div>
        <div class="contact-card">
            <i class="fas fa-map-marker-alt"></i>
            <h3>Address</h3>
            <p>Masipit Calapan City, Oriental Mindoro</p>
        </div>
    </div>

    <!-- Contact Form Container -->
    <div class="contact-form-container">
        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="#" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Send Message</button>
            </form>
        </div>
    </div>

    <footer>
        <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
    </footer>
</div>

<script>
     // Toggle the dropdown menu for user profile
     function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "login"; 
        }
    }
</script>

</body>
</html>
