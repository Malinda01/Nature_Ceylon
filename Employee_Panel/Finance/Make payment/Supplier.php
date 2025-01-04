<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Payment - Nature Ceylon</title>
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
        <?php
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

        $sql = "SELECT 
                    grn.GRN_ID,
                    supplier.Supplier_ID,
                    (supplier_invoice.Sup_Product_Price * supplier_invoice.Sup_Qty) AS Payment
                FROM 
                    grn
                JOIN 
                    supplier_invoice ON grn.GRN_ID = grn.Sup_Invoice_ID
                JOIN 
                    supplier ON supplier.Supplier_ID = supplier_invoice.Supplier_ID";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>GRN ID</th><th>Supplier ID</th><th>Payment</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["GRN_ID"] . '</td>';
                echo '<td>' . $row["Supplier_ID"] . '</td>';
                echo '<td>' . $row["Payment"] . '</td>';
                //echo '<td><button class="btn btn-primary" onclick="pay(' . $row["GRN_ID"] . ')">Pay</button></td>';
                echo '<td><button class="btn btn-primary" onclick="window.location.href=\'GRN.php?GRN_ID=' .  $row['GRN_ID'] . "&Supplier_ID=" . $row['Supplier_ID'] . "&Payment=" . $row['Payment'] .  '\'">Pay</button></td>';
                //echo '<td><button class="btn btn-success" onclick="this.innerHTML=\'Paid\'; this.disabled=true;">Pay</button></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "0 results";
        }

        ?>



        <script>
            // Define a function named 'pay' that takes a parameter 'grnId'
            function pay(grnId) {
                // Show a confirmation dialog to the user and check if they confirm
                if (confirm("Are you sure you want to make the payment for GRN ID " + grnId + "?")) {
                    // Find the row in the table that contains the button that was clicked
                    const row = document.querySelector(`button[onclick='pay(${grnId})']`).closest('tr');
                    // Get the payment amount from the third column of the row
                    const paymentAmount = row.querySelector('td:nth-child(3)').textContent;
                    // Get the supplier ID from the second column of the row
                    const supplierId = row.querySelector('td:nth-child(2)').textContent;

                    // Set the value of the 'grn_id' input field to the GRN ID
                    document.getElementById('grn_id').value = grnId;
                    // Set the value of the 'payment_amount' input field to the payment amount
                    document.getElementById('payment_amount').value = paymentAmount;
                    // Set the value of the 'supplier_id' input field to the supplier ID
                    document.getElementById('supplier_id').value = supplierId;

                    // Submit the form with the payment details
                    document.getElementById('paymentForm').submit();
                }
            }
        </script>



        <script>
            function pay(grnId) {
                if (confirm("Are you sure you want to make the payment for GRN ID " + grnId + "?")) {
                    // Implement the payment logic here
                    alert("Payment made for GRN ID " + grnId);
                }
            }
        </script>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateForm() {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                alert("You must confirm that the payment details are accurate.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>