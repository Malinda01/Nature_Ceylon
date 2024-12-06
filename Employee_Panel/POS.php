<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-btn {
            margin: 5px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .product-btn:hover {
            background-color: #45a049;
        }
        #order-summary {
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="my-4 text-center text-success">POS System</h1>
        <div id="product-list" class="d-flex flex-wrap justify-content-center">
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

            // Fetch products from the database
            $query = "SELECT Prod_ID, Prod_Name, Prod_Unit_Price FROM Product";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<button class='product-btn btn btn-success' data-id='" . htmlspecialchars($row['Prod_ID']) . "' 
                        data-price='" . htmlspecialchars($row['Prod_Unit_Price']) . "'>
                        " . htmlspecialchars($row['Prod_Name']) . "
                    </button>";
                }
            } else {
                echo "<p>No products available.</p>";
            }
            ?>
        </div>

        <div id="order-summary" class="mt-4">
            <h2 class="text-center text-success">Order Summary</h2>
            <table id="order-table" class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <p class="text-right">Total Amount: $<span id="total-amount-display">0.00</span></p>
        </div>

        <form id="billing-form" method="POST" class="text-center">
            <input type="hidden" name="order" id="order-data">
            <input type="hidden" name="total_amount" id="total-amount">
            <button type="submit" class="btn btn-success">Bill</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateTotalAmount() {
            let totalAmount = 0;
            document.querySelectorAll('#order-table tbody tr').forEach(row => {
                totalAmount += parseFloat(row.querySelector('.total').textContent);
            });
            document.querySelector('#total-amount-display').textContent = totalAmount.toFixed(2);
            document.querySelector('#total-amount').value = totalAmount.toFixed(2);
        }

        // Handle product button clicks
        document.querySelectorAll('.product-btn').forEach(button => {
            button.addEventListener('click', () => {
                const prodId = button.dataset.id;
                const price = parseFloat(button.dataset.price);
                const prodName = button.textContent;

                let orderRow = document.querySelector(`tr[data-id="${prodId}"]`);
                if (orderRow) {
                    let qtyCell = orderRow.querySelector('.quantity');
                    let qty = parseInt(qtyCell.textContent) + 1;
                    qtyCell.textContent = qty;
                    orderRow.querySelector('.total').textContent = (qty * price).toFixed(2);
                } else {
                    const tableBody = document.querySelector('#order-table tbody');
                    tableBody.innerHTML += `
                        <tr data-id="${prodId}">
                            <td>${prodName}</td>
                            <td>${price.toFixed(2)}</td>
                            <td class="quantity">1</td>
                            <td class="total">${price.toFixed(2)}</td>
                        </tr>
                    `;
                }
                updateTotalAmount();
            });
        });

        // Prepare billing data on form submission
        document.querySelector('#billing-form').addEventListener('submit', (e) => {
            const rows = document.querySelectorAll('#order-table tbody tr');
            const order = [];
            let totalAmount = 0;

            rows.forEach(row => {
                const prodId = row.dataset.id;
                const quantity = parseInt(row.querySelector('.quantity').textContent);
                const total = parseFloat(row.querySelector('.total').textContent);
                totalAmount += total;

                order.push({ id: prodId, quantity });
            });

            if (order.length === 0) {
                alert("No items in the order. Please add products.");
                e.preventDefault();
                return;
            }

            document.querySelector('#order-data').value = JSON.stringify(order);
            document.querySelector('#total-amount').value = totalAmount.toFixed(2);

            // Reset total amount display after submission
            document.querySelector('#total-amount-display').textContent = '0.00';
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $orderData = json_decode($_POST['order'], true);
        $totalAmount = floatval($_POST['total_amount']);
        $currentDate = date('Y-m-d');

        if ($totalAmount <= 0) {
            die("Invalid total amount.");
        }

        // Begin transaction
        $conn->begin_transaction();

        try {
            // Insert into offline_order table
            $orderQuery = "INSERT INTO Offline_Order (Order_Date) VALUES ('$currentDate')";
            if (!$conn->query($orderQuery)) {
                throw new Exception("Error inserting order: " . $conn->error);
            }

            // Insert into payment table
            $paymentQuery = "INSERT INTO Payment (Total_Amount, Payment_Date) VALUES ('$totalAmount', '$currentDate')";
            if (!$conn->query($paymentQuery)) {
                throw new Exception("Error inserting payment: " . $conn->error);
            }

            // Update product quantities
            foreach ($orderData as $product) {
                $prodId = intval($product['id']);
                $quantity = intval($product['quantity']);

                // Check stock availability
                $stockCheckQuery = "SELECT Prod_Qty FROM Product WHERE Prod_ID = $prodId";
                $stockResult = $conn->query($stockCheckQuery);
                $stock = $stockResult->fetch_assoc()['Prod_Qty'];

                if ($quantity > $stock) {
                    throw new Exception("Insufficient stock for product ID: $prodId");
                }

                // Update stock
                $updateProductQuery = $conn->prepare("UPDATE Product SET Prod_Qty = Prod_Qty - ? WHERE Prod_ID = ?");
                $updateProductQuery->bind_param("ii", $quantity, $prodId);
                if (!$updateProductQuery->execute()) {
                    throw new Exception("Error updating stock for product ID: $prodId");
                }
            }

            // Commit transaction
            $conn->commit();
           // echo "<p>Order successfully processed! Total amount: " . htmlspecialchars($totalAmount) . "</p>";
        } catch (Exception $e) {
            $conn->rollback();
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
