<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "malinda_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve input data
    $emp_id = intval($_POST['emp_id']);
    $basic_salary = floatval($_POST['basic_salary']);
    $bonus = floatval($_POST['bonus']);
    $deductions = floatval($_POST['deductions']);

    // Fetch leave days from empeave table
    $query = "SELECT DaysTaken FROM empeave WHERE emp_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();


    $row = $result->fetch_assoc();
    $days_taken = isset($row['DaysTaken']) ? $row['DaysTaken'] : 0;

    // Calculate adjusted Basic Salary
    $adjusted_bsalary = $basic_salary - (($basic_salary / 22) * $days_taken);

    // Calculate Net Salary
    $net_salary = $adjusted_bsalary + $bonus - $deductions;

    // Save data to payroll table
    $insert_query = "INSERT INTO payroll (Emp_ID, Base_Salary, Bonus, Deductions, net_salary, Month) 
                         VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_query);
    $current_month = date('Y-m');
    $insert_stmt->bind_param("idddds", $emp_id, $basic_salary, $bonus, $deductions, $net_salary, $current_month);

    if ($insert_stmt->execute()) {
        echo "<script>
            alert('Salary calculated and saved successfully!\\nNet Salary: " . number_format($net_salary, 2) . "');
            window.location.href = 'calsal.php';
        </script>";
    } else {
        echo "Error saving data: " . $conn->error;
    }
}

$stmt->close();


$conn->close();
