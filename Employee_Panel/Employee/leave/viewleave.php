<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee Leave - Nature Ceylon</title>
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
        <h2>View Employee Leave</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Leave ID</th>
                    <th>Employee ID</th>
                    <th>Total Days</th>
                    <th>Leave Status</th>
                    <th>Update Leave Status</th>
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

                $sql = "SELECT Leave_ID, Emp_ID, DaysTaken, leavestatus FROM empeave";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["Leave_ID"] . "</td>
                            <td>" . $row["Emp_ID"] . "</td>
                            <td>" . $row["DaysTaken"] . "</td>
                            <td>" . $row["leavestatus"] . "</td>
                             <td>
                                    <button class='btn btn-primary btn-sm' onclick=\"location.href='approveleave.php?id=" . htmlspecialchars($row["Leave_ID"]) . "'\"> Approve </button> 
                                </td>
                          </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found</td></tr>";
                }
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