<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Nature Ceylon</title>
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
        <form id="editItemForm" onsubmit="return validateEditItemForm()" enctype="multipart/form-data">
            <h2>Edit Item</h2>

            <!-- Dropdown for selecting Item ID -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                <select class="form-control" id="itemId" name="itemId" required>
                    <option value="">-- Select Item ID --</option>
                    <option value="I001">I001</option>
                    <option value="I002">I002</option>
                    <option value="I003">I003</option>
                    <!-- Additional Item IDs dynamically populated -->
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Item Name" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-stack"></i></span>
                <input type="number" class="form-control" id="itemQty" name="itemQty" placeholder="Item Quantity" min="1" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                <input type="number" class="form-control" id="itemPrice" name="itemPrice" placeholder="Item Price" step="0.01" min="0.01" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-textarea-t"></i></span>
                <textarea class="form-control" id="itemDescription" name="itemDescription" placeholder="Item Description" rows="3" required></textarea>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                <select class="form-control" id="categoryId" name="categoryId" required>
                    <option value="">-- Select Category ID --</option>
                    <option value="C001">C001</option>
                    <option value="C002">C002</option>
                    <option value="C003">C003</option>
                    <!-- Additional categories dynamically populated -->
                </select>
            </div>

            <!-- File input for uploading or changing item image -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-image"></i></span>
                <input type="file" class="form-control" id="itemImage" name="itemImage" accept="image/*">
            </div>

            <!-- Display current image preview -->
            <div class="form-group mt-3">
                <label for="currentImage">Current Image:</label>
                <div>
                    <img id="currentImage" src="../../assets/images/default.png" alt="Current Item Image" class="img-fluid img-thumbnail" style="max-width: 150px;">
                </div>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Update Item" class="btn btn-primary w-100 mt-3">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        function validateEditItemForm() {
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
