<?php
session_start();

$id = $_SESSION['Emp_ID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Profile Dashboard - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="Admin_Panel/Managements/assets/css/form.css">
</head>

<body>
    <header>
        <h1 class="text-center my-3">Nature Ceylon</h1>
        <button id="backButton" onclick="location.href='Employee_Panel/Inventory.php'">Back</button>

    </header>

    <main class="container mt-4">
        <div class="row">
            <!-- Edit Profile Section -->
            <div class="col-md-6">
                <h2>Edit My Profile</h2>

                <!-- Form -->
                <form id="editProfileForm" action="" method="POST">

                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="John" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="Doe" required>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{10}" value="1234567890" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2" required>123 Main Street</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="john.doe@example.com" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-2">Save Changes</button>
                    <button type="button" class="btn btn-danger w-100" onclick="deleteProfile()">Delete Profile</button>
                </form>
                <?php
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

                $emp_id = 1; // Replace with dynamic employee ID

                // Fetch existing data
                $sql = "SELECT * FROM employee WHERE Emp_ID = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<script>
                    document.getElementById('firstName').value = '" . $row['E_Fname'] . "';
                    document.getElementById('lastName').value = '" . $row['E_Lname'] . "';
                    document.getElementById('phoneNumber').value = '" . $row['E_Phone'] . "';
                    document.getElementById('address').value = '" . $row['E_Address'] . "';
                    document.getElementById('email').value = '" . $row['E_Mail'] . "';
                </script>";
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lastName'];
                    $phoneNumber = $_POST['phoneNumber'];
                    $address = $_POST['address'];
                    $email = $_POST['email'];

                    $sql = "UPDATE employee SET first_name='$firstName', last_name='$lastName', phone_number='$phoneNumber', address='$address', email='$email' WHERE emp_id=$emp_id";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Profile updated successfully');</script>";
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                $conn->close();
                ?>
            </div>

            <!-- Apply for Leave Section -->
            <div class="col-md-6">
                <h2>Apply for Leave</h2>
                <form id="leaveForm" onsubmit="return validateLeaveForm()">
                    <!-- Leave Type -->
                    <div class="mb-3">
                        <label for="leaveType" class="form-label">Leave Type</label>
                        <select class="form-select" id="leaveType" name="leaveType" required>
                            <option value="" disabled selected>Select Leave Type</option>
                            <option value="Sick Leave">Sick Leave</option>
                            <option value="Annual Leave">Annual Leave</option>
                            <option value="Study Leave">Study Leave</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Leave Reason -->
                    <div class="mb-3">
                        <label for="leaveReason" class="form-label">Reason for Leave</label>
                        <textarea class="form-control" id="leaveReason" name="leaveReason" rows="3" placeholder="Provide reason for leave" required></textarea>
                    </div>

                    <!-- Leave Dates -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="leaveStartDate" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="leaveStartDate" name="leaveStartDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="leaveEndDate" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="leaveEndDate" name="leaveEndDate" required>
                        </div>
                    </div>

                    <!-- Confirmation Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                        <label class="form-check-label" for="confirmationCheckbox">
                            I confirm that the information provided is true and accurate.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success w-100">Apply for Leave</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="text-center mt-4">
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function saveProfileChanges() {
            alert("Profile changes saved successfully!");
            // Add backend logic to save updated profile details
            return false;
        }

        function deleteProfile() {
            if (confirm("Are you sure you want to delete your profile?")) {
                alert("Profile deleted successfully!");
                // Add backend logic to handle profile deletion
            }
        }

        function validateLeaveForm() {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                alert("You must confirm the information is true.");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>