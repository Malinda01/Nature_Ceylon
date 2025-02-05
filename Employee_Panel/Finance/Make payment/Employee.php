<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Payment - Nature Ceylon</title>
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
        <form id="employeePaymentForm" onsubmit="return validateForm()">
            <h2>Employee Payment</h2>

            <!-- Employee ID -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" class="form-control" id="employeeId" name="employeeId" placeholder="Employee ID" required>
            </div>

            <!-- Employee Name -->
            <div class="input-group mt-3">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Employee Name" required>
            </div>

            <!-- Payment Amount -->
            <div class="input-group mt-3">
                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                <input type="number" class="form-control" id="paymentAmount" name="paymentAmount" placeholder="Payment Amount" required>
            </div>

            <!-- Payment Date -->
            <div class="input-group mt-3">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input type="date" class="form-control" id="paymentDate" name="paymentDate" required>
            </div>

            <!-- Payment Method -->
            <div class="input-group mt-3">
                <span class="input-group-text"><i class="bi bi-wallet2"></i></span>
                <select class="form-select" id="paymentMethod" name="paymentMethod" required>
                    <option value="" disabled selected>Select Payment Method</option>
                    <option value="cash">Cash</option>
                    <option value="bank-transfer">Bank Transfer</option>
                    <option value="mobile-payment">Mobile Payment</option>
                </select>
            </div>

            <!-- Confirmation Checkbox -->
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the payment details provided are accurate.
                </label>
            </div>

            <!-- Submit Button -->
            <input type="submit" value="Make Payment" class="btn btn-success w-100 mt-3">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateForm() {
            const checkbox = document.getElementById("confirmationCheckbox");
            if (!checkbox.checked) {
                alert("You must confirm that the payment details are accurate.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
