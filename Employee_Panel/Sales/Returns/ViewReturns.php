<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Returns - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>View Returns</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Return ID</th>
                    <th>Return Reason</th>
                    <th>Return Date</th>
                    <th>Status</th>
                    <th>Approve/Decline</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                $sql = "SELECT Return_ID, Return_Reason, Return_Date, Return_Status FROM returntable";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Return_ID"] . "</td>";
                        echo "<td>" . $row["Return_Reason"] . "</td>";
                        echo "<td>" . $row["Return_Date"] . "</td>";
                        echo "<td>" . $row["Return_Status"] . "</td>";
                        echo '<td><a href="ApproveReturns.php?id=' . htmlspecialchars($row["Return_ID"]) . '" class="btn btn-primary">Approve or Decline</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No returns found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
    <footer class="text-center mt-4">
        <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p>
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
