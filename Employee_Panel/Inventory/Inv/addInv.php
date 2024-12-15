<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";


    $productId = $_POST['productId'];
    $dateAdded = $_POST['dateAdded'];
    $supplierId = $_POST['supplierId'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'malinda_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into inventory table
    $query = "INSERT INTO inventory (Prod_ID, Date_Added, Supplier_ID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $productId, $dateAdded, $supplierId);

    if ($stmt->execute()) {
        $message = "Inventory record added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Admin_Panel/Managements/assets/css/form.css">
</head>

<body>
    <header>
        <button id="backButton" onclick="location.href='../../Inventory.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main>
        <!-- Form for Add new item -->
        <form action="" method="POST" >
            <h2>Add Item to Inventory</h2>

            <!-- Product ID selection -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-stack"></i></span>
                <select class="form-select" id="productId" name="productId" required>
                    <option value="">Select Product</option>
                    <?php
                    // Fetch product data from the database
                    $conn = new mysqli('localhost', 'root', '', 'malinda_db');
                    $query = "SELECT Prod_ID, Prod_Name FROM product";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Prod_ID']}'>{$row['Prod_Name']}</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Date Added -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" class="form-control" id="dateAdded" name="dateAdded" required>
            </div>

            <!-- Supplier ID selection -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                <select class="form-select" id="supplierId" name="supplierId" required>
                    <option value="">Select Supplier</option>
                    <?php
                    // Fetch supplier data from the database
                    $conn = new mysqli('localhost', 'root', '', 'malinda_db');
                    $query = "SELECT Supplier_ID, Supplier_Name FROM supplier";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['Supplier_ID']}'>{$row['Supplier_Name']}</option>";
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Add to Inventory</button>
            </div>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- JS Section -->
    <script>
        // Check box selection
        function validateItemForm() {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                alert("You must confirm that the information is true.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>