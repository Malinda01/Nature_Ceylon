<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Get form data
    $baseSalary = $_POST['baseSalary'];
    $bonus = $_POST['bonus'];
    $deduction = $_POST['deduction'];
    $netSalary = $_POST['netsal']; // Already calculated by JS
    $empid = $_POST['empid'];

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO payroll (Base_Salary, Bonus, Deductions, net_salary, Emp_ID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ddddi", $baseSalary, $bonus, $deduction, $netSalary, $empid);

    // Execute the query
    if ($stmt->execute()) {
        echo "Salary calculated and saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Salary - Nature Ceylon</title>
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
        <button id="backButton" onclick="location.href='../../Employee.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>Calculate Salary</h2>

        <!-- Display success or error message -->


        <!-- Form for Calculate Salary -->
        <form id="calculateSalaryForm" method="POST" action="">
            <!-- Employee ID -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="number" class="form-control" id="empid" name="empid" placeholder="Employee ID" required>
            </div>

            <!-- Base salary -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-cash"></i></span>
                <input type="number" class="form-control" id="baseSalary" name="baseSalary" placeholder="Base Salary" required oninput="updateNetSalary()">
            </div>

            <!-- Bonus -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-gift"></i></span>
                <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Bonus" required oninput="updateNetSalary()">
            </div>

            <!-- Deduction -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-dash-circle"></i></span>
                <input type="number" class="form-control" id="deduction" name="deduction" placeholder="Deduction" required oninput="updateNetSalary()">
            </div>

            <!-- Net Salary -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                <input type="number" class="form-control" id="netsal" name="netsal" placeholder="Net Salary" readonly>
            </div>

            <!-- Submit button -->
            <div class="mb-3">
                <button type="submit" class="btn btn-success w-100">Save Salary</button>
            </div>
        </form>
    </main>
    <footer class="text-center mt-4">
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- JS Section -->
    <script>
        function goBack() {
            window.history.back();
        }

        function updateNetSalary() {
            const baseSalary = parseFloat(document.getElementById("baseSalary").value) || 0;
            const bonus = parseFloat(document.getElementById("bonus").value) || 0;
            const deduction = parseFloat(document.getElementById("deduction").value) || 0;

            const netSalary = baseSalary + bonus - deduction;
            document.getElementById("netsal").value = netSalary.toFixed(2);
        }
    </script>
</body>

</html>