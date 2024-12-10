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
            background-color:#AFE1AF;
            font-family: var(--font-family);
            margin: 0;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            line-height: 1.6;
            padding-left: 220px; /* Adjust padding for the left sidebar */
            padding-right: 220px; /* Adjust padding for the right sidebar */
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
        background-color: var(--secondary-color);
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
    background-color: var(--secondary-color);
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
    background-color: var(--secondary-color);
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 8px var(--card-shadow);
    text-align: center;
    overflow: hidden;
}

.slide {
    display: none;
    animation: fadeEffect 1.5s ease-in-out;
    height: 250px; /* Set a fixed height for uniformity */
    padding: 20px; /* Add consistent padding */
    box-sizing: border-box; /* Ensure padding is included in the height */
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
.ad-slideshow-container {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    width: 200px;
    height: 300px;
    z-index: 999;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.ad-slide {
    display: none;
    width: 100%;
    height: 100%;
}

.ad-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.ad-slideshow-container.left {
    left: 0;
}

.ad-slideshow-container.right {
    right: 0;
}
.sidebar {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    width: 200px;
    height: 520px;
    z-index: 999;
    background-color: var(--secondary-color);
    box-shadow: 0 4px 8px var(--card-shadow);
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden; /* To ensure image does not overflow */
}

.sidebar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
}

.left-sidebar {
    left: 0;
}

.right-sidebar {
    right: 0;
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
        <h2>Mindoro State University Hymn </h2>
        <video controls poster="public/video/video-thumbnail.jpg" class="responsive-video">
            <source src="public/video/AQP0xtpa0P9HTQEZe4f4m-n8lAI5zJoAhqk0WomS9QYAfRav6RHd9cUuphElqYim9mV4WUNXZflMc-BbmgqJv4E_.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <p>Raise your voice throughout the land
We have MinSU forever Bring the truth and wisdom fore
Our Unyielding Spirits Soar
A humble few, to till the land
Wishing all the world could share
It's our goal to shape and teach
Every willing arms to reach
We have planted all the seeds
and the yield are all our dreams
Reaching with our might
Even through the night
We have MinSU in our hearts
Let us sing our blessed hymn
Making MinSU are true home
Throughout the world our feet will tread
But our hearts would say instead
We have planted all the seeds
and the yield are all our dreams
Reaching with our might
Even through the night
We have MinSU in our hearts
We have planted all the seeds
and the yield are all our dreams
Reaching with our might
Even through the night
We have MinSU in our hearts
Reaching with our might
Even through the night
We have MinSU in our hearts</p>
    </div><div class="slideshow-container">
    <div class="slide fade">
        <h2>Vision</h2>
        <p>The Mindoro State University is a center of excellence in agriculture and fishery, science, technology, culture and education of globally competitive lifelong learners in diverse yet cohesive society.</p>
    </div>
    <div class="slide fade">
        <h2>Mission</h2>
        <p>The University commits to produce 21st-century skilled lifelong learners and generates and commercializes innovative technologies by providing excellent and relevant services in instruction, research, extension, and production through industry-driven curricula, collaboration, internationalization, and continual organizational growth for sustainable development.</p>
    </div>
    <div class="slide fade">
        <h2>Goals</h2>
        <p></p>
        <p>Provide and broaden the access to quality education responsive to an ever growing and dynamic society.</p>
    </div>
</div>
<!-- Left Sidebar with Random Image -->
<div class="sidebar left-sidebar">
    <img id="randomLeftImage" alt="Random Left Image">
</div>

<!-- Right Sidebar with Random Image -->
<div class="sidebar right-sidebar">
    <img id="randomRightImage" alt="Random Right Image">
</div>
<div class="dots-container">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>


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
 // Array of image filenames for the sidebars
 const leftImages = [
        "public/images/add1.png", 
        "public/images/add2.png", 
        "public/images/add3.png", 
        "public/images/add4.png"  // Add more images as needed
    ];

    const rightImages = [
        "public/images/add2.png", 
        "public/images/add4.png", 
        "public/images/add1.png", 
        "public/images/add3.png"  // Add more images as needed
    ];

    // Function to get a random image from an array of images
    function getRandomImage(imagesArray) {
        const randomIndex = Math.floor(Math.random() * imagesArray.length);
        return imagesArray[randomIndex];
    }

    // Assign random images to the left and right sidebars
    document.getElementById("randomLeftImage").src = getRandomImage(leftImages);
    document.getElementById("randomRightImage").src = getRandomImage(rightImages);

showSlides(); // Initialize the slideshow
    
    
</script>
</body>
</html>