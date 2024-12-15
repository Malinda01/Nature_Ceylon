<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item - Nature Ceylon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Product</h2>
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

            // Fetch product details
            $sql = "SELECT * FROM product WHERE Prod_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $prodID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="prodName" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="prodName" name="prodName" value="<?= htmlspecialchars($row['Prod_Name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="prodDescription" name="prodDescription" required><?= htmlspecialchars($row['Prod_Description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="prodPrice" class="form-label">Unit Price</label>
                        <input type="number" class="form-control" id="prodPrice" name="prodPrice" value="<?= htmlspecialchars($row['Prod_Unit_Price']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="prodQty" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" id="prodQty" name="prodqty" value="<?= htmlspecialchars($row['Prod_Qty']) ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <!-- <a href="viewItems.php" class="btn btn-secondary">Cancel</a> -->
                </form>
        <?php
            } else {
                echo "<div class='alert alert-danger'>Product not found.</div>";
            }
        }

        if (isset($_POST['update'])) {
            $name = $_POST['prodName'];
            $description = $_POST['prodDescription'];
            $price = $_POST['prodPrice'];
            $prdqty = $_POST['prodqty'];

            $updateSQL = "UPDATE product SET Prod_Name = ?, Prod_Description = ?, Prod_Unit_Price = ?, Prod_Qty = ? WHERE Prod_ID = ?";
            $stmt = $conn->prepare($updateSQL);
            $stmt->bind_param("ssdis", $name, $description, $price, $prdqty, $prodID);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Product updated successfully.</div>";
                echo "<a href='viewItem.php' class='btn btn-primary'>Go Back</a>";
            } else {
                echo "<div class='alert alert-danger'>Error updating product: " . $stmt->error . "</div>";
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
