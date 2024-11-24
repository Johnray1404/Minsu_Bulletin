<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #048506;
            --secondary-color: #f1f3f5;
            --accent-color: #ff9800;
            --hover-color: #66bb6a;
            --bg-color: #fafafa;
            --text-color: #333;
            --light-text: #fff;
            --card-shadow: rgba(0, 0, 0, 0.1);
            --btn-hover-color: #388e3c;
            --font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: var(--bg-color);
            font-family: var(--font-family);
            margin: 0;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            line-height: 1.6;
        }
        .header {
            background-color: var(--primary-color);
            color: var(--light-text);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
        }
        .header img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            border: 3px solid var(--light-text);
        }
        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .nav-link {
            color: var(--light-text);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .nav-link i {
            margin-right: 10px;
            font-size: 20px;
        }
        .nav-link:hover {
            color: var(--hover-color);
        }
        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--light-text);
            border-radius: 25px;
            padding: 5px 15px;
            width: 250px;
        }
        .search-bar i {
            color: var(--primary-color);
            font-size: 18px;
            margin-right: 10px;
        }
        .search-bar input {
            border: none;
            outline: none;
            background: transparent;
            color: var(--text-color);
            font-size: 16px;
            padding: 8px;
            width: 100%;
            border-radius: 25px;
        }
        .search-bar input::placeholder {
            color: var(--text-color);
            font-size: 14px;
        }
        .user-profile {
            position: relative;
            display: inline-block;
            margin-left: 20px;
        }
        .user-profile i {
            font-size: 30px;
            color: var(--light-text);
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 40px;
            background-color: var(--light-text);
            box-shadow: 0 4px 8px var(--card-shadow);
            border-radius: 8px;
            min-width: 200px;
            padding: 10px 0;
            z-index: 1000;
        }
        .dropdown-menu a {
            color: var(--text-color);
            padding: 10px 20px;
            text-decoration: none;
            display: block;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .dropdown-menu a:hover {
            background-color: var(--hover-color);
            color: var(--light-text);
        }
        .dropdown-menu.show {
            display: block;
        }
        .main {
            margin-top: 60px;
            padding: 20px 30px;
        }
        .breaking-news {
            background-color: #dc3545;
            color: var(--light-text);
            padding: 10px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            margin-top: 20px;
        }
        footer {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 20px 0;
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
        }
        @media (max-width: 768px) {
            .post-header {
                flex-direction: column;
                align-items: flex-start;
            }
            .post-title h1 {
                font-size: 20px;
            }
            .post-caption p {
                font-size: 14px;
            }
            .main-post-image {
                height: 300px;
                object-fit: cover;
            }
        }
        .profile-img {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
        }
        .profile-icon {
            font-size: 40px;
            cursor: pointer;
        }
    </style>
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
            <a href="/change-password">Change Password</a>
            <a href="#" onclick="confirmLogout()">Logout</a>
        </div>
    </div>
</div>
<div class="main">
    <div class="breaking-news">Breaking News: Major updates from MINSU News Bulletin!</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
    </footer>
</div>
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
