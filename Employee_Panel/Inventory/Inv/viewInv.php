<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item - Nature Ceylon</title>
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
        <h1 class="m-0">Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>View Product</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Inventory ID</th>
                    <th>Product ID</th>
                    <th>Date Added</th>
                    <th>Supplier ID</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <!-- PHP section -->
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

                // Fetch category data
                $sql = "SELECT Inv_ID, Prod_ID, Date_Added, Supplier_ID FROM inventory";
                $result = $conn->query($sql);

                // Display data in table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["Inv_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["Prod_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["Date_Added"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_ID"]) . "</td>
                                                                <td>
                                    <button class='btn btn-primary btn-sm' onclick=\"location.href='EditCategory.php?id=" . htmlspecialchars($row["Prod_ID"]) . "'\"> Update </button> 
                                    
                                    <button class='btn btn-danger btn-sm' onclick=\"location.href='DeleteCategory.php?id="  . htmlspecialchars($row["Prod_ID"]) . "'\"> Delete </button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No categories found</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <footer class="text-center mt-4">
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>
</body>

</html>