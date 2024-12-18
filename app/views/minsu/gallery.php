<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/gallery.css">
</head>
<body>
<div class="header">
    <img src="public/images/minsu.jpg" alt="MINSU Logo">
    <div class="nav-links">
        <a class="nav-link" href="/home"><i class="fas fa-home"></i>Home</a>
        <a class="nav-link" href="/userNews"><i class="fas fa-newspaper"></i>News</a>
        <a class="nav-link" href="/post"><i class="fas fa-pen"></i> Post</a>
        <a class="nav-link" href="/gallery"><i class="fas fa-image"></i>Gallery</a>
        <a class="nav-link" href="/contact"><i class="fas fa-envelope"></i>Contact</a>
    </div>
    <div class="search-bar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search here">
    </div>
    <div class="user-profile">
        <?php if (!empty($user['profile_pic'])): ?>
            <img src="public/<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="profile-img" onclick="toggleDropdown()" />
        <?php else: ?>
            <i class="fas fa-user-circle profile-icon" onclick="toggleDropdown()"></i>
        <?php endif; ?>
        <div class="dropdown-menu" id="dropdownMenu">
            <a href="/userProfile">User Profile</a>
            <a href="#" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
</div><br><br>
<div class="main">
    <div class="breaking-news"> Gallery of Mindoro State University</div>

    <div class="gallery-section">
        <?php if (!empty($gallery_images)): ?>
            <?php foreach ($gallery_images as $image): ?>
                <?php if (!empty($image['image'])): ?>
                    <div class="gallery-item">
                        <img src="public/<?php echo $image['image']; ?>" alt="Gallery Image">
                    </div>
                <?php else: ?>
                    <p>No image available for this entry.</p>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images available in the gallery.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
</footer>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/"; 
        }
    }
</script>
</body>
</html>
