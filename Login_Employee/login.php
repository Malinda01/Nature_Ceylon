<?php
// Session for catch the username
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Retrieve the field values from the form
    $E_Username = $_POST['EUsername']; //Name in the username field
    $E_Password = $_POST['EPassword']; //Name in the password field

    //Database connection
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

    // Use Prepared Statements to prevent SQL errors and Injection
    $stmt = $conn->prepare("SELECT Role, Emp_ID FROM employee WHERE E_Username = ? AND E_Password = ?");

    // Check if preparation failed (e.g., if table or columns don't exist)
    if ($stmt === false) {
        die("Query failed: " . $conn->error);
    }

    // Bind parameters (s = string)
    $stmt->bind_param("ss", $E_Username, $E_Password);

    // Execution
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $role = $row['Role'];
        $id = $row['Emp_ID']; // Employee ID for fk

        $_SESSION['Emp_ID'] = $id;

        // Redirect based on the user's role
        if ($role == 'Admin') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Admin_Panel/Managements/AdminDash/admindash.php');
        } elseif ($role == 'EmpRelManager') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Employee.php');
        } elseif ($role == 'INVManager') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Inventory.php');
        } elseif ($role == 'SupManager') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Supplier.php');
        } elseif ($role == 'SalesManager') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Sales.php');
        } elseif ($role == 'SalesPerson') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Order.php');
        } elseif ($role == 'Owner') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Report.php');
        } elseif ($role == 'Cashier') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/POS.php');
        } elseif ($role == 'InvCoord') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Returns.php');
        } elseif ($role == 'FinManager') {
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Finance.php');
        } else {
            echo "Invalid role";
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
