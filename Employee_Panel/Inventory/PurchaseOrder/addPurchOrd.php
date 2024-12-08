<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set parameters and execute
    $ordpro = $_POST["ordprod"];
    $ordqty = $_POST["ordqty"];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO purchase_order (Purch_Products, Qty) VALUES (?, ?)");
    $stmt->bind_param("ss", $ordpro, $ordqty);

    if ($stmt->execute()) {
        echo "New category added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


<!------------------------------------------------- HTML section ------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Purchase Order - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main>
        <form id="grnForm" onsubmit="return validateGRNForm()" method="POST" action="">
            <h2>Add Purchase Order</h2>

            <!-- Order Product -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="supplierName" name="ordprod" placeholder="Purchase Order Product" required>
            </div>

            <!-- Quantity -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-file-text"></i></span>
                <input type="number" class="form-control" id="supplierInvoiceId" name="ordqty" placeholder="Product Quantity" required>
            </div>


            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Add Purchase Order" class="btn btn-success w-100 mt-3">
        </form>

    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateGRNForm() {
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