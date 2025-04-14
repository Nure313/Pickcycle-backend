<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "pickcycle";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve comment ID from POST request
$comment_id = $_POST['comment_id'];

// Delete comment from the database
$sql = "DELETE FROM comment WHERE id=$comment_id";

if ($conn->query($sql) === TRUE) {
    echo "Comment deleted successfully";
} else {
    echo "Error deleting comment: " . $conn->error;
}

$conn->close();
?>
