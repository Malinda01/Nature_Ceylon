<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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

    // Fetch input values
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemQty = $_POST['itemQty'];
    $itemPrice = $_POST['itemPrice'];
    $itemDescription = $_POST['itemDescription'];
    $categoryId = $_POST['categoryId'];
    // $itemImage = $_FILES['itemImage']['name'];
    // $target_dir = "/C:/wamp64/www/Nature_Ceylon/images/"; // Directory to save images
    // $target_file = $target_dir . basename($itemImage);




    // Insert into product table
    $sql_product = "INSERT INTO product (Prod_ID, Prod_Name, Prod_Description, Prod_Unit_Price, Category_ID) 
                        VALUES ('$itemId', '$itemName', '$itemDescription','$itemPrice', '$categoryId')";

    // Insert into inventory table
    $sql_inventory = "INSERT INTO inventory (Prod_ID, Prod_Qty) VALUES ('$itemId', '$itemQty')";

    if (mysqli_query($conn, $sql_product) && mysqli_query($conn, $sql_inventory)) {
        echo "New item added successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item - Nature Ceylon</title>
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
        <!-- Form for Add new item -->
        <form method="post" action="" id="itemForm" onsubmit="return validateItemForm()" enctype="multipart/form-data">
            <h2>Add Item</h2>

            <!-- Item ID -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                <input type="text" class="form-control" id="itemId" name="itemId" placeholder="Item ID" required>
            </div>

            <!-- Item Name -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Item Name" required>
            </div>

            <!-- Item Quantity -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-stack"></i></span>
                <input type="number" class="form-control" id="itemQty" name="itemQty" placeholder="Item Quantity" min="1" required>
            </div>

            <!-- Item Price -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                <input type="number" class="form-control" id="itemPrice" name="itemPrice" placeholder="Item Price" step="0.01" min="0.01" required>
            </div>

            <!-- Item Description -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-textarea-t"></i></span>
                <textarea class="form-control" id="itemDescription" name="itemDescription" placeholder="Item Description" rows="3" required></textarea>
            </div>

            <!-- Category ID selection -->
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-tag"></i></span>
                <select class="form-control" id="categoryId" name="categoryId">
                    <option value="">-- Select Category ID --</option>
                    <option value="C001">C001</option>
                    <option value="C002">C002</option>
                    <option value="C003">C003</option>
                    <!-- Additional categories dynamically populated -->
                </select>
            </div>

            


        <!-- Check Input section -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">
                    I confirm that the information provided is true and accurate.
                </label>
            </div>

            <input type="submit" value="Add Item" class="btn btn-success w-100 mt-3">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <!-- JS Section -->
    <script>
        // Check box selection
        function validateItemForm() {
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