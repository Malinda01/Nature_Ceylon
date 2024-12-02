@ -0,0 +1,248 @@
<!-- PHP for Role asigning -->
<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['EUsername'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit();
}

// Retrieve the username from the session
$username = $_SESSION['EUsername'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Cylon Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        /* Card Styles */
        .card-custom {
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
            color: white;
            transition: transform 0.3s ease;
            padding: 1rem;
            /* Reduced padding inside the card */
            font-size: 14px;
            /* Reduced font size */
            width: 90%;
            /* Reduced the card width */
            margin: 0 auto;
            /* Center the cards if needed */
            display: flex;
            /* Flexbox to align content */
            flex-direction: column;
            /* Align content vertically */
            justify-content: center;
            /* Vertically center content */
            height: 100%;
            /* Ensure equal height */
        }

        /* Equal height for all cards in the grid */
        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-3 {
            flex: 0 0 22%;
            /* Adjusted width of each card */
            max-width: 22%;
            /* Set maximum width of each card */
            margin-bottom: 20px;
            /* Add space between rows of cards */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Ensure cards stretch equally */
        }

        /* Hover effect */
        .card-custom:hover {
            transform: scale(1.05);
            /* Slightly enlarge the card on hover */
        }

        /* Icon Styles */
        .icon-large {
            font-size: 2rem;
            /* Reduced icon size */
            margin-bottom: 5px;
            /* Reduced space below the icon */
        }

        /* Title Styles */
        .card-custom h5 {
            font-size: 16px;
            /* Reduced title font size */
        }

        /* Number Styles */
        .card-custom h2 {
            font-size: 20px;
            /* Reduced number font size */
            font-weight: bold;
            /* Bold number for emphasis */
        }

        /* Ensuring charts are correctly sized */
        .chart-container {
            background-color: #f4f4f4;
            border-radius: 10px;
            padding: 20px;
        }

        .chart-small {
            max-height: 300px;
        }

        /* Animation for custom cards */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Apply animation to custom cards */
        .custom-card {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Animation delay for each custom card */
        .custom-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .custom-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .custom-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        /* Responsive layout adjustments for smaller screens */
        @media (max-width: 768px) {
            .col-md-3 {
                flex: 0 0 48%;
                /* Adjust the width for smaller screens */
                max-width: 48%;
            }
        }

        @media (max-width: 576px) {
            .col-md-3 {
                flex: 0 0 100%;
                /* Make the cards stack vertically on very small screens */
                max-width: 100%;
            }
        }
    </style>
</head>

<!-- Body section starts here!! -->

<body>
    <div class="container">

        <!-- Begining of the side bar -->
        <div class="sidebar">
            <div class="logo-container">
                <div class="logo-frame">
                    <img src="../assets/pic/logo2.png" alt="Company Logo" class="logo">
                </div>
            </div>
            <a href="../AdminDash/admindash.html" class="nav-item">
                <i class="fas fa-gauge"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            <a href="../EmpManagement/Employee.html" class="nav-item">
                <i class="fas fa-user-tie"></i>
                <span class="nav-text">Employee</span>
            </a>
            <a href="../InvManagement/Inventory.html" class="nav-item">
                <i class="fas fa-boxes"></i>
                <span class="nav-text">Inventory</span>
            </a>
            <a href="../SupManagement/Supplier.html" class="nav-item">
                <i class="fas fa-truck-loading"></i>
                <span class="nav-text">Suppliers</span>
            </a>
            <a href="../SalesManagement/Sales.html" class="nav-item">
                <i class="fas fa-chart-line icon-space"></i>
                <span class="nav-text">Sales</span>
            </a>
            <a href="../OrderManagement/Order.html" class="nav-item">
                <i class="fas fa-shopping-cart icon-space"></i>
                <span class="nav-text">Order</span>
            </a>
            <a href="../Reports/Report.html" class="nav-item">
                <i class="fas fa-file-alt"></i>
                <span class="nav-text">Reports</span>
            </a>
            <a href="../POS/POS.html" class="nav-item">
                <i class="fas fa-cash-register"></i>
                <span class="nav-text">POS</span>
            </a>
            <a href="../Returns/Returns.html" class="nav-item">
                <i class="fas fa-tags icon-space"></i>
                <span class="nav-text">Returns</span>
            </a>
            <a href="../FinanceManagement/Finance.html" class="nav-item">
                <i class="fas fa-money-bill-alt"></i>
                <span class="nav-text">Finance</span>
            </a>

            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
        <!-- End of side bar -->

        <div class="main-content">
            <div class="header">

                <h1 class="welcome-text">
                    Nature Cylon Admin Dashboard
                    <span class="loading-dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </span>
                </h1>


                <!-- Begining Admin profile and the username -->
                <div class="admin-profile">
                    <img src="../assets/pic/admin.png" alt="Admin Profile" class="admin-pic">
                    <span class="admin-name">Hello,  <?php echo htmlspecialchars($username); ?></span>
                </div>
                <!-- End Admin profile and the username -->

            </div>

            <div class="employee-container">
                <div class="container-fluid p-4">

                    <!-- Overview Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-users icon-large"></i>
                                <h5>Total Employees</h5>
                                <h2 class="fw-bold">124</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-box icon-large"></i>
                                <h5>Total Products</h5>
                                <h2 class="fw-bold">456</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-truck icon-large"></i>
                                <h5>Total Suppliers</h5>
                                <h2 class="fw-bold">78</h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-shopping-cart icon-large"></i>
                                <h5>Completed Orders</h5>
                                <h2 class="fw-bold">1205</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <h3 class="mb-4">Monthly Performance</h3>
                                <canvas id="performanceChart" class="chart-small"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <h3 class="mb-4">Product Category Distribution</h3>
                                <canvas id="productPieChart" class="chart-small"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js for charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Bar Chart Configuration
        const barCtx = document.getElementById('performanceChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                        label: 'Sales',
                        data: [35, 42, 48, 55, 62],
                        backgroundColor: '#FF6384'
                    },
                    {
                        label: 'Products',
                        data: [24, 30, 35, 40, 45],
                        backgroundColor: '#36A2EB'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Volume'
                        }
                    }
                }
            }
        });

        // Product Category Pie Chart
        const productPieCtx = document.getElementById('productPieChart').getContext('2d');
        new Chart(productPieCtx, {
            type: 'pie',
            data: {
                labels: ['Black tea', 'hot tea', 'tea new', '', 'Others'],
                // assign veriable and apply real valuses
                datasets: [{
                    data: [30, 25, 20, 15, 10],
                    backgroundColor: [
                        '#FF6384', // Vibrant Pink
                        '#36A2EB', // Bright Blue
                        '#4BC0C0', // Teal
                        '#FFCE56', // Soft Yellow
                        '#9966FF' // Lavender Purple
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>

</html>