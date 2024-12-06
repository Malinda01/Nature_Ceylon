<?php

// Check if the form is submitted

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee Details - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/form.css">
    <style>
        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <header>
        <button id="backButton" onclick="goBack()">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main>
        <table class="table table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">NIC</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mail</th>
                    <th scope="col">Role</th>
                    <!-- <th scope="col">Username</th>
                    <th scope="col">Password</th> -->
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
                $sql = "SELECT Emp_ID, NIC, E_Fname, E_Lname E_Phone, E_Address, E_Mail, Role FROM employee";
                $result = $conn->query($sql);

                // Display data in table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["Emp_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["NIC"]) . "</td>
                                <td>" . htmlspecialchars($row["E_Fname"]) . "</td>
                                <td>" . htmlspecialchars($row["E_Phone"]) . "</td>
                                <td>" . htmlspecialchars($row["E_Address"]) . "</td>
                                <td>" . htmlspecialchars($row["E_Mail"]) . "</td>
                                <td>" . htmlspecialchars($row["Role"]) . "</td>

                                <td>
                                    <form action='update_employee.php' method='post'>
                                        <input type='hidden' name='Emp_ID' value='" . htmlspecialchars($row["Emp_ID"]) . "'>
                                        <input type='submit' value='Update'>
                                    </form>
                                    <form action='delete_employee.php' method='post'>
                                        <input type='hidden' name='Emp_ID' value='" . htmlspecialchars($row["Emp_ID"]) . "'>
                                        <input type='submit' value='Delete'>
                                    </form>
                                </td>
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

    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateUpdateForm() {
            const employeeSelect = document.getElementById("updateEmployeeSelect").value;
            if (employeeSelect === "") {
                alert("Please select an employee ID to update.");
                return false;
            }
            return true;
        }

        function deleteEmployee(event) {
            if (event) event.preventDefault(); // Prevent form submission

            const employeeSelect = document.getElementById("deleteEmployeeSelect").value;
            const confirmCheckbox = document.getElementById("deleteConfirmationCheckbox");

            if (employeeSelect === "") {
                alert("Please select an employee ID to delete.");
                return false;
            }

            if (!confirmCheckbox.checked) {
                alert("Please confirm the deletion by checking the checkbox.");
                return false;
            }

            const confirmDelete = confirm(`Are you sure you want to permanently delete employee ${employeeSelect}?`);
            if (confirmDelete) {
                // Code to handle deletion (e.g., send request to the server)
                alert(`Employee with ID ${employeeSelect} has been deleted.`);
                return true;
            }
            return false;
        }

        // Add event listeners for form submissions
        document.getElementById('updateEmployeeForm').addEventListener('submit', function(event) {
            if (!validateUpdateForm()) {
                event.preventDefault();
            }
        });

        document.getElementById('deleteEmployeeForm').addEventListener('submit', function(event) {
            if (!deleteEmployee(event)) {
                event.preventDefault();
            }
        });
    </script>
</body>

</html>