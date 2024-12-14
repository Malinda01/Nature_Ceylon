<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Get form data
//$customer_id = $_POST['id'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$address = $_POST['address'];

// Update the customer details
$sql = "UPDATE customer 
        SET FName = ?, LName = ?, Phone = ?, Username = ?, E_Mail = ?, Password = ?, Address = ?
        WHERE Cust_ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssi", $first_name, $last_name, $phone, $username, $email, $password, $address, $customer_id);

if ($stmt->execute()) {
    header("Location: updateCustomer.php");
    exit;
} else {
    echo "Error updating customer: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
