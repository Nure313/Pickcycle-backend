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

// Check if the 'events' table exists
$tableCheckQuery = "SHOW TABLES LIKE 'events'";
$tableCheckResult = $conn->query($tableCheckQuery);
if ($tableCheckResult->num_rows == 0) {
    echo "<p>The 'events' table does not exist. Please create it first.</p>";
    exit();
}

// Handle event deletion
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if (!$conn->query("DELETE FROM events WHERE id=$id")) {
        echo "<p>Error deleting event: " . $conn->error . "</p>";
    } else {
        header("Location: admin_dashboard.php");
        exit();
    }
}

// Fetch all events
$result = $conn->query("SELECT * FROM events");
if (!$result) {
    die("Error fetching events: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="pickcycle.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f8fb;
        }
        h1, h2 {
            text-align: center;
            color: #1a3d2f;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #1a3d2f;
            color: white;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #1a3d2f;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="create_event.php">Event</a></li>
                <li><a href="recycle.html">Recycle</a></li>
                <li><a href="admin.html">Sign In</a></li>
                <li><a href="admin_signup.php">Sign Up</a></li>
                <li><a href="view_submissions.php">View participants</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <h1>Admin Dashboard</h1>
    <div style="text-align: center;">
        <a href="create_event.php">Create New Event</a> |
        <a href="admin_logout.php">Logout</a>
    </div>
    <h2>Manage Events</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>Topic</th>
            <th>Location</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['date']); ?></td>
            <td><?php echo htmlspecialchars($row['topic']); ?></td>
            <td><?php echo htmlspecialchars($row['location']); ?></td>
            <td><?php echo htmlspecialchars($row['time']); ?></td>
            <td>
                <a href="update_event.php?id=<?php echo htmlspecialchars($row['id']); ?>">Edit</a>
                <a href="admin_dashboard.php?delete=<?php echo htmlspecialchars($row['id']); ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
