<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete GRN - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>Nature Ceylon</h1>
    </header>
    
    <main>
        <div class="container">
            <!-- Delete GRN Section -->
            <div class="form-container mt-4">
                <form id="deleteGRNForm" onsubmit="return deleteGRN(event)">
                    <h2>Delete GRN</h2>
                
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark"></i></span>
                        <select class="form-control" id="deleteGRNSelect" name="grnId" required>
                            <option value="">-- Select GRN --</option>
                            <option value="GRN001">GRN001</option>
                            <option value="GRN002">GRN002</option>
                            <option value="GRN003">GRN003</option>
                            <!-- Additional GRNs dynamically populated -->
                        </select>
                    </div>
                
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="deleteGRNConfirmationCheckbox" name="deleteGRNConfirmationCheckbox" required>
                        <label class="form-check-label" for="deleteGRNConfirmationCheckbox">
                            I confirm that I want to delete this GRN permanently.
                        </label>
                    </div>
                
                    <input type="submit" value="Delete GRN" class="btn btn-danger mt-3">
                </form>
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

        function deleteGRN(event) {
            if (event) event.preventDefault(); // Prevent form submission

            const grnSelect = document.getElementById("deleteGRNSelect").value;
            const confirmCheckbox = document.getElementById("deleteGRNConfirmationCheckbox");
            
            if (grnSelect === "") {
                alert("Please select a GRN to delete.");
                return false;
            }
            
            if (!confirmCheckbox.checked) {
                alert("Please confirm the deletion by checking the checkbox.");
                return false;
            }

            const confirmDelete = confirm(`Are you sure you want to permanently delete GRN ${grnSelect}?`);
            if (confirmDelete) {
                // Code to handle deletion (e.g., send request to the server)
                alert(`GRN with ID ${grnSelect} has been deleted.`);
                return true;
            }
            return false;
        }

        // Add event listener for form submission
        document.getElementById('deleteGRNForm').addEventListener('submit', deleteGRN);
    </script>
</body>
</html>
