<?php
session_start();
include 'db.php';

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['purchase'])) {
        // Handle purchase action
        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $order_date = date('Y-m-d H:i:s');
        $total_amount = 0;

        // Calculate total amount and validate product quantities
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "SELECT Prod_Unit_Price, Prod_Qty FROM product WHERE Prod_ID = $product_id";
            $result = mysqli_query($conn, $query);
            $product = mysqli_fetch_assoc($result);

            if ($quantity > $product['Prod_Qty']) {
                echo "<p>Insufficient stock for product ID: $product_id</p>";
                exit();
            }

            $total_amount += $product['Prod_Unit_Price'] * $quantity;
        }

        // Insert into order table
        // Retrieve customer ID from session username
        $username = $_SESSION['Username'];
        $query = "SELECT Cust_ID FROM customer WHERE Username = '$username'";
        $result = mysqli_query($conn, $query);
        $customer = mysqli_fetch_assoc($result);
        $customer_id = $customer['Cust_ID'];

        // Insert into orders table with customer_id
        $query = "INSERT INTO Online_Order (Cust_ID, Order_Date, Order_Status, Total_Amount) VALUES ($customer_id, '$order_date', 'Pending', $total_amount)";
        mysqli_query($conn, $query);
        $order_id = mysqli_insert_id($conn);

        // Insert into order_product table and update product quantities
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "INSERT INTO Online_Order_Item (Online_Order_ID, Prod_ID, Qty) VALUES ($order_id, $product_id, $quantity)";
            mysqli_query($conn, $query);

            $query = "UPDATE product SET Prod_Qty = Prod_Qty - $quantity WHERE Prod_ID = $product_id";
            mysqli_query($conn, $query);
        }

        // Clear the cart
        $_SESSION['cart'] = [];

        echo "<p>Order placed successfully!</p>";
        exit();
    } elseif (isset($_POST['clear_cart'])) {
        // Handle clear cart action
        $_SESSION['cart'] = [];
        echo "<p>Cart cleared successfully!</p>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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

    <main class="container mt-4">
        <div class="cart-items">
            <?php if (!empty($_SESSION['cart'])): ?>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $product_id => $quantity):
                            $query = "SELECT Prod_Name, Prod_Unit_Price FROM product WHERE Prod_ID = $product_id";
                            $result = mysqli_query($conn, $query);
                            $product = mysqli_fetch_assoc($result);

                            $subtotal = $product['Prod_Unit_Price'] * $quantity;
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?= $product['Prod_Name'] ?></td>
                                <td>$<?= $product['Prod_Unit_Price'] ?></td>
                                <td><?= $quantity ?></td>
                                <td>$<?= $subtotal ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong>$<?= $total ?></strong></td>
                        </tr>
                    </tbody>
                </table>

                <form method="post" action="cart.php" class="mb-3">
                    <h2>Customer Details</h2>
                    <div class="form-group">
                        <label for="customer_name">Name:</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="customer_address">Address:</label>
                        <textarea id="customer_address" name="customer_address" class="form-control" required></textarea>
                    </div>
                    <button type="submit" name="purchase" class="btn btn-success mt-3">Purchase</button>
                </form>

                <form method="post" action="cart.php">
                    <button type="submit" name="clear_cart" class="btn btn-danger mb-4">Clear Cart</button>
                </form>
            <?php else: ?>
                <p>Your cart is empty. <a href="products.php">Go shopping</a>.</p>
            <?php endif; ?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
