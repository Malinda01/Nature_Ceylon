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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $supplier_id = $_POST['supplier_id'];
    $payment = $_POST['payment'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'malinda_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert into the database
    $sql = "INSERT INTO supplier_payment (Payment_Amount, Supplier_ID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $payment, $supplier_id);

    if ($stmt->execute()) {
        //echo "Payment recorded successfully.";
        echo "<script type='text/javascript'>alert('Payment recorded successfully.');</script>";
        // Redirect or display a success page
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
