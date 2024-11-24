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

        /* Container for individual post */
        .post-container {
            margin-top: 30px;
            background-color: var(--light-text);
            padding: 20px;
            box-shadow: 0 4px 12px var(--card-shadow);
            border-radius: 8px;
            max-width: 800px;
            margin: 20px auto;
        }

        .post-header h1 {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .post-meta {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .post-content {
            font-size: 18px;
            line-height: 1.8;
            color: var(--text-color);
        }

        /* Fixed Add Post Button below the header */
        .add-post-button {
            display: inline-block;
            background-color: var(--accent-color);
            color: var(--light-text);
            padding: 12px 30px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            position: fixed;
            top: 100px; /* Adjusted to place it below the header */
            left: 20px; /* Positioned 20px from the left */
            z-index: 1000; /* Ensure it stays on top */
            margin-left: 25px;
            margin-top: 20px;
        }

        .add-post-button:hover {
            transform: scale(1.1);
            background-color: var(--hover-color);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .add-post-button i {
            margin-right: 10px;
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
        .post-container {
            margin-top: 30px;
            background-color: var(--light-text);
            padding: 20px;
            box-shadow: 0 4px 12px var(--card-shadow);
            border-radius: 8px;
            max-width: 600px;
            margin: 20px auto;
        }

        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .post-header img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .post-header .username {
            font-size: 18px;
            font-weight: 600;
        }

        .post-meta {
            font-size: 14px;
            color: var(--text-color);
            margin-bottom: 15px;
        }

        .post-content {
            font-size: 18px;
            line-height: 1.8;
            color: var(--text-color);
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
        <!-- Check if the user has uploaded a profile picture -->
        <?php if (!empty($user['profile_pic'])): ?>
            <!-- If the user has a profile picture -->
            <img src="public/<?php echo $user['profile_pic']; ?>" alt="Profile Picture" class="profile-img" onclick="toggleDropdown()" />
        <?php else: ?>
            <!-- If the user does not have a profile picture, show the default icon -->
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
    <!-- Add Post Button -->
    <a href="/get-post" class="add-post-button"><i class="fas fa-plus-circle"></i> Add Post</a>

    <div class="post-list">
        <?php if (!empty($news_posts)): ?>
            <?php foreach ($news_posts as $post): ?>
                <div class="post-container">
                    <div class="post-header">
                        <?php if (!empty($post['profile_pic'])): ?>
                            <img src="public/<?php echo htmlspecialchars($post['profile_pic']); ?>" alt="Profile Picture">
                        <?php else: ?>
                            <img src="public/images/default-profile.png" alt="Profile Picture">
                        <?php endif; ?>
                        <div class="post-info">
                            <span class="username"><?php echo htmlspecialchars($post['username']); ?></span>
                            <div class="post-meta">
                                <span><i class="fas fa-clock"></i> <?php echo $time_ago($post['created_at']); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="post-title">
                        <h1><?php echo htmlspecialchars($post['post_title']); ?></h1>
                    </div>

                    <div class="post-content">
                        <p><?php echo nl2br(htmlspecialchars($post['post_caption'])); ?></p>

                        <?php if (!empty($post['post_mediafile'])): ?>
                            <div class="post-media">
                                <img src="public/<?php echo htmlspecialchars($post['post_mediafile']); ?>" alt="Post Media" style="max-width: 100%; height: auto;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts found!</p>
        <?php endif; ?>
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
            window.location.href = "/"; // Redirect to login page
        }
    }
</script>

</body>
</html>
