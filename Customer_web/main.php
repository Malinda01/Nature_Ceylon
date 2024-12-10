<?php
session_start();

// Retrieve the username from the session
$email = $_SESSION['mail'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Ceylon | Pure Ceylon Tea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="ASSETS/CSS/main.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
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
                        <a class="nav-link" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <!-- Background Video -->
        <video autoplay muted loop class="bg-video">
            <source src="ASSETS/MEDIA/landing.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Content Overlay -->
        <div class="container hero-content text-center text-light position-relative">

            <b><span class="admin-name">Hello, <?php echo htmlspecialchars($email); ?></span></b>

            <h1>Nature Ceylon</h1>
            <p>Discover the essence of pure Ceylon tea, crafted from the finest leaves of Sri Lanka.</p>
            <a href="ourtea.html" class="btn btn-lg btn-outline-light mt-4">
                <i class="bi bi-cup-hot"></i> Explore Our Teas
            </a>
        </div>
    </section>


    <!-- Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="container">



            <h2 class="text-center mb-5">
                <i class="bi bi-images text-muted me-3"></i>Our Featured Collection
            </h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="https://via.placeholder.com/600x400?text=Mountain+Landscape" alt="Mountain Landscape">
                    <div class="gallery-overlay">
                        <i class="bi bi-mountains"></i>
                        <h4>Alpine Majesty</h4>
                        <p>Peaks that touch the sky</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://via.placeholder.com/600x400?text=Forest+Scene" alt="Forest Scene">
                    <div class="gallery-overlay">
                        <i class="bi bi-tree"></i>
                        <h4>Forest Whispers</h4>
                        <p>Ancient woods tell silent stories</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="https://via.placeholder.com/600x400?text=Ocean+Waves" alt="Ocean Waves">
                    <div class="gallery-overlay">
                        <i class="bi bi-water"></i>
                        <h4>Oceanic Rhythms</h4>
                        <p>Eternal dance of waves</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to Action -->
    <section class="cta-section text-light text-center py-5" style="background-color: #343a40;">
        <div class="container">
            <h2>Join Our Tea Journey</h2>
            <p class="lead">Subscribe to our newsletter for updates on our latest blends and offers.</p>
            <a href="#" class="btn btn-lg btn-light">
                <i class="bi bi-envelope-open"></i> Sign Up Now
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
</body>

</html>