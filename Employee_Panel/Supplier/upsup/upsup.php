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

// Get Supplier ID from URL
$supplier_id = $_GET['id'] ?? null;
$supplier_name = '';
$supplier_company = '';

if ($supplier_id) {
    // Fetch supplier data
    $sql = "SELECT Supplier_Name, Supplier_Company FROM supplier WHERE Supplier_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $supplier_name = $row['Supplier_Name'];
        $supplier_company = $row['Supplier_Company'];
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Update Supplier</h2>
        <form action="update_supplier_process.php" method="post">
            <input type="hidden" name="supplier_id" value="<?php echo htmlspecialchars($supplier_id); ?>">
            <div class="mb-3">
                <label for="supplier_name" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" 
                       value="<?php echo htmlspecialchars($supplier_name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="supplier_company" class="form-label">Supplier Company</label>
                <input type="text" class="form-control" id="supplier_company" name="supplier_company" 
                       value="<?php echo htmlspecialchars($supplier_company); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Back button to viewsup.php -->
    <div class="container mt-4">
        <a href="../viewsup/viewsup.php" class="btn btn-secondary">Back</a>
</body>
</html>
