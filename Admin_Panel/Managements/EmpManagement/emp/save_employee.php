<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['Emp_ID'];
    $nic = $_POST['NIC'];
    $fname = $_POST['E_Fname'];
    $lname = $_POST['E_Lname'];
    $phone = $_POST['E_Phone'];
    $address = $_POST['E_Address'];
    $email = $_POST['E_Mail'];
    $role = $_POST['Role'];
    $username = $_POST['E_Username'];
    $password = $_POST['E_Password'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE employee SET NIC = ?, E_Fname = ?, E_Lname = ?, E_Phone = ?, E_Address = ?, E_Mail = ?, Role = ?, E_Username = ?, E_Password = ? WHERE Emp_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nic, $fname, $lname, $phone, $address, $email, $role, $username, $password, $emp_id);

    if ($stmt->execute()) {
        echo "Employee updated successfully.";
    } else {
        echo "Error updating employee: " . $conn->error;
    }

    $conn->close();
}
