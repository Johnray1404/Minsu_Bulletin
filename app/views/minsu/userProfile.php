<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
            width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .post-container {
            position: relative;
            margin-left: -20px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .post-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }
        .post-header .username {
            font-size: 18px;
            font-weight: bold;
        }
        .post-header .post-meta {
            margin-left: auto;
            color: #888;
            font-size: 14px;
        }
        .post-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .post-media img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 15px;
        }
        .three-dot-menu {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .three-dot-menu:hover {
            color: var(--hover-color);
        }
        .delete-option {
            display: none;
            position: absolute;
            top: 30px;
            right: 10px;
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        .delete-option.show {
            display: block;
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
<div class="profile-container">
    <div class="profile-header">
        <img src="public/<?php echo !empty($data['user']['profile_pic']) ? $data['user']['profile_pic'] : 'default-profile.jpg'; ?>" alt="Profile Picture">
        <div class="user-info">
            <h2><?php echo htmlspecialchars($data['user']['username']); ?></h2>
            <p><?php echo htmlspecialchars($data['user']['email']); ?></p>
            <p><strong>Location:</strong> <?php echo isset($data['user']['location']) ? htmlspecialchars($data['user']['location']) : 'Not Set'; ?></p>
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
        <?php foreach ($data['posts'] as $post): ?>
            <div class="post-container" id="post-<?php echo $post['id']; ?>">
                <div class="post-header">
                    <img src="public/<?php echo htmlspecialchars($post['profile_pic']); ?>" alt="Profile Picture">
                    <div class="post-info">
                        <span class="username"><?php echo htmlspecialchars($post['username']); ?></span>
                        <div class="post-meta">
                            <span><i class="fas fa-clock"></i> <?php echo $post['time_ago']; ?></span>
                        </div>
                    </div>
                    <div class="three-dot-menu" onclick="toggleDeleteOption(this)">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                    <div class="delete-option">
                        <a href="javascript:void(0);" onclick="deletePost(<?php echo $post['id']; ?>)">Delete</a>
                    </div>
                </div>
                <div class="post-title">
                    <h1><?php echo htmlspecialchars($post['post_title']); ?></h1>
                </div>
                <div class="post-content">
                    <p><?php echo nl2br(htmlspecialchars($post['post_caption'])); ?></p>
                    <?php if (!empty($post['post_mediafile'])): ?>
                        <div class="post-media">
                            <img src="public/<?php echo htmlspecialchars($post['post_mediafile']); ?>" alt="Post Media">
                        </div>
                    <?php endif; ?>
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
    function toggleDeleteOption(element) {
        const deleteOption = element.parentNode.querySelector('.delete-option');
        deleteOption.classList.toggle('show');
    }
    function deletePost(postId) {
        if (confirm("Are you sure you want to delete this post?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/deletePost", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("post-" + postId).remove();
                    } else {
                        alert("An error occurred while deleting the post.");
                    }
                }
            };
            xhr.send("postId=" + postId);
        }
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
</script>
</body>
</html>
