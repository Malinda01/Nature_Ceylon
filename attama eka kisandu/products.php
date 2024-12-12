<?php
session_start();

include 'db.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Our Products</title>
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


    <main>
        <div class="product-grid">

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="product-card">
                    <img src="<?= isset($row['image']) ? $row['image'] : 'default-image.jpg' ?>" alt="<?= $row['Prod_Name'] ?>">

                    <h3><?= $row['Prod_Name'] ?></h3>
                    <p><?= $row['Prod_Description'] ?></p>
                    <p>Price: $<?= $row['Prod_Unit_Price'] ?></p>
                    <p>Stock: <?= $row['Prod_Qty'] ?> available</p>
                    <?php if ($row['Prod_Qty'] > 0): ?>
                        <form method="post" action="products.php">
                            <input type="hidden" name="product_id" value="<?= $row['Prod_ID'] ?>">
                            <input type="number" name="quantity" value="1" min="1" max="<?= $row['Prod_Qty'] ?>">
                            <button type="submit">Add to Cart</button>
                        </form>
                    <?php else: ?>
                        <p class="out-of-stock">Out of Stock</p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

        </div>
    </main>
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
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    header('Location: cart.php');
    exit();
}
?>