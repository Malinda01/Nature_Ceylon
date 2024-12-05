<?php
// Database connection
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

// Get form data
$supplier_id = $_POST['supplier_id'];
$supplier_name = $_POST['supplier_name'];
$supplier_company = $_POST['supplier_company'];

// Delete query
$sql = "DELETE FROM supplier WHERE Supplier_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $supplier_id);

if ($stmt->execute()) {
    echo "Supplier Deleted successfully!";
    header("Location: ../viewsup/viewsup.php"); // Redirect to the supplier list page
} else {
    echo "Error Deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
