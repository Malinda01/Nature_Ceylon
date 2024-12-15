<?php
session_start();
session_destroy(); // Destroy the session
header('Location: ../Login_Employee/login.html'); // Redirect to login
exit();
?>
