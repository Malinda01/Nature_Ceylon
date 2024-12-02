<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Salary - Nature Ceylon</title>
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
        <!-- Back button for prev page -->
        <button id="backButton" onclick="location.href='../../Employee.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>View Salary</h2>

        <!-- Display salary -->
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Payroll ID</th>
                    <th>Base Salary</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Net Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = ""; // Replace with your database password
                $dbname = "malinda_db"; // Replace with your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch salary data
                $sql = "SELECT Payroll_ID, Base_Salary, Bonus, Deductions, net_salary FROM payroll";
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['Payroll_ID']}</td>
                                <td>\${$row['Base_Salary']}</td>
                                <td>\${$row['Bonus']}</td>
                                <td>\${$row['Deductions']}</td>
                                <td>\${$row['net_salary']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No salary data found</td></tr>";
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
</body>

</html>
