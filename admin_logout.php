<?php
// Start session and destroy it for logout
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Logout</title>
    <link rel="stylesheet" href="pickcycle.css">
    <style>
        body {
            color: black;
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>You have been logged out</h1>
    <p><a href="admin_login.php">Click here to log in again</a></p>
</body>
</html>
