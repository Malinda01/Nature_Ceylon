<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Salary</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Calculate Employee Salary</h1>
        <form action="" method="POST" class="mb-4">
            <div class="form-group">
                <label for="emp_id">Employee ID:</label>
                <input type="number" class="form-control" id="emp_id" name="emp_id" required>
            </div>
            <div class="form-group">
                <label for="basic_salary">Basic Salary:</label>
                <input type="number" step="0.01" class="form-control" id="basic_salary" name="basic_salary" required>
            </div>
            <div class="form-group">
                <label for="bonus">Bonus:</label>
                <input type="number" step="0.01" class="form-control" id="bonus" name="bonus">
            </div>
            <div class="form-group">
                <label for="deductions">Deductions:</label>
                <input type="number" step="0.01" class="form-control" id="deductions" name="deductions">
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <!-- Back button -->
        <a href="../../Employee.php" class="btn btn-secondary">Back</a>

        <!-- Data table from employee -->
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

        // Fetch employees
        $sql = "SELECT Emp_ID, E_FName, Role FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-bordered mt-4">';
            echo '<thead class="thead-dark"><tr><th>Employee ID</th><th>Name</th><th>Position</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["Emp_ID"] . '</td>';
                echo '<td>' . $row["E_FName"] . '</td>';
                echo '<td>' . $row["Role"] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning" role="alert">No employees found.</div>';
        }

        // Close connection
        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
