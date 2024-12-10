<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">

    <style>
        .accounts-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
        }

        .account-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            width: 600px;
            margin: auto;
            margin-top: 30px;
        }

        .account-card img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .account-card .info {
            flex-grow: 1;
        }

        .account-card .info h4 {
            margin: 0;
            font-size: 20px;
        }

        .account-card .info p {
            margin: 5px 0;
            color: #555;
        }

        .account-card .actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .account-card .actions a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }

        .account-card .actions a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="/public/images/minsu.jpg" alt="MINSU Logo">
        <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/admin/news"><i class="fas fa-newspaper"></i> News</a>
        <a href="/admin/accounts"><i class="fas fa-users-cog"></i> User Accounts</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Accounts</h1>
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

        <div class="accounts-container">
            <?php if (isset($users) && !empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <div class="account-card">
                        <img src="/public/<?php echo $user['profile_pic'] ?: 'default-avatar.png'; ?>" alt="Profile Picture">
                        <div class="info">
                            <h4><?php echo htmlspecialchars($user['username']); ?></h4>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            <p><strong>Joined:</strong> <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.querySelector('.user-profile').addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation();
    });

    document.addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        var userProfile = document.querySelector('.user-profile');
        if (!userProfile.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
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
