<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $servername = "localhost"; // Replace with your server name
    $username = "root"; 
    $password = ""; 
    $dbname = "malinda_db"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $nic = $conn->real_escape_string($_POST['nic']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $phoneNumber = $conn->real_escape_string($_POST['phoneNumber']);
    $address = $conn->real_escape_string($_POST['address']);
    $email = $conn->real_escape_string($_POST['email']);
    $role = $conn->real_escape_string($_POST['role']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // SQL query to insert data
    $sql = "INSERT INTO employee (NIC, E_Fname, E_Lname, E_Phone, E_Address, E_Mail, Role, E_Username, E_Password) 
            VALUES ('$nic', '$firstName', '$lastName', '$phoneNumber', '$address', '$email', '$role', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Employee registered successfully!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/form.css">

       
        
</head>
<body>
    <header>
        <button id="backButton" onclick="location.href='../../Employee.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main>
        <form action="" method = "post" employeeForm" onsubmit="return validateForm()">
            <h2>Employee Registration</h2>
            
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Employee ID">
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="nic" name="nic" placeholder="NIC" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" placeholder="Phone Number (10 digits)" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-house"></i></span>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-briefcase"></i></span>
                <input type="text" class="form-control" id="role" name="role" placeholder="Role" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password (min 8 characters)" minlength="8" required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Register" class="btn btn-success w-100 mt-3">
        </form>

    </main>
    <footer>
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateForm() {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                alert("You must confirm that the information is true.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
