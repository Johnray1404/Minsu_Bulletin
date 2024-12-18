<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/public/styles/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

        /* Stats Section */
        .dashboard-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            width: 48%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-top: 70px;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .stat-card h3 {
            font-size: 18px;
            color: #2c3e50;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
            color: #16a085;
        }

        .stat-card i {
            font-size: 40px;
            color: #16a085;
        }

        /* Chart Section */
        .chart-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        canvas {
            max-width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-stats {
                flex-direction: column;
                align-items: center;
            }

            .stat-card {
                width: 100%;
                margin-bottom: 20px;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <div class="sidebar">
        <img src="/public/images/minsu.jpg" alt="MINSU Logo">
        <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="/admin/news"><i class="fas fa-newspaper"></i>News</a>
        <a href="/admin/accounts"><i class="fas fa-users-cog"></i>User Accounts</a>
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

        <!-- Dashboard Stats Section -->
        <div class="dashboard-stats">
            <!-- User Login Today Card -->
            <div class="stat-card">
                <h3>Users Logged In Today</h3>
                <p><?php echo $today_login_count; ?> Users</p>
                <i class="fas fa-users"></i>
            </div>

            <!-- Total Users Card -->
            <div class="stat-card">
                <h3>Total Users</h3>
                <p><?php echo $total_users; ?> Users</p>
                <i class="fas fa-users-cog"></i>
            </div>
        </div>

        <!-- Chart for Users Logged In Per Day -->
        <div class="chart-container">
            <canvas id="loginChart"></canvas>
        </div>

    </div>

</div>

<script>
    // Data for the chart passed from PHP
    const dates = <?php echo json_encode($dates); ?>;
    const logins = <?php echo json_encode($logins); ?>;

    // Chart.js code to render the chart
    const ctx = document.getElementById('loginChart').getContext('2d');
    const loginChart = new Chart(ctx, {
        type: 'line', // Change to 'bar' for a bar chart
        data: {
            labels: dates, // X-axis labels (dates)
            datasets: [{
                label: 'Users Logged In',
                data: logins, // Y-axis data (number of logins)
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Logins'
                    },
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem) {
                            return `Logins: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });

    // Toggle the dropdown menu for user profile
    document.querySelector('.user-profile').addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        event.stopPropagation();
    });

    // Close the dropdown if clicked outside
    document.addEventListener('click', function(event) {
        var dropdownMenu = document.querySelector('.dropdown-menu');
        var userProfile = document.querySelector('.user-profile');
        if (!userProfile.contains(event.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    // Confirmation before logout
    function confirmLogout() {
        var userConfirm = confirm("Are you sure you want to log out?");
        if (userConfirm) {
            window.location.href = "/logout";
        }
    }
</script>

</body>
</html>
