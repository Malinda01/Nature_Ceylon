<!DOCTYPE html>
<html>
<head>
    <title>Monthly Sales Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
        }
        .header {
            background-color:rgb(102, 202, 45);
        }
        .footer {
            background-color: #f2f2f2;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .button-container {
            margin: 20px;
            text-align: center;
        }
    </style>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>
<body>

<div class="header">
    <h1>Monthly Sales Report</h1>
    <p>Nature Ceylon</p>
</div>

<div class="button-container">
    <button class="btn btn-primary" onclick="printReport()">Print Report</button>
    <button class="btn btn-secondary" onclick="window.location.href='../../Report.php'">Back to Reports</button>
</div>

<div class="content">
    <?php
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

    // SQL query
    $sql = "SELECT employee.Emp_ID, employee.E_FName, payroll.Base_Salary, payroll.Bonus, payroll.Deductions, (payroll.Base_Salary + payroll.Bonus - payroll.Deductions) AS Net_Salary FROM employee INNER JOIN payroll ON employee.Emp_ID = payroll.Emp_ID";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table border='1'>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Basic Salary</th>
                    <th>Bonus</th>
                    <th>Deductions</th>
                    <th>Net Salary</th>

                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Emp_ID"] . "</td>
                    <td>" . $row["E_FName"] . "</td>
                    <td>" . $row["Base_Salary"] . "</td>
                    <td>" . $row["Bonus"] . "</td>
                    <td>" . $row["Deductions"] . "</td>
                    <td>" . $row["Net_Salary"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>
</div>

<div class="footer">
    <p>&copy; <?php echo date("Y, M"); ?> Nature Ceylon. All rights reserved.</p>
</div>

</body>
</html>
