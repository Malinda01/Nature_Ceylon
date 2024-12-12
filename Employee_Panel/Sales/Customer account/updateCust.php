<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Account - Nature Ceylon</title>
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

        session_start();

        if (isset($_GET['id'])) {
            $_SESSION['Cust_ID'] = $_GET['id'];
        }

        $sql = "SELECT Cust_ID, FName, LName, Phone, Username, Password, E_Mail, Address FROM customer";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Firstname</th><th>Lastname</th><th>Phone</th><th>Username</th><th>Password</th><th>Email</th><th>Address</th><th>Action</th></tr></thead>';
            echo '<tbody>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["FName"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["LName"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Phone"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Username"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Password"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["E_Mail"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["Address"]) . '</td>';
                echo '<td><a href="updateCustomer.php?id=' . $row["Cust_ID"] . '" class="btn btn-primary">Update</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo "0 results";
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

        function validateUpdateCustomerForm() {
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
