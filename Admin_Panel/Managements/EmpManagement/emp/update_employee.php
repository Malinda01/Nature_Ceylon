<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['Emp_ID'];

    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "malinda_db";

    // Database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM employee WHERE Emp_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        echo "<style>
                form {
                    max-width: 600px;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 10px;
                    background-color: #f9f9f9;
                }
                input[type='text'], input[type='submit'] {
                    width: 100%;
                    padding: 10px;
                    margin: 5px 0 10px 0;
                    display: inline-block;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                }
                input[type='submit'] {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    cursor: pointer;
                }
                input[type='submit']:hover {
                    background-color: #45a049;
                }
              </style>";
        echo "<form action='save_employee.php' method='post'>
                <input type='hidden' name='Emp_ID' value='" . htmlspecialchars($row["Emp_ID"]) . "'>
                NIC: <input type='text' name='NIC' value='" . htmlspecialchars($row["NIC"]) . "'><br>
                First Name: <input type='text' name='E_Fname' value='" . htmlspecialchars($row["E_Fname"]) . "'><br>
                Last Name: <input type='text' name='E_Lname' value='" . htmlspecialchars($row["E_Lname"]) . "'><br>
                Phone: <input type='text' name='E_Phone' value='" . htmlspecialchars($row["E_Phone"]) . "'><br>
                Address: <input type='text' name='E_Address' value='" . htmlspecialchars($row["E_Address"]) . "'><br>
                Email: <input type='text' name='E_Mail' value='" . htmlspecialchars($row["E_Mail"]) . "'><br>
                Role: <input type='text' name='Role' value='" . htmlspecialchars($row["Role"]) . "'><br>
                Username: <input type='text' name='E_Username' value='" . htmlspecialchars($row["E_Username"]) . "'><br>
                Password: <input type='text' name='E_Password' value='" . htmlspecialchars($row["E_Password"]) . "'><br>
                <input type='submit' value='Save'>
              </form>";
    } else {
        echo "Employee not found.";
    }

    $conn->close();
}
?>
