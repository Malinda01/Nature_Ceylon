<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Item - Nature Ceylon</title>
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
        <button id="backButton" onclick="goBack()">Back</button>
        <h1 class="m-0">Nature Ceylon</h1>
    </header>
    <main class="container mt-4">
        <h2>View Item</h2>
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>IT001</td>
                    <td>Green Tea</td>
                    <td class="text-center">
                        <img src="../../assets/images/green-tea.jpg" alt="Green Tea" class="img-thumbnail" style="max-width: 100px;">
                    </td>
                    <td>100</td>
                    <td>$5.99</td>
                    <td>Premium Green Tea leaves.</td>
                    <td>C001</td>
                </tr>
                <tr>
                    <td>IT002</td>
                    <td>Black Tea</td>
                    <td class="text-center">
                        <img src="../../assets/images/black-tea.jpg" alt="Black Tea" class="img-thumbnail" style="max-width: 100px;">
                    </td>
                    <td>200</td>
                    <td>$4.49</td>
                    <td>Classic Black Tea blend.</td>
                    <td>C002</td>
                </tr>
                <tr>
                    <td>IT003</td>
                    <td>Herbal Tea</td>
                    <td class="text-center">
                        <img src="../../assets/images/herbal-tea.jpg" alt="Herbal Tea" class="img-thumbnail" style="max-width: 100px;">
                    </td>
                    <td>50</td>
                    <td>$6.99</td>
                    <td>Special Herbal Tea mix.</td>
                    <td>C003</td>
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
