# Nature Ceylon - Tea Outlet Management System

**Nature Ceylon** is a comprehensive web-based application designed to manage the operations of a premium tea outlet. The system bridges the gap between backend business management and a customer-facing digital storefront, ensuring seamless operations for inventory, sales, employees, and online retail.

## 📖 Table of Contents

- [Project Overview](#project-overview)
- [Key Features](#key-features)
  - [Admin Panel](#admin-panel)
  - [Employee Panel](#employee-panel)
  - [Customer Storefront](#customer-storefront)
- [Tech Stack](#tech-stack)
- [Folder Structure](#folder-structure)
- [Installation & Setup](#installation--setup)
- [Database Configuration](#database-configuration)

## 🚀 Project Overview

This solution serves two main user groups:

1.  **Administrators & Staff:** A powerful dashboard to manage day-to-day business activities including POS (Point of Sale), inventory control, supplier relations, and financial reporting.
2.  **Customers:** An engaging e-commerce platform where users can browse Ceylon tea collections, manage their profiles, and place orders online.

## ✨ Key Features

### 🛠 Admin Panel

The administrative core of the system, accessible via `Admin_Panel/`.

- **Dashboard:** Real-time visual insights with charts (Chart.js) for sales performance and product distribution. Displays quick stats for total employees, products, suppliers, and completed orders.
- **Employee Management:** Manage staff details and access.
- **Inventory Management:** Track stock levels, products, and categories.
- **Supplier Management:** Handle supplier details and procurement.
- **Sales & Orders:** Monitor online orders and physical sales history.
- **POS System:** Integrated Point of Sale interface for in-store transactions.
- **Finance & Reports:** Generate reports on sales, payroll, and financial status.
- **Returns Management:** Handle product returns and refunds.

### 👥 Employee Panel

A dedicated portal for staff members located in `Employee_Panel/`.

- **Leave Management:** Request and view leave status.
- **Payroll:** View salary slips and payment details.
- **Operational Access:** Restricted access to inventory and order processing tasks relevant to their role.

### 🛍 Customer Storefront

A responsive e-commerce website located in `storefront/` (and `Customer_web/`).

- **Product Catalog:** Browse various tea blends (e.g., Earl Grey, English Breakfast, Green Tea).
- **User Accounts:** Registration, login, and profile management.
- **Shopping Cart:** Add items, view summary, and checkout.
- **About & Contact:** Information about the brand's heritage and contact forms.
- **Responsive Design:** Built with Bootstrap 5 for mobile-friendly navigation.

## 💻 Tech Stack

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Frameworks & Libraries:** \* Bootstrap 5 (UI Styling)
  - Chart.js (Data Visualization)
  - FontAwesome & Bootstrap Icons (Iconography)

## 📂 Folder Structure

```text
Nature_Ceylon/
├── Admin_Panel/           # Administrative dashboard and management modules
│   ├── Managements/       # Core logic for Emp, Inv, Sales, Orders, etc.
│   └── assets/            # Admin-specific CSS, JS, and images
├── Employee_Panel/        # Staff portal for leave, salary, and tasks
├── Customer_web/          # Customer-facing website pages (Static/HTML versions)
├── storefront/            # Active PHP e-commerce storefront
│   ├── MEDIA/             # Product images and videos
│   ├── css/               # Storefront styling
│   └── db.php             # Database connection file
├── tea-shop/              # Alternate/Legacy shop files
└── Login_Employee/        # Login interface for employees
```

## ⚙️ Installation & Setup

1. **Clone the Repository**

```bash
git clone <repository-url>

```

2. **Set Up Web Server**

- Use a local server environment like **XAMPP**, **WAMP**, or **MAMP**.
- Move the project folder into your server's root directory (e.g., `htdocs` or `www`).

3. **Configure the Database**

- Open **phpMyAdmin**.
- Create a new database named `malinda_db`.
- Import the SQL dump file (if provided in the repo) or manually create the necessary tables (`employee`, `product`, `supplier`, `online_order`, etc.).

4. **Verify Database Connection**

- Check `storefront/db.php` and `Admin_Panel/Managements/AdminDash/admindash.php` to ensure credentials match your local setup:

```php
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "malinda_db";

```

5. **Run the Application**

- **Storefront:** Navigate to `http://localhost/nature_ceylon/storefront/index.php`
- **Admin Panel:** Navigate to `http://localhost/nature_ceylon/Admin_Panel/Managements/AdminDash/admindash.php` (Note: Ensure you are logged in or bypass session checks for testing).

---

## 📝 License

This project is developed for educational and business management purposes.
