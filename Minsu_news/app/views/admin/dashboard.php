<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">
</head>
<body>

<div class="container">

    <div class="sidebar">
        <img src="/public/images/minsu.jpg" alt="MINSU Logo">
        <a href="/dashboard"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="/admin/news"><i class="fas fa-newspaper"></i>News</a>
        <a href="/postrequest"><i class="fas fa-edit"></i>PostRequest</a>
        <a href="/manageaccount"><i class="fas fa-users-cog"></i>Manage Account</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Admin Dashboard</h1>
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
            <h2>Welcome, Admin!</h2>
            <p>Manage Minsu University News Bulletin efficiently and stay updated with the latest activity.</p>
            <br><br>
            <div class="stats-overview">
                <div class="stat-box">
                    <h3>Today's News Posts</h3>
                    <p>5 New Posts</p>
                </div>
                <div class="stat-box">
                    <h3>Active Users</h3>
                    <p>1,200 Users</p>
                </div>
                <div class="stat-box">
                    <h3>Pending Requests</h3>
                    <p>3 Post Requests</p>
                </div>
            </div>

            <section class="recent-activity">
                <h3>Recent News Posts</h3>
                <ul>
                    <li><a href="#">University Event Update - March 2024</a></li>
                    <li><a href="#">Research Paper Submission Deadline</a></li>
                    <li><a href="#">Student Council Election Results</a></li>
                </ul>
            </section>

            <section class="notifications">
                <h3>Notifications</h3>
                <ul>
                    <li>Reminder: Upcoming deadline for event submissions!</li>
                    <li>New feature added: Comment Moderation tool</li>
                </ul>
            </section>
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
