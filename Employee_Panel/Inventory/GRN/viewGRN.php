<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View GRN - Nature Ceylon</title>
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
        <h2>View GRN</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>GRN ID</th>
                    <th>GRN Date</th>
                    <th>Supplier Name</th>
                    <th>Supplier Invoice ID</th>
                    <th>Supplier Order ID</th>
                    <th>Additional Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>GRN001</td>
                    <td>2024-11-01</td>
                    <td>Nature Suppliers</td>
                    <td>INV123</td>
                    <td>ORD456</td>
                    <td>Delivered on time and verified.</td>
                </tr>
                <tr>
                    <td>GRN002</td>
                    <td>2024-11-10</td>
                    <td>Ceylon Traders</td>
                    <td>INV124</td>
                    <td>ORD457</td>
                    <td>Partial delivery, awaiting balance stock.</td>
                </tr>
                <tr>
                    <td>GRN003</td>
                    <td>2024-11-15</td>
                    <td>Sri Lanka Tea</td>
                    <td>INV125</td>
                    <td>ORD458</td>
                    <td>All items delivered and inspected.</td>
                </tr>
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
