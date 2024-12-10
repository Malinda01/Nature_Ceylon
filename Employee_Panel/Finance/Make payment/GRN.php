<?php
if (isset($_GET['GRN_ID']) && isset($_GET['Supplier_ID']) && isset($_GET['Payment'])) {
    $grn_id = $_GET['GRN_ID'];
    $supplier_id = $_GET['Supplier_ID'];
    $payment = $_GET['Payment'];
} else {
    echo "GRN_ID: " . (isset($_GET['GRN_ID']) ? $_GET['GRN_ID'] : 'Not set') . "<br>";
    echo "Supplier_ID: " . (isset($_GET['Supplier_ID']) ? $_GET['Supplier_ID'] : 'Not set') . "<br>";
    echo "Payment: " . (isset($_GET['Payment']) ? $_GET['Payment'] : 'Not set') . "<br>";
    die("Required data not provided!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Payment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Process Supplier Payment</h1>
        <form action="submit_payment.php" method="post">
            <div class="form-group">
                <label for="grn_id">GRN ID:</label>
                <input type="text" class="form-control" id="grn_id" name="grn_id" value="<?php echo $grn_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier ID:</label>
                <input type="text" class="form-control" id="supplier_id" name="supplier_id" value="<?php echo $supplier_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="payment">Payment:</label>
                <input type="text" class="form-control" id="payment" name="payment" value="<?php echo $payment; ?>" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
