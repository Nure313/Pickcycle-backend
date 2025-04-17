<?php
// Start session
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    $servername = "localhost"; 
    $db_username = "root"; 
    $db_password = ""; 
    $dbname = "pickcycle"; 
    
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM sign_up WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        $_SESSION['email'] = $email;
        
        header("Location: home.html");
        exit();
    } else {
        
        echo "Invalid email or password";
    }
    $conn->close();
}
?>
