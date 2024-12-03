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

// Check if it's an AJAX request to fetch item details
if (isset($_GET['fetch']) && $_GET['fetch'] === 'details' && isset($_GET['Prod_ID'])) {
    $prodId = $_GET['Prod_ID'];
    $query = "SELECT Prod_Name, Prod_Description, Prod_Unit_Price FROM Product WHERE Prod_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $prodId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            "itemName" => $row['Prod_Name'],
            "itemDescription" => $row['Prod_Description'],
            "itemPrice" => $row['Prod_Unit_Price'],

            "categoryId" => $row['Cat_ID'],
        ]);
    } else {
        echo json_encode(["error" => "Item not found"]);
    }

    $stmt->close();
    exit;
}

// Update item in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateItem'])) {
    //$itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemDescription = $_POST['itemDescription'];
    //categoryId = $_POST['categoryId'];

    $updateQuery = "UPDATE Product SET Prod_Name=?, Prod_Unit_Price=?, Prod_Description=? WHERE Prod_ID=?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sdss", $itemName, $itemPrice, $itemDescription, $itemId);

    if ($stmt->execute()) {
        $updateSuccess = true;
    } else {
        $updateError = $stmt->error;
    }

    $stmt->close();
}

// Fetching product IDs for dropdown
$productIds = $conn->query("SELECT Prod_ID FROM Product");
?>

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

        
        <form id="editItemForm" method="POST" onsubmit="return validateEditItemForm()" action="">
            <h2>Edit Item</h2>
            <div class="input-group">

                <span class="input-group-text"><i class="bi bi-upc-scan"></i></span>
                <select class="form-control" id="itemId" name="itemId" required onchange="loadItemDetails()">
                    <option value="">-- Select Item ID --</option>
                    <?php
                    if ($productIds->num_rows > 0) {
                        while ($row = $productIds->fetch_assoc()) {
                            echo "<option value='" . $row['Prod_ID'] . "'>" . $row['Prod_ID'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-box"></i></span>
                <input type="text" class="form-control" id="itemName" name="itemName" placeholder="Item Name" required>
            </div>
            <!-- <div class="input-group">
                <span class="input-group-text"><i class="bi bi-stack"></i></span>
                <input type="number" class="form-control" id="itemQty" name="itemQty" placeholder="Item Quantity" min="1" required>
            </div> -->
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
                <input type="text" class="form-control" id="categoryId" name="categoryId" placeholder="Category ID" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="confirmationCheckbox" name="confirmationCheckbox" required>
                <label class="form-check-label" for="confirmationCheckbox">I confirm that the information provided is true and accurate.</label>
            </div>
            <input type="submit" value="Update Item" name="updateItem" class="btn btn-primary w-100 mt-3">
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

        function loadItemDetails() {
            const itemId = document.getElementById("itemId").value;
            if (itemId) {
                fetch(`?fetch=details&Prod_ID=${itemId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            document.getElementById("itemName").value = data.itemName;
                            //document.getElementById("itemQty").value = data.itemQty;
                            document.getElementById("itemPrice").value = data.itemPrice;
                            document.getElementById("itemDescription").value = data.itemDescription;
                            //document.getElementById("categoryId").value = data.categoryId;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>

</html>

<?php $conn->close(); ?>
