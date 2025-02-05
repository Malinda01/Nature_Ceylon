<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];




    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customer (FName, LName, Username, E_Mail, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $fname, $lname, $uname, $email, $pass);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Ceylon - Authentication</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .auth-container {
            height: 100vh;
        }

        .video-background {
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .video-background video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            z-index: 1;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: rgba(0, 128, 0, 0.5);
            z-index: 2;
        }

        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 3;
            color: white;
            display: flex;
            align-items: center;
            animation: fadeInDown 1s;
        }

        .logo-container img {
            height: 50px;
            margin-right: 10px;
        }

        .form-section {
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding: 40px;
            overflow-y: auto;
        }

        .auth-form {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 40px;
            animation: fadeIn 1.5s;
        }

        .nav-pills .nav-link.active {
            background-color: #2c8f2c;
        }

        .form-control {
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(44, 142, 44, 0.25);
            border-color: #2c8f2c;
        }

        .btn-primary {
            background-color: #2c8f2c;
            border-color: #2c8f2c;
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1a5c1a;
            border-color: #1a5c1a;
            transform: translateY(-3px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-login .btn {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-login .btn:hover {
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid auth-container">
        <div class="row h-100">
            <!-- Video Background Section -->
            <div class="col-md-6 video-background p-0">
                <video autoplay muted>
                    <source src="ASSETS/MEDIA/login.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>


            </div>

            <!-- Authentication Form Section -->
            <div class="col-md-6 form-section">
                <div class="auth-form">
                    <!-- Tabs for Sign In and Sign Up -->
                    <ul class="nav nav-pills nav-fill mb-4" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="signin-tab" data-bs-toggle="tab" data-bs-target="#signin" type="button" role="tab">
                                <i class="bi bi-box-arrow-in-right"></i> Sign In
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="signup-tab" data-bs-toggle="tab" data-bs-target="#signup" type="button" role="tab">
                                <i class="bi bi-person-plus"></i> Sign Up
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="authTabsContent">
                        <!-- Sign In Tab -->
                        <div class="tab-pane fade show active" id="signin" role="tabpanel">
                            <!-- Sign In Form -->
                            <div class="col-md-6 form-section">
                                <div class="auth-form">
                                    <h2 class="text-center">Login</h2>
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif; ?>
                                    <form method="post" action="login.php">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">
                                                <i class="bi bi-person"></i> Username
                                            </label>
                                            <input type="text" id="username" name="Username" class="form-control" placeholder="Enter your username" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">
                                                <i class="bi bi-lock"></i> Password
                                            </label>
                                            <input type="password" id="password" name="Password" class="form-control" placeholder="Enter your password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Login</button>
                                    </form>
                                </div>
                            </div>
                            <!-- end of sign in -->
                        </div>


                        <!-- Sign Up Tab -->
                        <div class="tab-pane fade" id="signup" role="tabpanel">

                            <!-- Signup form -->
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="firstName" class="form-label">
                                            <i class="bi bi-person"></i> First Name
                                        </label>
                                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name" name="fname" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="lastName" class="form-label">
                                            <i class="bi bi-person"></i> Last Name
                                        </label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name" name="lname" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="signupUsername" class="form-label">
                                        <i class="bi bi-at"></i> Username
                                    </label>
                                    <input type="text" class="form-control" id="signupUsername" placeholder="Choose a unique username" name="uname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="signupEmail" class="form-label">
                                        <i class="bi bi-envelope"></i> Email Address
                                    </label>
                                    <input type="email" class="form-control" id="signupEmail" placeholder="Enter your email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="signupPassword" class="form-label">
                                        <i class="bi bi-lock"></i> Password
                                    </label>
                                    <input type="password" class="form-control" id="signupPassword" placeholder="Create a password" name="pass" required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">
                                        <i class="bi bi-lock-fill"></i> Confirm Password
                                    </label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Repeat password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="termsAgree" required>
                                    <label class="form-check-label" for="termsAgree">
                                        I agree to the terms and conditions
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Create Account</button>
                            </form>
                            <!-- end of form -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>