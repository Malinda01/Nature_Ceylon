<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Item - Nature Ceylon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Delete Product</h2>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "malinda_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_GET['id'])) {
            $prodID = $_GET['id'];

            // Fetch product details for confirmation
            $sql = "SELECT * FROM product WHERE Prod_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $prodID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p>Are you sure you want to delete <strong>" . htmlspecialchars($row['Prod_Name']) . "</strong>?</p>";
        ?>
                <form method="POST" action="">
                    <button type="submit" name="confirmDelete" class="btn btn-danger">Yes, Delete</button>
                    <a href="viewItems.php" class="btn btn-secondary">Cancel</a>
                </form>
        <?php
            } else {
                echo "<div class='alert alert-danger'>Product not found.</div>";
            }
        }

        if (isset($_POST['confirmDelete'])) {
            $deleteSQL = "DELETE FROM product WHERE Prod_ID = ?";
            $stmt = $conn->prepare($deleteSQL);
            $stmt->bind_param("i", $prodID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Product deleted successfully.</div>";
                echo "<a href='viewItem.php' class='btn btn-primary'>Go Back</a>";
            } else {
                echo "<div class='alert alert-danger'>Error deleting product: " . $stmt->error . "</div>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
