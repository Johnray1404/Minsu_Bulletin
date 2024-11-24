<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* CSS Variables for consistent design */
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
            flex-grow: 1;
        }

        .post-container {
            margin-top: 30px;
            background-color: var(--light-text);
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            width: 400px;
            margin: 20px auto;
            border: 1px solid #eee;
            transition: box-shadow 0.3s ease;
        }

        .post-container:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: 700;
            color: var(--primary-color);
            text-align: center;
        }

        .post-form input,
        .post-form textarea,
        .post-form select {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .post-form input[type="file"] {
            border: none;
            padding: 10px;
            background-color: transparent;
        }

        .post-form input:focus,
        .post-form textarea:focus {
            border-color: var(--primary-color);
            background-color: #fff;
            outline: none;
        }

        .post-form textarea {
            min-height: 150px;
            resize: vertical;
            padding-top: 12px;
        }

        .post-form button {
            background-color: var(--accent-color);
            color: var(--light-text);
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
            display: block;
            text-align: center;
        }

        .post-form button:hover {
            background-color: var(--hover-color);
            transform: scale(1.05);
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
            .post-container {
                padding: 30px;
                margin-top: 20px;
            }

            h1 {
                font-size: 28px;
            }

            .post-form input,
            .post-form textarea {
                font-size: 14px;
            }

            .post-form button {
                font-size: 16px;
                padding: 14px;
            }
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
    <!-- Add Post Form -->
    <div class="post-container">
        <h1>Create a New Post</h1>
        <form action="/add-post" method="POST" enctype="multipart/form-data" class="post-form">
            <input type="text" name="post_title" placeholder="Post Title" required>
            <textarea name="post_caption" placeholder="Post Caption" rows="5" required></textarea>
            <input type="file" name="post_mediafile" accept="image/*,video/*,audio/*">
            <button type="submit">Submit Post</button>
        </form>
    </div>
</div>

<footer>
    <p>© 2024 MINSU News Bulletin. All rights reserved.</p>
</footer>

<script>
    // Toggle the dropdown menu for user profile
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('show');
    }

    // Confirm logout action
    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/"; // Redirect to login page
        }
    }
</script>

</body>
</html>
