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
</head>

<body>
    <header>
        <button id="backButton" class="btn btn-secondary" onclick="location.href='viewcat.php'">Back</button>
        <h1>Edit Category</h1>
    </header>
    <main class="container mt-4">
        <?php
        // Database connection
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

        // Get Category ID
        if (isset($_GET['id'])) {
            $category_id = $_GET['id'];

            // Fetch category details
            $sql = "SELECT * FROM category WHERE Category_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $category_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $category = $result->fetch_assoc();
            } else {
                echo "<p class='text-danger'>Category not found.</p>";
                exit();
            }
        } else {
            echo "<p class='text-danger'>Invalid request.</p>";
            exit();
        }

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_name = $_POST['category_name'];
            $description = $_POST['description'];

            // Update category in the database
            $update_sql = "UPDATE category SET Category_Name = ?, Category_Description = ? WHERE Category_ID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $category_name, $description, $category_id);

            if ($update_stmt->execute()) {
                echo "<p class='text-success'>Category updated successfully.</p>";
            } else {
                echo "<p class='text-danger'>Error updating category: " . $conn->error . "</p>";
            }
        }

        $conn->close();
        ?>

        <!-- Edit Category Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="category_name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="<?= htmlspecialchars($category['Category_Name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($category['Category_Description']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </main>
    <footer class="text-center mt-4">
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>
</body>

</html>
