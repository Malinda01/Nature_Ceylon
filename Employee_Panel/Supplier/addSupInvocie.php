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
    <link rel="stylesheet" href="../../Admin_Panel/Managements/assets/css/form.css">
</head>

<body>
    <header>
        <button id="backButton" onclick="location.href='../Supplier.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">

        <!-- Form section -->
        <h2>Supplier Invoice</h2>
        <form id="supplierForm" onsubmit="return validateForm()" method="POST" action="">



            <!-- Supplier Product -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="supplierName" name="supprod" placeholder="Supplier Product">
            </div>

            <!-- Supplier Prod Price -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <input type="text" class="form-control" id="supplierCompany" name="supprodprice" placeholder="Supplier Product Price">
            </div>

            <!-- Supplier Prod Qty -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="number" class="form-control" id="supplierName" name="supplierId" placeholder="Supplier ID">
            </div>

            <!-- Supplier ID -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="number" class="form-control" id="supplierName" name="supqty" placeholder="Supplier Quantity">
            </div>


            <!-- Confirmation Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Add Supplier Invoice" class="btn btn-success w-100 mt-3">

        </form>




        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $supplierProduct = $_POST["supprod"];
            $supplierProductPrice = $_POST["supprodprice"];
            $supplierId = $_POST["supplierId"];
            $supqty = $_POST["supqty"];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO supplier_invoice (Supplier_ID, Sup_Product, Sup_Product_Price, Sup_Qty) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $supplierId, $supplierProduct, $supplierProductPrice, $supqty);

            if ($stmt->execute()) {
                echo "New supplier invoice added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        ?>

        <!-- Table section -->
        <!-- Table to View Supplier Details -->
        <table class="table table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Supplier ID</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Supplier Company</th>

                </tr>
            </thead>
            <tbody>
                <!-- PHP section -->
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

                // Fetch category data
                $sql = "SELECT Supplier_ID, Supplier_Name, Supplier_Company FROM supplier";
                $result = $conn->query($sql);

                // Display data in table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["Supplier_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Name"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Company"]) . "</td>

                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No categories found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
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