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

// Update query
$sql = "UPDATE supplier SET Supplier_Name = ?, Supplier_Company = ? WHERE Supplier_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $supplier_name, $supplier_company, $supplier_id);

if ($stmt->execute()) {
    echo "Supplier updated successfully!";
    header("Location: ../viewsup/viewsup.php"); // Redirect to the supplier list page
} else {
    echo "Error updating record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
