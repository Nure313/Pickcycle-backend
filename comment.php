<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pickcycle";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve comment data from POST request
$username = $_POST['username'];
$comment = $_POST['comment'];
// Sanitize input data
$username = mysqli_real_escape_string($conn, $username);
$comment = mysqli_real_escape_string($conn, $comment);
// Insert comment into database
$sql = "INSERT INTO comment (username, comment) VALUES ('$username', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
