<?php
// Retrieve the username from the session
$email = $_SESSION['mail'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Nature Ceylon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="ASSETS/CSS/main.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="bi bi-leaf"></i> Nature Ceylon
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="main.html"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="ourtea.html"><i class="bi bi-cup"></i> Our Tea</a>
                    </li>
                    <!-- Cart Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="cart.html"><i class="bi bi-cart"></i> Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.html"><i class="bi bi-info-circle"></i> About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html"><i class="bi bi-envelope"></i> Contact</a>
                    </li>
                    <!-- Profile Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html"><i class="bi bi-person-circle"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section class="profile-section py-5 mt-5">
        <div class="container">
            <div class="row">
                <!-- User Information -->
                <div class="col-md-4 text-center">
                    <img src="https://via.placeholder.com/150" alt="User Avatar" class="rounded-circle img-fluid mb-4">
                    <h4>John Doe</h4>
                    <p class="text-muted">johndoe@example.com</p>
                </div>

                <!-- Update Details Form -->
                <div class="col-md-8">
                    <h2>Update Your Details</h2>
                    <form id="update-profile-form">
                        <div class="mb-3">
                            <label for="first-name" class="form-label">First Name</label>
                            <input type="text" id="first-name" class="form-control" placeholder="Enter your first name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last-name" class="form-label">Last Name</label>
                            <input type="text" id="last-name" class="form-control" placeholder="Enter your last name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Choose a username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email address" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" class="form-control" placeholder="Enter a new password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" id="confirm-password" class="form-control" placeholder="Re-enter your password" required>
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="confirm-updates" required>
                            <label class="form-check-label" for="confirm-updates">
                                I confirm that the above details are correct.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Details</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Logout Section -->
    <section class="logout-section py-4 bg-light text-center">
        <div class="container">
            <h3 class="mb-3">Ready to leave?</h3>
            <p class="text-muted">Click below to safely log out of your account.</p>
            <a href="logout.php" class="btn btn-danger btn-lg">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4">
        <div class="container text-center text-light">
            <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
            <div class="social-links mt-3">
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('update-profile-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }

            if (!document.getElementById('confirm-updates').checked) {
                alert('You must confirm that your details are correct.');
                return;
            }

            alert('Your details have been updated successfully!');
            // Add logic to save updated details to the database.
        });
    </script>
</body>
</html>
