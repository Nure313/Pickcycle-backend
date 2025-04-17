<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "pickcycle");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $topic = $_POST['topic'];
    $location = $_POST['location'];
    $time = $_POST['time'];
    $image = $_FILES['image']['name'];

    if ($image) {
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $event['image'];
    }

    $sql = "UPDATE events SET title='$title', date='$date', topic='$topic', location='$location', time='$time', image='$image' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="pickcycle.css">
</head>
<body>
    <h1>Update Event</h1>
    <form action="update_event.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
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

        <label for="image">Event Image:</label>
        <input type="file" id="image" name="image"><br>
        <img src="images/<?php echo $event['image']; ?>" width="50"><br>

        <button type="submit">Update Event</button>
    </form>
</body>
</html>
