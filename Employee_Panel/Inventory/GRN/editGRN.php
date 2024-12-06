<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit GRN - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()">Back</button>
        <h1>Nature Ceylon</h1>
    </header>
    <main>
        <form id="editGRNForm" onsubmit="return validateEditGRNForm()">
            <h2>Edit GRN</h2>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                <input type="text" class="form-control" id="grnId" name="grnId" placeholder="GRN ID" readonly required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                <input type="date" class="form-control" id="grnDate" name="grnDate" placeholder="GRN Date" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="supplierName" name="supplierName" placeholder="Supplier Name" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-file-text"></i></span>
                <input type="text" class="form-control" id="supplierInvoiceId" name="supplierInvoiceId" placeholder="Supplier Invoice ID" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                <input type="text" class="form-control" id="supplierOrderId" name="supplierOrderId" placeholder="Supplier Order ID" required>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Update GRN" class="btn btn-primary w-100 mt-3">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateEditGRNForm() {
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