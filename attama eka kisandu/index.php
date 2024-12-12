<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $_SESSION['Username'] = htmlspecialchars($_POST['username']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Ceylon | Pure Ceylon Tea</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/new.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, var(--deep-green), var(--sage-green));">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: var(--white); font-weight: 700;">
                <i class="bi bi-leaf"></i> Nature Ceylon
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color: var(--white);">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php" style="color: var(--white);">
                            <i class="bi bi-cup"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" style="color: var(--white);">
                            <i class="bi bi-cart"></i> Cart
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php" style="color: var(--white);">
                            <i class="bi bi-person-circle"></i> Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <!-- Background Video -->
        <video autoplay muted loop class="bg-video">
            <source src="MEDIA/landing.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Content Overlay -->
        <div class="container hero-content text-center text-light position-relative">

            <b><span class="admin-name"> <?php
            if (isset($_SESSION['Username'])) {
                echo "<p style='font-size: 1.5em;'>Welcome, " . htmlspecialchars($_SESSION['Username']) . "!</p>";
            } ?></span></b>

            <h1>Nature Ceylon</h1>
            <p>Pure Ceylon tea, finest leaves from Sri Lanka.</p>
            <a href="products.php" class="btn btn-lg btn-outline-light mt-4">
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
        <img src="MEDIA/proimg/er.jpg" alt="Earl Grey">
        <div class="gallery-overlay">
            <h4>Earl Grey Delight</h4>
            <p>Bergamot infused black tea for a soothing experience</p>
        </div>
    </div>
    <div class="gallery-item">
        <img src="MEDIA/proimg/en.jpeg" alt="English Breakfast">
        <div class="gallery-overlay">
            <h4>English Breakfast</h4>
            <p>Strong and full-bodied black tea to start your day</p>
        </div>
    </div>
    <div class="gallery-item">
        <img src="MEDIA/proimg/gr.jpeg" alt="Green Tea">
        <div class="gallery-overlay">
            <h4>Green Tea Serenity</h4>
            <p>Light and refreshing green tea for a calming moment</p>
        </div>
    </div>
</div>
    </section>


    
    <!-- Company Location Section -->
    <section class="location-section text-center py-5" style="background: var(--light-gray); color: var(--deep-green);">
        <div class="container">
            <h2 style="font-size: 2.5rem;">Our Location</h2>
            <p style="font-size: 1.2rem;">Visit us at our headquarters in Sri Lanka.</p>
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="100%" height="400" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.010060478023!2d79.8559!3d6.9271!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sNature%20Ceylon!5e0!3m2!1sen!2sus!4v1638303545611!5m2!1sen!2sus" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    
                </div>
            </div>
        </div>
    </section>

   
    <!-- Call to Action Section -->
    <section class="cta-section text-center py-5" style="background: var(--sage-green); color: var(--white);">
        <div class="container">
            <h2 style="font-size: 3rem;">Join Our Tea Journey</h2>
            <p style="font-size: 1.2rem;">Subscribe to our newsletter for updates on our latest blends and offers.</p>
            <a href="#" class="btn btn-light" style="padding: 10px 30px;">
                <i class="bi bi-envelope-open"></i> Sign Up Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: var(--deep-green); color: var(--white); padding: 40px 0;">
        <div class="container text-center">
            <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
            <div class="social-links mt-3">
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
