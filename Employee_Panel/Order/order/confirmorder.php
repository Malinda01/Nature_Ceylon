<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the Online_Order_ID from the URL
$online_order_id = isset($_GET['Online_Order_ID']) ? $_GET['Online_Order_ID'] : null;

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $status = $_POST['order_status'];

    // Update the order status in the database
    $update_sql = "UPDATE online_order SET Order_Status = ? WHERE Online_Order_ID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $online_order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order status updated successfully!'); window.location.href='oderview.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}

// Fetch order details to display
$order_details = null;
if ($online_order_id) {
    $sql = "SELECT * FROM online_order WHERE Online_Order_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $online_order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order_details = $result->fetch_assoc();
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order - Nature Ceylon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Confirm Order</h1>
        <?php if ($order_details): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Details</h5>
                    <p><strong>Online Order ID:</strong> <?= htmlspecialchars($order_details['Online_Order_ID']) ?></p>
                    <p><strong>Order Date:</strong> <?= htmlspecialchars($order_details['Order_Date']) ?></p>
                    <p><strong>Customer ID:</strong> <?= htmlspecialchars($order_details['Cust_ID']) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($order_details['Order_Status']) ?></p>

                    <form method="POST" class="mt-3">
                        <label for="order_status" class="form-label">Update Status</label>
                        <select name="order_status" id="order_status" class="form-select">
                            <option value="Approved" <?= $order_details['Order_Status'] === 'Approved' ? 'selected' : '' ?>>Approve</option>
                            <option value="Declined" <?= $order_details['Order_Status'] === 'Declined' ? 'selected' : '' ?>>Decline</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger">Invalid Order ID</p>
        <?php endif; ?>
    </div>
</body>
</html>
