<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Supplier - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Admin_Panel/Managements/assets/css/form.css">
</head>

<body>
    <header>
        <button id="backButton" onclick="location.href='../../Supplier.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main class="container mt-4">
        <h2>Delete Supplier</h2>

        <form id="deleteSupplierForm" onsubmit="return validateForm()">

            <!-- Supplier ID (Selection Box) -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-file-earmark"></i></span>
                <select class="form-control" id="supplierId" name="supplierId" required>
                    <option value="" disabled selected>Select Supplier ID</option>
                    <!-- Example Supplier IDs (these can be dynamically generated from a database) -->
                    <option value="SUP123">SUP123 - ABC Supplies</option>
                    <option value="SUP124">SUP124 - XYZ Enterprises</option>
                    <option value="SUP125">SUP125 - PQR Traders</option>
                </select>
            </div>

            <!-- Confirmation Checkbox -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that I want to delete this supplier.
                </label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Delete Supplier" class="btn btn-danger w-100 mt-3">
        </form>
    </main>

    <footer class="text-center mt-4">
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateForm() {
            const supplierId = document.getElementById("supplierId").value;
            const checkbox = document.getElementById("confirmationCheckbox");

            if (!supplierId) {
                alert("Please select a Supplier ID.");
                return false;
            }

            if (!checkbox.checked) {
                alert("You must confirm that you want to delete the supplier.");
                return false;
            }

            alert("Supplier Deleted Successfully!");
            return true;
        }
    </script>
</body>

</html>