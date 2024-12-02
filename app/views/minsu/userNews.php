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

        .news-feed-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .post {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: 600px;
            margin: 0 auto;
        }

        .post-header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 15px;
            gap: 10px;
            position: relative;
        }

        .post-user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .post-user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .post-user-name {
            font-weight: bold;
            font-size: 18px;
            color: #333;
        }

        .post-time {
            font-size: 14px;
            color: #777;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .post-time i {
            color: var(--primary-color);
        }

        .post-title h1 {
            font-size: 22px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .post-caption p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .post-image-container {
            margin-top: 15px;
        }

        .main-post-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .main-post-video {
            width: 100%; /* Set the video width to 100% to match the image size */
            height: auto; /* Maintain the aspect ratio of the video */
            border-radius: 10px;
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

            .main-post-video {
                height: 300px; /* Adjust height for mobile view */
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
    <div class="breaking-news">Breaking News: Major updates from MINSU News Bulletin!</div><br>

    <div class="news-feed-container">
        <?php if (!empty($news_posts)): ?>
            <?php foreach ($news_posts as $post): ?>
                <div class="post">
                    <div class="post-header">
                        <div class="post-user-info">
                            <img src="public/images/minsu.jpg" alt="Admin Profile" class="post-user-image">
                            <div class="post-user-name">
                                <strong>MINSU</strong>
                            </div>
                        </div>
                        <div class="post-time">
                            <i class="fas fa-clock"></i>
                            <span><?= $time_ago($post['created_at']) ?></span>
                        </div>
                    </div>

                    <div class="post-title">
                        <h1><?= htmlspecialchars($post['title']) ?></h1>
                    </div>
                    <div class="post-caption">
                        <p><strong><?= htmlspecialchars($post['caption']) ?></strong></p>
                    </div>

                    <div class="post-media-container">
                        <?php if (!empty($post['image'])): ?>
                            <div class="post-image-container">
                                <img src="public/<?= $post['image'] ?>" alt="Post Image" class="main-post-image">
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($post['video'])): ?>
                            <div class="post-video-container">
                                <video controls class="main-post-video">
                                    <source src="public/<?= $post['video'] ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news posts available at the moment.</p>
        <?php endif; ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 MINSU News Bulletin. All Rights Reserved.</p>
</footer>

<script>
    function toggleDropdown() {
        document.getElementById("dropdownMenu").classList.toggle("show");
    }

    function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
            window.location.href = "/logout";
        }
    }
</script>
</body>
</html>
