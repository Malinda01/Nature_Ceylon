@ -0,0 +1,248 @@
<!-- PHP for Role asigning -->
<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count total employees
$sql = "SELECT COUNT(*) as total_employees FROM employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $total_employees = $row['total_employees'];
} else {
    $total_employees = 0;
}
// End of query to count total employees

// Query to count total employees
$sql = "SELECT COUNT(*) as total_prod FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $total_prod = $row['total_prod'];
} else {
    $total_prod = 0;
}
// End of query to count total employees


// start of total Suppliers
$sql = "SELECT COUNT(*) as total_sup FROM supplier";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $total_supplier = $row['total_sup'];
} else {
    $total_supplier = 0;
}
// end of total suppleirs

// start of total orders
$sql = "SELECT COUNT(*) as total_order FROM online_order";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the result
    $row = $result->fetch_assoc();
    $total_order = $row['total_order'];
} else {
    $total_supplier = 0;
}
// end of total orders



$conn->close();

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
            <!-- Logo -->
            <div class="logo-container">
                <div class="logo-frame">
                    <img src="../assets/pic/logo2.png" alt="Company Logo" class="logo">
                </div>
            </div>

            <!-- Page links -->
            <!-- Admin Dashboard -->
            <a href="../AdminDash/admindash.php" class="nav-item">
                <i class="fas fa-gauge"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <!-- Employee Dash Board -->
            <a href="../EmpManagement/Employee.php" class="nav-item">
                <i class="fas fa-user-tie"></i>
                <span class="nav-text">Employee</span>
            </a>

            <!-- Inventory Management -->
            <a href="../InvManagement/Inventory.php" class="nav-item">
                <i class="fas fa-boxes"></i>
                <span class="nav-text">Inventory</span>
            </a>

            <!-- Supplier Management -->
            <a href="../SupManagement/Supplier.php" class="nav-item">
                <i class="fas fa-truck-loading"></i>
                <span class="nav-text">Suppliers</span>
            </a>

            <!-- Sales Management -->
            <a href="../SalesManagement/Sales.php" class="nav-item">
                <i class="fas fa-chart-line icon-space"></i>
                <span class="nav-text">Sales</span>
            </a>

            <!-- Order Management -->
            <a href="../OrderManagement/Order.php" class="nav-item">
                <i class="fas fa-shopping-cart icon-space"></i>
                <span class="nav-text">Order</span>
            </a>

            <!-- Reports - Owner -->
            <a href="../Reports/Report.php" class="nav-item">
                <i class="fas fa-file-alt"></i>
                <span class="nav-text">Reports</span>
            </a>

            <!-- POS -->
            <a href="../POS/POS.php" class="nav-item">
                <i class="fas fa-cash-register"></i>
                <span class="nav-text">POS</span>
            </a>

            <!-- Returns -->
            <a href="../Returns/Returns.php" class="nav-item">
                <i class="fas fa-tags icon-space"></i>
                <span class="nav-text">Returns</span>
            </a>

            <!-- Finance Management -->
            <a href="../FinanceManagement/Finance.php" class="nav-item">
                <i class="fas fa-money-bill-alt"></i>
                <span class="nav-text">Finance</span>
            </a>

            <!-- Logout Button -->
            <a href="logout.php" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>

        </div>
        <!-- End of side bar -->

        <!-- Main content -->
        <div class="main-content">

            <!-- Begining of Heading section -->
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
                    <span class="admin-name">Hello, <?php echo htmlspecialchars($username); ?></span>
                </div>
                <!-- End Admin profile and the username -->

            </div>
            <!-- End of Heading section -->

            <!-- Employee Container -->
            <div class="employee-container">
                <!-- Charts and cards -->
                <div class="container-fluid p-4">

                    <!-- Overview Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <!-- Employees -->
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-users icon-large"></i>
                                <h5>Total Employees</h5>
                                <h2 class="fw-bold"><?php echo $total_employees; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Products -->
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-box icon-large"></i>
                                <h5>Total Products</h5>
                                <h2 class="fw-bold"><?php echo $total_prod; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Suppliers -->
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-truck icon-large"></i>
                                <h5>Total Suppliers</h5>
                                <h2 class="fw-bold"><?php echo $total_supplier; ?></h2>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Orders -->
                            <div class="card card-custom text-center p-3">
                                <i class="fas fa-shopping-cart icon-large"></i>
                                <h5>Completed Orders</h5>
                                <h2 class="fw-bold"><?php echo $total_order; ?></h2>
                            </div>
                        </div>
                    </div>
                    <!-- End of overview cards -->
                </div>
            </div>
            <!-- End of employee container -->
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