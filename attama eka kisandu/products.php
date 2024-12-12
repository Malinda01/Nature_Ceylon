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
</head>

<body>
    <header>
        <h1>Our Products</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="products.php">Shop</a>
            <a href="cart.php">Cart</a>
            <a href="profile.php">Profile</a>
        </nav>

    </header>

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