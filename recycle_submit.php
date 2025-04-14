<?php
// Step 2: Connect to the database
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Replace with your actual username
$password = ""; // Replace with your actual password
$dbname = "pickcycle"; // Replace with your actual database name
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Step 3: Retrieve form data
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$product = $_POST['product'];
$quantity = $_POST['quantity'];

// Step 4: Insert form data into the database
$sql = "INSERT INTO recycle (name, address, phone, product_type, quantity) VALUES ('$name', '$address', '$phone', '$product', '$quantity')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>








 

