<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Decline Leave - Nature Ceylon</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Admin_Panel/Managements/assets/css/form.css">
    <style>
        .btn-approve:hover {
            background-color: #218838;
            color: white;
        }

        .btn-decline:hover {
            background-color: #c82333;
            color: white;
        }
    </style>
</head>

<body>
    <header>
        <button id="backButton" onclick="goBack()" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </button>
        <h1>Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>Approve or Decline Leave</h2>

        <form id="leaveDecisionForm" method="POST" action="">
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                <input type="text" class="form-control" id="leaveId" name="leaveId" placeholder="Leave ID" required>
            </div>

            <!-- Leave decision section -->
            <div class="mb-4">
                <label for="leaveDecision" class="form-label">Select Action</label>
                <select id="leaveDecision" name="leaveDecision" class="form-select" required>
                    <option value="" disabled selected>Select an option</option>
                    <option value="approve">Approve</option>
                    <option value="decline">Decline</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Submit Decision</button>
            </div>
        </form>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "malinda_db";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $leaveId = $_POST['leaveId'];
            $leaveDecision = $_POST['leaveDecision'];

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'malinda_db');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Update query
            $sql = "UPDATE empleave SET leavestatus = ? WHERE leave_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('si', $leaveDecision, $leaveId);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Leave ID: $leaveId has been $leaveDecision.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error updating record: " . $conn->error . "</div>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </main>
    <footer class="text-center mt-4">
        <!-- <p>&copy; 2024 Nature Ceylon. All Rights Reserved.</p> -->
    </footer>

    <script>
        function goBack() {
            window.history.back();
        }

        // Handle the form submission
        
    </script>
</body>

</html>