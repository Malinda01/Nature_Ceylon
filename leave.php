<?php
session_start();
$id = $_SESSION['Emp_ID'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['leaveType'])) {
    $leaveType = $_POST['leaveType'];
    $leaveReason = $_POST['leaveReason'];
    $leaveStartDate = $_POST['leaveStartDate'];
    $leaveEndDate = $_POST['leaveEndDate'];
    $leaveStatus = "Pending";
    $empId = $id;

    // Calculate total leave days
    $startDate = new DateTime($leaveStartDate);
    $endDate = new DateTime($leaveEndDate);
    $interval = $startDate->diff($endDate);
    $totalLeaveDays = $interval->days + 1;

    // Insert leave application into the database
    $sql = "INSERT INTO empleave (Emp_ID, leave_start_date, leave_end_date, total_days, reason, leavestatus) 
                        VALUES ('$id', '$leaveStartDate', '$leaveEndDate', '$totalLeaveDays', '$leaveReason', '$leaveStatus')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Leave application submitted successfully');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
