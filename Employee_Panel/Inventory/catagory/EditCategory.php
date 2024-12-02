<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "malinda_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['fetchCategories'])) {
        $result = $conn->query("SELECT Category_ID FROM category");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        echo json_encode($categories);
        exit;
    }

    if (isset($_GET['categoryId'])) {
        $categoryId = $conn->real_escape_string($_GET['categoryId']);
        $result = $conn->query("SELECT * FROM category WHERE Category_ID = '$categoryId'");
        echo json_encode($result->fetch_assoc());
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $conn->real_escape_string($_POST['categoryId']);
    $categoryName = $conn->real_escape_string($_POST['categoryName']);
    $categoryDescription = $conn->real_escape_string($_POST['categoryDescription']);

    $sql = "UPDATE category SET Category_Name = '$categoryName', Category_Description = '$categoryDescription' WHERE Category_ID = '$categoryId'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Nature Ceylon</title>
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
        <button id="backButton" onclick="location.href='../../Inventory.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main>
        <div class="container">
            <div class="form-container">
                <form method="POST" id="editCategoryForm" action="">
                    <h2>Edit Category</h2>

                    <!-- Category ID selection -->
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-list"></i></span>

                        <select class="form-control" id="categorySelect" name="categoryId" required>
                            <!-- Populated dynamically -->
                        </select>
                    </div>

                    <!-- Category Name -->
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-tag"></i></span>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Category Name" required>
                    </div>

                    <!-- Category Description -->
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <textarea class="form-control" id="categoryDescription" name="categoryDescription" placeholder="Category Description"></textarea>
                    </div>

                    <!-- Confirmation checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="editConfirmationCheckbox" name="confirmationCheckbox" required>
                        <label class="form-check-label" for="editConfirmationCheckbox">
                            I confirm that the information provided is true and accurate.
                        </label>
                    </div>

                    <!-- Submit button -->
                    <input type="submit" value="Save Changes" class="btn btn-primary mt-3">
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

    <!-- JS Section -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Populate category dropdown
            fetch("EditCategory.php?fetchCategories=true")
                .then(response => response.json())
                .then(data => {
                    const categorySelect = document.getElementById("categorySelect");
                    data.forEach(category => {
                        const option = document.createElement("option");
                        option.value = category.Category_ID;
                        option.textContent = category.Category_ID;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Error fetching categories:", error));

            // Fetch and populate details when a category is selected
            document.getElementById("categorySelect").addEventListener("change", function () {
                const categoryId = this.value;
                if (categoryId) {
                    fetch(`EditCategory.php?categoryId=${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById("categoryName").value = data.Category_Name || "";
                            document.getElementById("categoryDescription").value = data.Category_Description || "";
                        })
                        .catch(error => console.error("Error fetching category details:", error));
                }
            });

            // Handle form submission
            document.getElementById("editCategoryForm").addEventListener("submit", function (event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch("EditCategory.php", {
                    method: "POST",
                    body: formData,
                })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            alert("Category updated successfully!");
                        } else {
                            alert("Error updating category: " + result.error);
                        }
                    })
                    .catch(error => console.error("Error updating category:", error));
            });
        });
    </script>
</body>

</html>
