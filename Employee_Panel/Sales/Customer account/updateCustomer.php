<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer Details</title>
</head>
<body>
    <h2>Update Customer Details</h2>
    <form action="processUpdateCustomer.php" method="post">
        <label for="fname">First Name:</label><br>
        <input type="text" id="fname" name="fname" required><br><br>
        
        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname" required><br><br>
        
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="address">Address:</label><br>
        <textarea id="address" name="address" required></textarea><br><br>
        
        <input type="submit" value="Update Customer">
    </form>
</body>
</html>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "malinda_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Retrieve customer ID from session
if (isset($_SESSION['Cust_ID'])) {
    $customer_id = $_SESSION['Cust_ID'];
} else {
    echo "Customer ID not found in session";
    exit;
}
// Fetch customer details
$customer_id = $_GET['id']; // Assuming customer ID is passed as a query parameter
$sql = "SELECT * FROM customer WHERE Cust_ID = $customer_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No customer found";
    exit;
}

$conn->close();
?>

<script>
    document.getElementById('fname').value = "<?php echo $row['first_name']; ?>";
    document.getElementById('lname').value = "<?php echo $row['last_name']; ?>";
    document.getElementById('phone').value = "<?php echo $row['phone']; ?>";
    document.getElementById('username').value = "<?php echo $row['username']; ?>";
    document.getElementById('email').value = "<?php echo $row['email']; ?>";
    document.getElementById('address').value = "<?php echo $row['address']; ?>";
</script>