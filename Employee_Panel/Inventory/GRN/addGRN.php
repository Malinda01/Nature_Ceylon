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


    
}
?>


<!------------------------------------------------- HTML section ------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add GRN - Nature Ceylon</title>
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
            <h2>Add GRN</h2>



            <!-- GRN Date -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                <input type="date" class="form-control" id="grnDate" name="grnDate" placeholder="GRN Date" required>
            </div>

            <!-- Supplier Invoice ID -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-file-text"></i></span>
                <input type="text" class="form-control" id="supplierInvoiceId" name="supplierInvoiceId" placeholder="Supplier Invoice ID" required>
            </div>


            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Add GRN" class="btn btn-success w-100 mt-3">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $grnDate = $_POST['grnDate'];
            $supplierInvoiceId = $_POST['supplierInvoiceId'];

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO grn (GRN_Date, Sup_Invoice_ID) VALUES (?, ?)");
            $stmt->bind_param("ss", $grnDate, $supplierInvoiceId);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<p class='alert alert-success'>GRN added successfully!</p>";
            } else {
                echo "<p class='alert alert-danger'>Error: " . $stmt->error . "</p>";
            }

            // Close the statement
           
        }
        ?>

        <!-- For table -->
        <?php
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

        // Fetch supplier invoices
        $sql = "SELECT * FROM supplier_invoice";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped mt-5">';
            echo '<thead> <tr> <th>Invoice ID</th> <th>Supplier Product</th ><th>Supplier Product Price</th> <th>Quantity</th> <th>Supplier ID</th> </tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["Sup_Invoice_ID"] . '</td>';
                echo '<td>' . $row["Sup_Product"] . '</td>';
                echo '<td>' . $row["Sup_Product_Price"] . '</td>';
                echo '<td>' . $row["Sup_Qty"] . '</td>';
                echo '<td>' . $row["Supplier_ID"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No supplier invoices found.</p>';
        }

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