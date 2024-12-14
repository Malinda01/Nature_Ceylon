<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Decline Return - Nature Ceylon</title>
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
        <h2>Approve or Decline Return</h2>

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

        $returnID = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Fetch return details
        $sql = "SELECT Return_ID, Return_Reason, Return_Date, Return_Status FROM returntable WHERE Return_ID = $returnID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="returnId" class="form-label">Return ID</label>
                <input type="text" class="form-control" id="returnId" name="returnId" value="<?php echo htmlspecialchars($row['Return_ID']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="returnReason" class="form-label">Return Reason</label>
                <textarea class="form-control" id="returnReason" name="returnReason" rows="3" readonly><?php echo htmlspecialchars($row['Return_Reason']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="returnDate" class="form-label">Return Date</label>
                <input type="text" class="form-control" id="returnDate" name="returnDate" value="<?php echo htmlspecialchars($row['Return_Date']); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="" selected disabled>Select Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>

        <?php
        } else {
            echo "<div class='alert alert-danger'>Return not found.</div>";
        }

        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $returnID = $conn->real_escape_string($_POST['returnId']);
            $status = $conn->real_escape_string($_POST['status']);

            $updateSql = "UPDATE returntable SET Return_Status = '$status' WHERE Return_ID = $returnID";

            if ($conn->query($updateSql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Return status updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error updating return status: " . $conn->error . "</div>";
            }
        }

        $conn->close();
        ?>
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
