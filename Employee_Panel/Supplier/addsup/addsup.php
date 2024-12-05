<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // DB connect php
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

    // Set parameters and execute
    $supplierName = $_POST["supplierName"];
    $supplierCompany = $_POST["supplierCompany"];
    //$suplierID = $_POST["employeeId"];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO supplier (Supplier_Name, Supplier_Company) VALUES (?, ?)");
    $stmt->bind_param("ss", $supplierName, $supplierCompany);

    if ($stmt->execute()) {
        echo "New supplier added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Registration - Nature Ceylon</title>
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
        <button id="backButton" onclick="location.href='../../Supplier.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">

        <!-- Form section -->
        <h2>Supplier Registration</h2>
        <form id="supplierForm" onsubmit="return validateForm()" method="POST" action="">

            <!-- Supplier ID -->
            <!-- <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-file-earmark"></i></span>
                <input type="text" class="form-control" id="supplierId" name="supplierId" value="" readonly>
            </div> -->

            <!-- Supplier Name -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Supplier Name">
            </div>

            <!-- Supplier Company -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control" id="supplierCompany" name="supplierCompany" placeholder="Supplier Company">
            </div>

            <!-- Employee ID -->
            <!-- <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Employee ID">
            </div> -->

            <!-- Confirmation Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Register Supplier" class="btn btn-success w-100 mt-3">

        </form>
    </main>

    <footer class="text-center mt-4">
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        

        function validateForm() {
            const supplierId = document.getElementById("supplierId").value;
            const supplierName = document.getElementById("supplierName").value;
            const supplierCompany = document.getElementById("supplierCompany").value;
            const employeeId = document.getElementById("employeeId").value;
            const checkbox = document.getElementById("confirmationCheckbox");

            if (!supplierId || !supplierName || !supplierCompany || !employeeId) {
                alert("Please fill in all fields.");
                return false;
            }

            if (!checkbox.checked) {
                alert("You must confirm that the information is true.");
                return false;
            }

            alert("Supplier Registered Successfully!");
            return true;
        }
    </script>

    
</body>

</html>