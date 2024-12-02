<?php

// Check if the form is submitted

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Employee Details - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Admin_Panel/Managements/assets/css/form.css">
    <style>
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <header>
        <button id="backButton" onclick="goBack()">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    
    <main>
        <div class="container">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs mb-4" id="employeeManagementTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="update-tab" data-bs-toggle="tab" data-bs-target="#update" type="button" role="tab">Update Employee</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="delete-tab" data-bs-toggle="tab" data-bs-target="#delete" type="button" role="tab">Delete Employee</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="employeeManagementTabContent">
                <!-- Update Employee Tab -->
                <div class="tab-pane fade show active" id="update" role="tabpanel">
                    <div class="form-container">
                        <form id="updateEmployeeForm" onsubmit="return validateUpdateForm()">
                            <h2>Update Employee Details</h2>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list"></i></span>
                                <select class="form-control" id="updateEmployeeSelect" name="employeeId" required>
                                    <option value="">-- Select Employee ID --</option>
                                    <option value="E001">E001</option>
                                    <option value="E002">E002</option>
                                    <option value="E003">E003</option>
                                    <!-- Additional IDs dynamically populated -->
                                </select>
                            </div>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="updateFirstName" name="firstName" placeholder="First Name">
                            </div>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="updateLastName" name="lastName" placeholder="Last Name">
                            </div>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" id="updatePhoneNumber" name="phoneNumber" pattern="[0-9]{10}" placeholder="Phone Number (10 digits)">
                            </div>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-house"></i></span>
                                <input type="text" class="form-control" id="updateAddress" name="address" placeholder="Address">
                            </div>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" class="form-control" id="updateEmail" name="email" placeholder="Email">
                            </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="updateConfirmationCheckbox" name="confirmationCheckbox" required>
                                <label class="form-check-label" for="updateConfirmationCheckbox">
                                    I confirm that the information provided is true and accurate.
                                </label>
                            </div>
                        
                            <input type="submit" value="Update" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>

                <!-- Delete Employee Tab -->
                <div class="tab-pane fade" id="delete" role="tabpanel">
                    <div class="form-container">
                        <form id="deleteEmployeeForm" onsubmit="return deleteEmployee()">
                            <h2>Delete Employee</h2>
                        
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list"></i></span>
                                <select class="form-control" id="deleteEmployeeSelect" name="employeeId" required>
                                    <option value="">-- Select Employee ID --</option>
                                    <option value="E001">E001</option>
                                    <option value="E002">E002</option>
                                    <option value="E003">E003</option>
                                    <!-- Additional IDs dynamically populated -->
                                </select>
                            </div>
                        
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="deleteConfirmationCheckbox" name="deleteConfirmationCheckbox" required>
                                <label class="form-check-label" for="deleteConfirmationCheckbox">
                                    I confirm that I want to delete this employee record permanently.
                                </label>
                            </div>
                        
                            <input type="submit" value="Delete Employee" class="btn btn-danger mt-3">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script>
        function goBack() {
            window.history.back();
        }
    
        function validateUpdateForm() {
            const employeeSelect = document.getElementById("updateEmployeeSelect").value;
            if (employeeSelect === "") {
                alert("Please select an employee ID to update.");
                return false;
            }
            return true;
        }
    
        function deleteEmployee(event) {
            if (event) event.preventDefault(); // Prevent form submission
            
            const employeeSelect = document.getElementById("deleteEmployeeSelect").value;
            const confirmCheckbox = document.getElementById("deleteConfirmationCheckbox");
            
            if (employeeSelect === "") {
                alert("Please select an employee ID to delete.");
                return false;
            }
            
            if (!confirmCheckbox.checked) {
                alert("Please confirm the deletion by checking the checkbox.");
                return false;
            }
    
            const confirmDelete = confirm(`Are you sure you want to permanently delete employee ${employeeSelect}?`);
            if (confirmDelete) {
                // Code to handle deletion (e.g., send request to the server)
                alert(`Employee with ID ${employeeSelect} has been deleted.`);
                return true;
            }
            return false;
        }
    
        // Add event listeners for form submissions
        document.getElementById('updateEmployeeForm').addEventListener('submit', function(event) {
            if (!validateUpdateForm()) {
                event.preventDefault();
            }
        });
    
        document.getElementById('deleteEmployeeForm').addEventListener('submit', function(event) {
            if (!deleteEmployee(event)) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>