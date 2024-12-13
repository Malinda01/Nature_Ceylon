<!-- employee dashboard -->

<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['EUsername'])) {
    header('Location: ../Login_Employee/login.html'); // Redirect to login if not logged in
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
    <link rel="stylesheet" href="../Admin_Panel/Managements/assets/css/main.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* (CSS styles unchanged) */
        header,
        footer {
            background: linear-gradient(90deg, #3d8c40, #7ab23a);
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        header {
            position: relative;
        }

        /* (CSS styles unchanged) */
        header,
        footer {
            background: linear-gradient(90deg, #3d8c40, #7ab23a);
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        header {
            position: relative;
        }

        .main-content {
            margin-left: 0%;
        }

        .custom-card {
            border: none;
            border-radius: 25px;
            padding: 2rem;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .custom-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color: #2c3e50;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.8rem;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
            border-radius: 2px;
        }

        .custom-btn {
            background: linear-gradient(90deg, #4CAF50, #8BC34A);
            color: white;
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            margin-bottom: 1rem;
            width: 100%;
            text-align: left;
            position: relative;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            overflow: hidden;
        }

        .custom-btn:hover {
            background: linear-gradient(90deg, #3d8c40, #7ab23a);
            transform: translateX(5px);
            color: white;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .custom-btn i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .custom-btn:hover i {
            transform: translateX(5px);
        }

        .icon-container {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .custom-btn span {
            flex-grow: 1;
        }

        .employee-container {
            padding: 2rem;
        }

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

        .custom-card {
            animation: fadeIn 0.5s ease forwards;
        }

        .custom-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .custom-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .custom-card:nth-child(3) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
    <header>
        <h1>Nature Ceylon</h1>
    </header>

    <div class="container">
        <div class="main-content">
            <div class="header">
                <h1 class="welcome-text">
                    Employee Management
                    <span class="loading-dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </span>
                </h1>
                <div class="admin-profile">
                    <a href="../Profiles/EmpProfile.php">
                        <img src="../Admin_Panel/Managements/assets/pic/admin.png" alt="Admin Profile" class="admin-pic">
                    </a>
                    <!-- Username loading using PHP -->
                    <span class="admin-name">Hello! , <?php echo htmlspecialchars($username); ?></span>
                </div>
            </div>

            <div class="employee-container">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Leave section -->
                        <div class="custom-card">
                            <h2 class="card-title">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Leave
                            </h2>
                            <div class="row">
                                <!-- Begining of View Leave -->
                                <div class="col-md-6">
                                    <button class="custom-btn" onclick="window.location.href='Employee/leave/viewleave.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <span>View Leave (Update / Delete)</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                                <!-- End of View Leave -->



                            </div>
                        </div>

                        <!-- Salary section -->
                        <div class="custom-card">
                            <h2 class="card-title">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Salary
                            </h2>

                            <div class="row">
                                <!-- Beginig of View Salary -->
                                <div class="col-md-6">
                                    <button class="custom-btn" onclick="window.location.href='Employee/salary/viewsal.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </div>
                                        <span>View Salary</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                                <!-- End of View Salary -->

                                <!-- Begining of Calculate Salary -->
                                <div class="col-md-6">
                                    <button class="custom-btn" onclick="window.location.href='Employee/salary/calsal.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-calculator"></i>
                                        </div>
                                        <span>Calculate Salary</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                                <!-- End of Calculate Salary -->

                            </div>
                        </div>

                        <a href="logout.php" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>