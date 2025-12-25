<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $E_Username = $_POST['EUsername'];
    $E_Password = $_POST['EPassword'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT Role, Emp_ID FROM employee WHERE E_Username = ? AND E_Password = ?");

    if (!$stmt) {
        die("Database Error: " . $conn->error);
    }

    $stmt->bind_param("ss", $E_Username, $E_Password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // --- THE FIX ---
        // 1. trim(): Removes hidden spaces (e.g., "admin " becomes "admin")
        // 2. strtolower(): Makes it case-insensitive (e.g., "Admin" becomes "admin")
        $role = strtolower(trim($row['Role']));
        // 'EmpRelManager' becomes 'emprelmanager'
        $role = strtolower(trim($row['Role']));
        $id = $row['Emp_ID'];

        $_SESSION['Emp_ID'] = $id;

        // Redirect based on the user's role
        if ($role == 'admin') {
            // Login for the admin
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Admin_Panel/Managements/AdminDash/admindash.php');
        } elseif ($role == 'emprelmanager') {
            // Login for the Employee Relation Manager  
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Employee.php');
        } elseif ($role == 'invmanager') {
            // Login for the Inventory Manager
            $_SESSION['EUsername'] = $E_Username;
            //$_SESSION['Emp_ID'] = $id;
            header('Location: ../Employee_Panel/Inventory.php'); // Redirect to the Inventory page

        } elseif ($role == 'supmanager') {
            // Login for the Supplier Manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Supplier.php');
        } elseif ($role == 'salesmanager') {
            //Login for the Sales manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Sales.php');
        } elseif ($role == 'salesperson') {
            //Login for the Sales manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Order.php');
        } elseif ($role == 'owner') {
            //Login for the Owner
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Report.php');
        } elseif ($role == 'cashier') {
            // POS for the cashier
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/POS.php');
        } elseif ($role == 'invcoord') {
            //Login for the Inventory Coordinator
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Returns.php');
        } elseif ($role == 'finmanager') {
            //Login for the Fincae Manager
            $_SESSION['EUsername'] = $E_Username;
            header('Location: ../Employee_Panel/Finance.php');
        } else {
            // Debugging: The brackets [] will help you see if there are hidden spaces
            echo "Login failed. The database role is: [" . $row['Role'] . "]";
        }
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
