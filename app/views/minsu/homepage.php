<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - MINSU News Bulletin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/homepage.css">
    <style>
        .dropdown-menu.show {
            display: block;
        }

        /* Banner styling */
        .banner {
            width: 1300px;
            height: 500px; /* Increase the height to ensure it's fully visible */
            background: url('public/images/background.jpg') no-repeat center center/cover;
            background-size: cover;
            position: center; /* To position text inside */
            z-index: 1; /* Ensure it's above other content */
            margin-top: 110px;
           margin-left: -195px;
        }

        .banner-text {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-size: 28px; /* Increased font size for better visibility */
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            margin-top: 0; /* Remove unnecessary margin-top */
        }

        .main {
            margin-top: 60px;
            padding: 20px 30px;
            color: #fff;
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

        .video-container {
            text-align: center;
            margin: 40px auto;
            max-width: 900px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px var(--card-shadow);
        }

        .video-container h2 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .responsive-video {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .video-container p {
            color: var(--text-color);
            font-size: 16px;
            margin-top: 10px;
        }

        .intro-section {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px var(--card-shadow);
            margin-top: 20px;
        }

        .intro-section h1 {
            color: var(--primary-color);
            font-size: 24px;
            margin-bottom: 10px;
        }

        .intro-section p {
            color: var(--text-color);
            font-size: 16px;
            line-height: 1.8;
        }

        .slideshow-container {
            position: relative;
            max-width: 950px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 8px var(--card-shadow);
            text-align: center;
            overflow: hidden;
        }

        .slide {
            display: none;
            animation: fadeEffect 1.5s ease-in-out;
            height: 250px;
            padding: 20px;
            box-sizing: border-box;
        }

        .slide h2 {
            color: var(--primary-color);
            margin-bottom: 10px;
            font-size: 24px;
        }

        .slide p, .slide ul {
            color: var(--text-color);
            font-size: 16px;
            margin-top: 10px;
            text-align: justify;
        }

        .dots-container {
            text-align: center;
            margin-top: 15px;
        }

        .dot {
            height: 12px;
            width: 12px;
            margin: 0 5px;
            background-color: var(--card-shadow);
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .dot.active, .dot:hover {
            background-color: var(--primary-color);
        }

        @keyframes fadeEffect {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
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
                <a href="#" onclick="confirmLogout()">Logout</a>
            </div>
        </div>
    </div>

    <!-- Banner Section -->
    <div class="banner">
    </div>

    <div class="main">
        <div class="intro-section">
            <h1>Welcome to the MINSU Bulletin</h1>
            <p>
                The <strong>MINSU Bulletin</strong> serves as your trusted platform for comprehensive news and updates, 
                celebrating the vibrant community of Mindoro State University. From the latest campus happenings to 
                inspiring stories, featured videos, and event highlights, we aim to keep students, faculty, and 
                stakeholders well-informed and engaged.
            </p>
            <p>
                Explore our latest news, share your stories, and connect with the thriving MINSU community.
            </p>
        </div>

        <div class="video-container">
            <h2>Mindoro State University Hymn</h2>
            <video controls poster="public/video/video-thumbnail.jpg" class="responsive-video">
                <source src="public/video/AQP0xtpa0P9HTQEZe4f4m-n8lAI5zJoAhqk0WomS9QYAfRav6RHd9cUuphElqYim9mV4WUNXZflMc-BbmgqJv4E_.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <p>Raise your voice throughout the land...</p>
        </div>

        <div class="slideshow-container">
            <div class="slide fade">
                <h2>Vision</h2>
                <p>The Mindoro State University is a center of excellence in agriculture...</p>
            </div>
            <div class="slide fade">
                <h2>Mission</h2>
                <p>The University commits to produce 21st-century skilled lifelong learners...</p>
            </div>
            <div class="slide fade">
                <h2>Goals</h2>
                <p>Provide and broaden the access to quality education...</p>
            </div>
        </div>
        <div class="dots-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
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

        let slideIndex = 0;

        function showSlides() {
            const slides = document.querySelectorAll(".slide");
            const dots = document.querySelectorAll(".dot");
            slides.forEach(slide => slide.style.display = "none");
            dots.forEach(dot => dot.classList.remove("active"));

            slideIndex++;
            if (slideIndex > slides.length) slideIndex = 1;

            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].classList.add("active");

            setTimeout(showSlides, 5000); // Change slide every 5 seconds
        }

        function currentSlide(n) {
            slideIndex = n - 1;
            showSlides();
        }

        showSlides(); // Initialize the slideshow
    </script>
</body>
</html>
