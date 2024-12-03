<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Supplier - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Admin_Panel/Managements/assets/css/form.css">
</head>

<body>
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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Collect data from the form
        $supplierId = $_POST["supplierId"];
        $supplierName = $_POST["supplierName"];
        $supplierCompany = $_POST["supplierCompany"];
        $employeeId = $_POST["employeeId"];

        // Validate inputs
        if (!empty($supplierId) && !empty($supplierName) && !empty($supplierCompany) && !empty($employeeId)) {
            // Update the supplier details
            $sql = "UPDATE supplier 
                    SET Supplier_Name = ?, Supplier_Company = ?, SUPManager_ID = ?
                    WHERE Supplier_ID = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $supplierName, $supplierCompany, $employeeId, $supplierId);

            if ($stmt->execute()) {
                echo "<script>alert('Supplier details updated successfully!');</script>";
            } else {
                echo "<script>alert('Error updating supplier details: " . $stmt->error . "');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Please fill in all fields.');</script>";
        }
    }
    ?>

    <header>
        <button id="backButton" onclick="location.href='../../Supplier.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main class="container mt-4">
        <h2>Update Supplier</h2>

        <form id="updateSupplierForm" method="POST" onsubmit="return validateForm()">
            <!-- Supplier ID -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="supplierId" name="supplierId" placeholder="Supplier ID">
            </div>

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
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Employee ID">
            </div>

            <!-- Confirmation Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox">
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Update Supplier" class="btn btn-warning w-100 mt-3">
        </form>

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
                <?php
                // Fetch supplier data
                $sql = "SELECT Supplier_ID, Supplier_Name, Supplier_Company FROM supplier";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["Supplier_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Name"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Company"]) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No suppliers found</td></tr>";
                }

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

            return true;
        }
    </script>
</body>

</html>
