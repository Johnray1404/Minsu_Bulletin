<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            padding-top: 150px;
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
        .profile-container {
            width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #4CAF50;
        }
        .profile-header .user-info {
            flex: 1;
            padding-left: 20px;
        }
        .profile-header h2 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }
        .profile-header p {
            margin: 5px 0;
            color: #777;
            font-size: 16px;
        }
        .upload-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .upload-btn:hover {
            background-color: #45a049;
        }
        .post-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 30px; /* Adds space on top */
       }

        .posts-wrapper {
            width: 100%; /* Make the wrapper take the full width of the parent */
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px; /* Space between each post */
        }

        .post-container {
            width: 600px; /* Make each post container take up 80% of the page width */
            max-width: 800px; /* Max width to prevent it from getting too wide */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 10px 0; /* Adds vertical margin between posts */
        }

        .post-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .post-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .post-title h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        .post-content p {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .post-media img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        .like-button {
        cursor: pointer;
        font-size: 16px;
        border: none;  
        outline: none; 
        background: none;  
        }
        .like-button.liked {
            color: var(--accent-color);  
            font-weight: bold; 
        }
        .like-button:focus {
            outline: none;  
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

            <div class="profile-container">
                <div class="profile-header">
                    <img src="public/<?php echo !empty($data['user']['profile_pic']) ? $data['user']['profile_pic'] : 'default-profile.jpg'; ?>" alt="Profile Picture">
                    <div class="user-info">
                        <h2><?php echo htmlspecialchars($data['user']['username'] ?? 'Unknown User'); ?></h2>
                        <p><?php echo htmlspecialchars($data['user']['email'] ?? 'No email provided'); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($data['user']['location'] ?? 'Not Set'); ?></p>
                        <a href="javascript:void(0);" class="upload-btn" onclick="document.getElementById('profilePicInput').click();">
                            <i class="fas fa-camera"></i>
                            <?php if (!empty($data['user']['profile_pic'])): ?>
                                Change Profile Picture
                            <?php else: ?>
                                Upload Profile Picture
                            <?php endif; ?>
                        </a>
                        <input type="file" id="profilePicInput" style="display: none;" onchange="uploadProfilePic()" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="post-list">
                <h3>Your Posts</h3>
                <?php if (!empty($data['posts'])): ?>
                    <!-- All posts are directly in the post-list container -->
                    <?php foreach ($data['posts'] as $post): ?>
                        <div class="post-container" id="post-<?php echo $post['id']; ?>">
                            <div class="post-header">
                                <img src="public/<?php echo htmlspecialchars($post['profile_pic'] ?? 'default-profile.jpg'); ?>" alt="Profile Picture">
                                <div class="post-info">
                                    <span class="username"><?php echo htmlspecialchars($post['username'] ?? 'Unknown User'); ?></span>
                                    <div class="post-meta">
                                        <span><i class="fas fa-clock"></i> <?php echo $post['time_ago'] ?? 'Just now'; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="post-title">
                                <h1><?php echo htmlspecialchars($post['post_title'] ?? 'No Title'); ?></h1>
                            </div>
                            <div class="post-content">
                                <p><?php echo nl2br(htmlspecialchars($post['post_caption'] ?? 'No caption available')); ?></p>
                                <?php if (!empty($post['post_mediafile'])): ?>
                                    <div class="post-media">
                                        <img src="public/<?php echo htmlspecialchars($post['post_mediafile'] ?? ''); ?>" alt="Post Media">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="like-section">
                                <button class="like-button <?= $post['user_liked'] ? 'liked' : '' ?>" onclick="togglePostLike(<?= $post['id'] ?>, this)">
                                    <i class="fas fa-thumbs-up"></i> Like
                                </button>
                                <span id="like-count-<?= $post['id'] ?>"><?= $post['like_count'] ?> likes</span>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No posts available.</p>
                <?php endif; ?>
            </div>

            <script>
                function uploadProfilePic() {
                    const fileInput = document.getElementById('profilePicInput');
                    const formData = new FormData();
                    formData.append('profile_pic', fileInput.files[0]);

                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/userProfile', true);  // Make sure the correct endpoint is used
                    xhr.onload = function() {
                        const response = JSON.parse(xhr.responseText);
                        if (xhr.status === 200 && response.success) {
                            alert(response.message);  // Success
                            location.reload();
                        } else {
                            alert(response.message);  // Error message
                        }
                    };
                    xhr.send(formData);
                }

                function toggleDropdown() {
                    var dropdown = document.getElementById('dropdownMenu');
                    dropdown.classList.toggle('show');
                }

                function confirmLogout() {
                    if (confirm("Are you sure you want to logout?")) {
                        window.location.href = "/";
                    }
                }
                function togglePostLike(postId, element) {
                    $.ajax({
                url: '/minsu/toggle_post_like',  // Ensure the URL is correct (adjust the path if necessary)
                type: 'POST',
                data: {
                    post_id: postId,
                    user_id: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0; ?>
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'success') {
                        // Update like count and change button state
                        $('#like-count-' + postId).text(data.like_count + ' likes');
                        $(element).toggleClass('liked', data.action === 'added');
                    } else {
                        alert('Error: ' + data.message);
                    }
                },
                error: function() {
                    alert('Error while toggling like');
                }
            });
            }
     </script>
</body>
</html>
