<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Nature Ceylon</title>
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
        <button id="backButton" onclick="location.href='../../Inventory.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main>
        <div class="container">
            <!-- Tab Content -->
            <div class="tab-content" id="categoryManagementTabContent">
                <!-- Delete Category Tab -->
                <div class="tab-pane fade show active" id="delete" role="tabpanel">
                    <div class="form-container">

                        <!-- Delete Category Form -->
                        <form id="deleteCategoryForm" onsubmit="return deleteCategory(event)">
                            <h2>Delete Category</h2>

                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list"></i></span>
                                <select class="form-control" id="deleteCategorySelect" name="categoryId" required>
                                    <option value="">-- Select Category --</option>
                                    <option value="C001">C001</option>
                                    <option value="C002">C002</option>
                                    <option value="C003">C003</option>
                                    <!-- Additional categories dynamically populated -->
                                </select>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="deleteConfirmationCheckbox" name="deleteConfirmationCheckbox" required>
                                <label class="form-check-label" for="deleteConfirmationCheckbox">
                                    I confirm that I want to delete this category permanently.
                                </label>
                            </div>

                            <input type="submit" value="Delete Category" class="btn btn-danger mt-3">
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

        function deleteCategory(event) {
            if (event) event.preventDefault(); // Prevent form submission

            const categorySelect = document.getElementById("deleteCategorySelect").value;
            const confirmCheckbox = document.getElementById("deleteConfirmationCheckbox");

            if (categorySelect === "") {
                alert("Please select a category to delete.");
                return false;
            }

            if (!confirmCheckbox.checked) {
                alert("Please confirm the deletion by checking the checkbox.");
                return false;
            }

            const confirmDelete = confirm(`Are you sure you want to permanently delete category ${categorySelect}?`);
            if (confirmDelete) {
                // Code to handle deletion (e.g., send request to the server)
                alert(`Category with ID ${categorySelect} has been deleted.`);
                return true;
            }
            return false;
        }

        // Add event listener for form submission
        document.getElementById('deleteCategoryForm').addEventListener('submit', deleteCategory);
    </script>
</body>

</html>