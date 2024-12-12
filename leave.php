<?php
session_start();
$id = $_SESSION['Emp_ID'];

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

// Fetch LeaveType_ID based on leaveType
$leaveType = $_POST['leaveType']; // Assuming the leave type is sent via POST request
$empId = $_SESSION['Emp_ID']; // Assuming Emp_ID is stored in session

// Convert POST date strings to DateTime objects
$leaveStartDate = new DateTime($_POST['leaveStartDate']);
$leaveEndDate = new DateTime($_POST['leaveEndDate']);

// Calculate total leave days
$interval = $leaveStartDate->diff($leaveEndDate);
$totalLeaveDays = $interval->days + 1; // Including the start date

// Convert DateTime objects to string format for the database
$formattedStartDate = $leaveStartDate->format('Y-m-d'); // Change format if needed
$formattedEndDate = $leaveEndDate->format('Y-m-d');

// Query to fetch LeaveType_ID
$leaveTypeQuery = "SELECT LeaveType_ID FROM leavetype WHERE LeaveName = '$leaveType'";
$result = $conn->query($leaveTypeQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $leaveTypeId = $row['LeaveType_ID'];

    // Insert leave application into the database with LeaveType_ID
    $sql = "INSERT INTO empeave (Emp_ID, LeaveType_ID, StartDate, EndDate, DaysTaken) 
            VALUES ('$empId', '$leaveTypeId', '$formattedStartDate', '$formattedEndDate', '$totalLeaveDays')";

    if ($conn->query($sql) === TRUE) {
        //echo "<script>alert('Leave application submitted successfully');</script>";
        echo "<script>
        alert('Leave application submitted successfully');
        window.location.href = 'profile.php';
          </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error: Leave type not found.";
}

$conn->close();
