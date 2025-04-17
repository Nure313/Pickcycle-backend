<?php
// Start session
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Your database connection code goes here
    // Replace the following placeholders with your actual database credentials
    $servername = "localhost"; // Change this if your database is hosted elsewhere
    $db_username = "root"; // Change this to your database username
    $db_password = ""; // Change this to your database password
    $dbname = "pickcycle"; // Your database name
    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // SQL query to check if the email and password exist in the database
    $sql = "SELECT * FROM sign_up WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // User authenticated successfully
        // Set session variables
        $_SESSION['email'] = $email;
        // Redirect to the dashboard or another page
        header("Location: home.html");
        exit();
    } else {
        // Invalid email or password
        echo "Invalid email or password";
    }
    $conn->close();
}
?>
