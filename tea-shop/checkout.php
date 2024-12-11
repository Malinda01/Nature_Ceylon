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
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <h1>Checkout</h1>
    </header>

    <main>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="address">Address:</label>
            <textarea name="address" id="address" required></textarea>
            <button type="submit">Complete Purchase</button>
        </form>
    </main>
</body>

</html>