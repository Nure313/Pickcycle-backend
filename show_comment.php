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
// Retrieve comments from the database
$sql = "SELECT * FROM comment";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Output comments as HTML
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<p><strong>" . $row["username"] . "</strong>: " . $row["comment"] . "</p>";
        // Check if 'id' key exists in the $row array
        if (array_key_exists('id', $row)) {
            echo "<button class='edit-comment' data-comment-id='" . $row["id"] . "'>Edit</button>";
            echo "<button class='delete-comment' data-comment-id='" . $row["id"] . "'>Delete</button>";
        } else {
            // Handle the case where 'id' key is not found
            echo "<button class='edit-comment'>Edit</button>";
            echo "<button class='delete-comment'>Delete</button>";
        }
        echo "</div>";
    }
} else {
    echo "<p>No comments available</p>";
}
$conn->close();
?>
