<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total = $_SESSION['total_amount'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $payment_date = $_POST['Payment_date'];
    $payment_method = $_POST['payment_method'];
    $order_type = $_POST['order_type'];
    $total_amount = $_POST['total_amount'];
    $cart = json_decode($_POST['cart'], true);

    $stmt = $conn->prepare("INSERT INTO payment (Payment_date, Payment_Method, Order_Type, Total_Amount) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $payment_date, $payment_method, $order_type, $total);
    $stmt->execute();
    $payment_id = $stmt->insert_id;

    foreach ($cart as $item) {
        $stmt = $conn->prepare("UPDATE product SET Prod_Qty = Prod_Qty - ? WHERE Prod_ID = ?");
        $stmt->bind_param("ii", $item['qty'], $item['id']);
        $stmt->execute();
    }

    echo "Payment Successful! Order ID: " . $payment_id;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .total-amount {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="total-amount">Total Amount: $<span id="display_total_amount"></span></div>
        <!-- Form for record payment data -->
        <form method="post" action="">
            <!-- Payment Date -->
            <label for="payment_date">Payment Date:</label>
            <input type="date" id="payment_date" name="payment_date" required><br>

            <!-- Payment method -->
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="Cash">Cash</option>
                <option value="Card">Card</option>
            </select><br>

            <!-- Order Type -->
            <label for="order_type">Order Type:</label>
            <select id="order_type" name="order_type" required>
                <option value="In-store">In-store</option>
            </select><br>

            <input type="hidden" id="total_amount" name="total_amount">
            <input type="hidden" id="cart" name="cart">

            <button type="submit">Confirm Payment</button>
        </form>
    </div>

    <script>
        const totalAmount = <?php echo json_encode($_SESSION['total']); ?>;
        document.getElementById('total_amount').value = totalAmount;
        document.getElementById('cart').value = localStorage.getItem('cart');
        document.getElementById('display_total_amount').textContent = totalAmount;
    </script>
</body>
</html>
