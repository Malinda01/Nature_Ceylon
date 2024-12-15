<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Initiate Return - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>Nature Ceylon</h1>
    </header>

    <main>
        <?php
        // Database connection setup
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "malinda_db";

        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("<div class='alert alert-danger'>Database connection failed: " . $conn->connect_error . "</div>");
        }

        // Initialize variables for form data
        $returnProductId = $returnDate = $returnReason = "";
        $successMessage = $errorMessage = "";

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $returnProductId = $conn->real_escape_string($_POST["returnProductId"]);
            $returnDate = $conn->real_escape_string($_POST["returnDate"]);
            $returnReason = $conn->real_escape_string($_POST["returnReason"]);
            $returnStatus = "Pending"; // Default status

            // Insert data into the database
            $sql = "INSERT INTO returntable (Return_Product_ID, Return_Date, Return_Reason,  Return_Status) 
                    VALUES ('$returnProductId', '$returnDate', '$returnReason', '$returnStatus')";

            if ($conn->query($sql) === TRUE) {
                $successMessage = "Return initiated successfully!";
            } else {
                $errorMessage = "Error: " . $conn->error;
            }
        }

        // Close the connection
        $conn->close();
        ?>

        <form id="returnForm" method="POST" onsubmit="return validateReturnForm()" action="">
            <h2>Initiate Return</h2>

            <!-- Success and Error Messages -->
            <?php if ($successMessage): ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" id="returnProductId" name="returnProductId" placeholder="Return Product ID" value="<?php echo htmlspecialchars($returnProductId); ?>" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" class="form-control" id="returnDate" name="returnDate" value="<?php echo htmlspecialchars($returnDate); ?>" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-pen"></i></span>
                <textarea class="form-control" id="returnReason" name="returnReason" placeholder="Reason for Return" rows="3" required><?php echo htmlspecialchars($returnReason); ?></textarea>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Initiate Return" class="btn btn-primary w-100 mt-3">
        </form>

        <?php
// Re-establish database connection

$conn = new mysqli($host, $username, $password, $dbname);;

// Check connection
if ($conn->connect_error) {
    die("<div class='alert alert-danger'>Database connection failed: " . $conn->connect_error . "</div>");
}

// Fetch product data
$sql = "SELECT Prod_ID, Prod_Name FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped mt-5'>";
    echo "<thead><tr><th>Product ID</th><th>Product Name</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row["Prod_ID"]) . "</td><td>" . htmlspecialchars($row["Prod_Name"]) . "</td></tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='alert alert-info'>No products found.</div>";
}

// Close the connection
$conn->close();
?>
    </main>

    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateReturnForm() {
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
