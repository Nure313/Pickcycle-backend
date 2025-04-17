<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pickcycle");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id = $id";
    $result = $conn->query($sql);
    $event = $result->fetch_assoc();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $topic = $_POST['topic'];
    $location = $_POST['location'];
    $time = $_POST['time'];

    $sql = "UPDATE events SET title = '$title', date = '$date', topic = '$topic', location = '$location', time = '$time' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_events.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link rel="stylesheet" href="pickcycle.css">
</head>
<body>
    <h1>Edit Event</h1>
    <form action="edit_event.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
        <label for="title">Event Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $event['title']; ?>" required><br>

        <label for="date">Event Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $event['date']; ?>" required><br>

        <label for="topic">Event Topic:</label>
        <input type="text" id="topic" name="topic" value="<?php echo $event['topic']; ?>" required><br>

        <label for="location">Event Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $event['location']; ?>" required><br>

        <label for="time">Event Time:</label>
        <input type="time" id="time" name="time" value="<?php echo $event['time']; ?>" required><br>

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
