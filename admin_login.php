<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "pickcycle");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate admin credentials
    $result = $conn->query("SELECT * FROM admins WHERE username='$username'");
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_dashboard.php");
            exit();
        }
    }
    header("Location: admin.html?error=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="pickcycle.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f8fb; /* Light background color */
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff; /* White background for the login form */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }
        h1 {
            text-align: center;
            color: #1a3d2f; /* Dark green color for the heading */
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333; /* Dark gray color for labels */
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px; /* Rounded corners */
            font-size: 1em;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1a3d2f; /* Dark green background */
            color: white;
            border: none;
            border-radius: 5px; /* Rounded corners */
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition for hover effect */
        }
        button:hover {
            background-color: #145a3b; /* Darker green on hover */
        }
        p {
            text-align: center;
            color: red; /* Red color for error messages */
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="admin_login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <?php if (isset($_GET['error']) && $_GET['error'] == 1) echo "<p>Invalid username or password.</p>"; ?>
    </div>
</body>
</html>
