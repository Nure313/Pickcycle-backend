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
// Retrieve updated comment data from POST request
$comment_id = $_POST['comment_id'];
$updated_comment = $_POST['updated_comment'];

// Sanitize input data
$updated_comment = mysqli_real_escape_string($conn, $updated_comment);

// Update comment in the database
$sql = "UPDATE comment SET comment='$updated_comment' WHERE id=$comment_id";

if ($conn->query($sql) === TRUE) {
    echo "Comment updated successfully";
} else {
    echo "Error updating comment: " . $conn->error;
}

$conn->close();
?>
