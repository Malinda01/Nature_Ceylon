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

    //SQL query to retrieve the role of the employee table
    $query = "SELECT Role, Emp_ID FROM employee WHERE E_Username = '$E_Username' AND E_Password = '$E_Password'";

    // Execution
    $result = $conn->query($query);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $role = $row['Role'];
        $id = $row['Emp_ID']; // Employee ID for fk
        // die(var_dump($id));
        $_SESSION['Emp_ID'] = $id;

        // Redirect based on the user's role
        if ($role == 'admin') {
            // Login for the admin
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Admin_Panel/Managements/AdminDash/admindash.php');
        } elseif ($role == 'EmpRelManager') {
            // Login for the Employee Relation Manager  
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Employee.php');
        } elseif ($role == 'INVManager') {
            // Login for the Inventory Manager
            $_SESSION['EUsername'] = $E_Username;
            //$_SESSION['Emp_ID'] = $id;
            header('Location: ../Employee_Panel/Inventory.php'); // Redirect to the Inventory page

        } elseif ($role == 'SupManager') {
            // Login for the Supplier Manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Supplier.php');
        } elseif ($role == 'SalesManager') {
            //Login for the Sales manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Sales.php');
        } elseif ($role == 'SalesPerson') {
            //Login for the Sales manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Order.php');
        } elseif ($role == 'Owner') {
            //Login for the Owner
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Report.php');
        } elseif ($role == 'Cashier') {
            // POS for the cashier
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/POS.php');
        } elseif ($role == 'InvCoord') {
            //Login for the Inventory Coordinator
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Returns.php');
        } elseif ($role == 'FinManager') {
            //Login for the Fincae Manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Finance.php');
        } else {
            echo "Invalid role";
        }
    } else {
        echo "Invalid username or password";
    }
}
