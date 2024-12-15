<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['Emp_ID'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    // Database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM employee WHERE Emp_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);

    if ($stmt->execute()) {
        echo "Employee deleted successfully.";
    } else {
        echo "Error deleting employee: " . $conn->error;
    }

    $conn->close();
}
