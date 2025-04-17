<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pickcycle");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $topic = $_POST['topic'];
    $location = $_POST['location'];
    $time = $_POST['time'];

    // Insert event into the database
    $sql = "INSERT INTO events (title, date, topic, location, time) VALUES ('$title', '$date', '$topic', '$location', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Event created successfully. <a href='view_events.php'>View Events</a>";
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
    <title>Create Event</title>
    <link rel="stylesheet" href="pickcycle.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f8fb;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #1a3d2f;
            margin-bottom: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        form input[type="text"], form input[type="date"], form input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        form button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1a3d2f;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #145a3b;
        }
        .view-events-link {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1em;
            font-weight: bold;
            color: #1a3d2f;
            text-decoration: none;
            background-color: #ffffff;
            padding: 5px 10px;
            border: 1px solid #1a3d2f;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .view-events-link:hover {
            background-color: #1a3d2f;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <a href="view_events.php" class="view-events-link">View Events</a> 
    <div class="container">
        <h1>Create Event</h1>
        <form action="create_event.php" method="POST">
            <label for="title">Event Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="date">Event Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="topic">Event Topic:</label>
            <input type="text" id="topic" name="topic" required>

            <label for="location">Event Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="time">Event Time:</label>
            <input type="time" id="time" name="time" required>

            <button type="submit">Create Event</button>
        </form>
    </div>
</body>
</html>
