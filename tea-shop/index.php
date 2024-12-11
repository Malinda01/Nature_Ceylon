<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tea Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Nature Ceylon</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a> <!-- Added link to profile page -->
        </nav>
    </header>

    <main class="container my-5">
        <div class="text-center">
        <?php
        session_start();
        if (isset($_SESSION['Username'])) {
            echo "<p style='font-weight: bold; font-size: 1.5em;'>Welcome, " . htmlspecialchars($_SESSION['Username']) . "!</p>";
        }
        ?>
            <h2>Discover Our Fresh Teas</h2>
            <p>Your favorite tea is just a click away.</p>
            <a href="products.php" class="btn btn-primary">Shop Now</a>
        </div>
    </main>

    <section class="container my-5">
        <h2 class="text-center">Our Best Sellers</h2>
        <ul class="list-group">
            <li class="list-group-item">Green Tea</li>
            <li class="list-group-item">Black Tea</li>
            <li class="list-group-item">Oolong Tea</li>
            <li class="list-group-item">Herbal Tea</li>
        </ul>
    </section>

    <section class="container my-5">
        <h2 class="text-center">Why Choose Our Tea?</h2>
        <p>Our teas are sourced from the finest gardens around the world. We ensure the highest quality and freshness in every cup.</p>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>