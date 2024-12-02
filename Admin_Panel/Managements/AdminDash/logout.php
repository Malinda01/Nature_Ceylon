<?php
session_start();
session_destroy(); // Destroy the session
header('Location: ../../../Login employee/login.html'); // Redirect to login
exit();
?>
