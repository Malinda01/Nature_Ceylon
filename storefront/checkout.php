<?php
session_start();


include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];

    // Calculate total amount
    $cart = $_SESSION['cart'];
    $totalAmount = 0;
    foreach ($cart as $item) {
        $query = "SELECT * FROM products WHERE id = " . $item['id'];
        $result = mysqli_query($conn, $query);
        $product = mysqli_fetch_assoc($result);

        $totalAmount += $product['price'] * $item['quantity'];

        // Decrease product stock
        $newQuantity = $product['quantity'] - $item['quantity'];
        $updateQuery = "UPDATE products SET quantity = $newQuantity WHERE id = " . $product['id'];
        mysqli_query($conn, $updateQuery);
    }

    // Insert order
    $orderQuery = "INSERT INTO orders (customer_name, customer_address, total_amount) 
                   VALUES ('$name', '$address', $totalAmount)";
    mysqli_query($conn, $orderQuery);
    $orderId = mysqli_insert_id($conn);

    // Insert order_products
    foreach ($cart as $item) {
        $insertOrderProduct = "INSERT INTO order_products (order_id, product_id, quantity) 
                               VALUES ($orderId, " . $item['id'] . ", " . $item['quantity'] . ")";
        mysqli_query($conn, $insertOrderProduct);
    }

    $_SESSION['cart'] = [];
    echo "<script>alert('Thank you for your purchase!');</script>";
    exit;

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to a confirmation page or display a confirmation message
    header('Location: checkout.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/new.css">
</head>

<body>
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
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
            <button type="submit">Complete Purchase</button>
        </form>
    </main>

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