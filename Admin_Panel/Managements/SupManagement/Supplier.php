<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Cylon Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        /* (CSS styles unchanged) */
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
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .custom-card {
            animation: fadeIn 0.5s ease forwards;
        }
        
        .custom-card:nth-child(1) { animation-delay: 0.1s; }
        .custom-card:nth-child(2) { animation-delay: 0.2s; }
        .custom-card:nth-child(3) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo-container">
                <div class="logo-frame">
                    <img src="../assets/pic/logo2.png" alt="Company Logo" class="logo">
                </div>
            </div>
            <a href="../AdminDash/admindash.php" class="nav-item">
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

        <div class="main-content">
            <div class="header">
                <h1 class="welcome-text">
                    Suppllier management system
                    <span class="loading-dots">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </span>
                </h1>
                <div class="admin-profile">
                    <img src="../assets/pic/admin.png" alt="Admin Profile" class="admin-pic">
                    <span class="admin-name">New User</span>
                </div>
            </div>

            <div class="employee-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="custom-card">
                            <h2 class="card-title">
                                <i class="fas fa-truck me-2"></i>
                                Supplier
                            </h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Add new Supplier button -->
                                    <button class="custom-btn" onclick="window.location.href='../../../Employee_Panel/Supplier/addsup/addsup.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <span>Add new supplier</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                    <!-- End of add new supplier -->
                                </div>

                                <div class="col-md-6">
                                    <!-- View Supplier Buttton -->
                                    <button class="custom-btn" onclick="window.location.href='../../../Employee_Panel/Supplier/viewsup/viewsup.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                        <span>View (Update / Delete)</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                    <!-- End of view supplier -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Add new Supplier invoice -->
                                    <button class="custom-btn" onclick="window.location.href='../../../Employee_Panel/Supplier/addSupInvocie.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <span>Add new supplier Invoice</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                    <!-- End of Supplier invoicer -->
                                </div>

                            </div>

                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <button class="custom-btn" onclick="window.location.href='Supplier/upsup/upsup.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-edit"></i>
                                        </div>
                                        <span>Update supplier</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="custom-btn" onclick="window.location.href='Supplier/delsup/delsup.php';">
                                        <div class="icon-container">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                        <span>Delete supplier</span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
