<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Suppliers - Nature Ceylon</title>
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
        <button id="backButton" onclick="location.href='../../Supplier.php'">Back</button>
        <h1>Nature Ceylon</h1>
    </header>

    <main class="container mt-4">
        <h2>View Suppliers</h2>

        <!-- Table to View Supplier Details -->
        <table class="table table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Supplier ID</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Supplier Company</th>
                    <th scope="col">Action</th>
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
                $sql = "SELECT Supplier_ID, Supplier_Name, Supplier_Company FROM supplier";
                $result = $conn->query($sql);

                // Display data in table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row["Supplier_ID"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Name"]) . "</td>
                                <td>" . htmlspecialchars($row["Supplier_Company"]) . "</td>
                                <td>
                                    <button class='btn btn-primary btn-sm' onclick=\"location.href='../upsup/upsup.php?id=" . htmlspecialchars($row["Supplier_ID"]) . "'\">Update</button> 
                                    
                                    <button class='btn btn-danger btn-sm' onclick=\"location.href='../delsup/delsup.php?id="  . htmlspecialchars($row["Supplier_ID"]) . "'\">Delete</button>
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
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>