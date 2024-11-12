<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINSU News Bulletin</title>
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
    <div class="breaking-news">Breaking News: Major updates from MINSU News Bulletin!</div>

    <div class="carousel">
        <img src="path/to/featured1.jpg" alt="Featured News 1">
        <div class="carousel-caption">
            <h5>Featured News Title 1</h5>
            <p>Brief description of the featured news article.</p>
        </div>
    </div>

    <h2 style="color: var(--primary-color); font-weight: bold; text-align: center;">Latest News</h2>
    <div class="card-columns">
        <div class="card">
            <img src="path/to/news1.jpg" alt="News 1">
            <div class="card-body">
                <h5 class="card-title">News Title 1</h5>
                <p class="card-text">A brief description of the news article goes here...</p>
                <a href="#" class="btn-read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="path/to/news2.jpg" alt="News 2">
            <div class="card-body">
                <h5 class="card-title">News Title 2</h5>
                <p class="card-text">Another short description for a different news article...</p>
                <a href="#" class="btn-read-more">Read More</a>
            </div>
        </div>
        <div class="card">
            <img src="path/to/news3.jpg" alt="News 3">
            <div class="card-body">
                <h5 class="card-title">News Title 3</h5>
                <p class="card-text">Quick summary for this news article...</p>
                <a href="#" class="btn-read-more">Read More</a>
            </div>
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

    // Confirm logout action
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "login"; // Redirect to login page
        }
    }
</script>

</body>
</html>
