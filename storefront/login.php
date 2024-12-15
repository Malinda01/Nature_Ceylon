<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'malinda_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT Username, Password FROM customer WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($dbUsername, $dbPassword);
    $stmt->fetch();

    // Verify password
    if ($stmt->num_rows > 0 && $password === $dbPassword) {
        $_SESSION['Username'] = $dbUsername;
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Ceylon - Authentication</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Your old form's styles here */
        body, html { height: 100%; margin: 0; font-family: 'Arial', sans-serif; }
        .auth-container { height: 100vh; }
        .video-background { position: relative; height: 100%; overflow: hidden; }
        .video-background video { position: absolute; top: 50%; left: 50%; min-width: 100%; min-height: 100%; width: auto; height: auto; transform: translateX(-50%) translateY(-50%); z-index: 1; object-fit: cover; }
        .video-overlay { position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0, 128, 0, 0.5); z-index: 2; }
        .form-section { background-color: #f8f9fa; display: flex; flex-direction: column; justify-content: center; height: 100%; padding: 40px; overflow-y: auto; }
        .auth-form { background-color: white; border-radius: 15px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); padding: 40px; }
        .btn-primary { background-color: #2c8f2c; border-color: #2c8f2c; border-radius: 20px; }
        .btn-primary:hover {
    background-color: #1a5c1a; /* Your desired hover color */
    border-color: #1a5c1a;    /* Optional: Match the border color */
    transform: translateY(-3px); /* Optional: Add a hover effect like slight elevation */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for a stylish effect */
}

    </style>
</head>

<body>
    <div class="container-fluid auth-container">
        <div class="row h-100">
            <!-- Video Background Section -->
            <div class="col-md-6 video-background p-0">
                <video autoplay muted >
                    <source src="MEDIA/login.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <!-- Authentication Form Section -->
            <div class="col-md-6 form-section" >
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
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
