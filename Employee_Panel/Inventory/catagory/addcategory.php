<!------------------------------------------------- PHP section ------------------------------------------------->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set parameters and execute
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO category (Category_Name, Category_Description) VALUES (?, ?)");
    $stmt->bind_param("ss", $categoryName, $categoryDescription);

    if ($stmt->execute()) {
        echo "New category added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!------------------------------------------------- HTML section ------------------------------------------------->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Category - Nature Ceylon</title>
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
        <!-- Form for add categories -->
        <form method="POST" action="" id="categoryForm" onsubmit="return validateForm()">
            <h2>Add Category</h2>

            <!-- Category ID -->
            <!-- <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                <input type="text" class="form-control" id="categoryId" name="categoryId" placeholder="Category ID"
                    required>
            </div> -->

            <!-- Category Name -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" class="form-control" id="categoryName" name="categoryName"
                    placeholder="Category Name" required>
            </div>

            <!-- Category Description -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-textarea-t"></i></span>
                <textarea class="form-control" id="categoryDescription" name="categoryDescription"
                    placeholder="Category Description" rows="3" required></textarea>
            </div>

            <!-- Check label -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox"
                    required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Add Category" class="btn btn-success w-100 mt-3">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- JS section -->
    <script>
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