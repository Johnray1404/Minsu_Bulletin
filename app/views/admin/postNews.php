<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post News - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">
</head>
<body>

<div class="sidebar">
    <img src="/public/images/minsu.jpg" alt="MINSU Logo">
    <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
    <a href="/admin/news"><i class="fas fa-newspaper"></i>News</a>
    <a href="/admin/accounts"><i class="fas fa-users-cog"></i>Manage Account</a>
</div>

<div class="main-content">
    <div class="header">
        <h1>Post News</h1>
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <div class="user-profile">
            <i class="fas fa-user-circle"></i>
            <div class="dropdown-menu">
                <a href="#">Admin <i class="fas fa-user-shield"></i></a>
                <a href="#" onclick="confirmLogout()">Logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>

    <div class="dashboard-content">
    <h2>Submit News Article</h2>

    <form action="/admin/post_news" method="POST" enctype="multipart/form-data" class="news-form">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter the title of the news" required>
    </div>

    <div class="form-group">
        <label for="caption">Caption</label>
        <textarea id="caption" name="caption" placeholder="Enter the caption of the news" rows="5" required></textarea>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*">
    </div>

    <div class="form-group">
        <label for="video">Video</label>
        <input type="file" id="video" name="video" accept="video/*">
    </div>

    <button type="submit" class="btn btn-primary">Post News</button>
</form>
</div>

<script>
    document.querySelector('.user-profile').addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation();
    });

    function confirmLogout() {
        var userConfirm = confirm("Are you sure you want to log out?");
        if (userConfirm) {
            window.location.href = "/logout";
        }
    }
</script>
</body>
</html>
