<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pickcycle");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the required columns exist in the table
$requiredColumns = ['name', 'address', 'phone', 'product_type', 'quantity'];
$columnsQuery = "SHOW COLUMNS FROM recycle";
$columnsResult = $conn->query($columnsQuery);

if ($columnsResult) {
    $existingColumns = [];
    while ($row = $columnsResult->fetch_assoc()) {
        $existingColumns[] = $row['Field'];
    }

    foreach ($requiredColumns as $column) {
        if (!in_array($column, $existingColumns)) {
            die("Error: Missing column '$column' in the 'recycle' table.");
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone']) && !empty($_POST['product_type']) && !empty($_POST['quantity'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $address = $conn->real_escape_string($_POST['address']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $product_type = $conn->real_escape_string($_POST['product_type']); // Ensure product_type is properly retrieved
        $quantity = (int)$_POST['quantity'];

        // Insert data into the database
        $sql = "INSERT INTO recycle (name, address, phone, product_type, quantity) VALUES ('$name', '$address', '$phone', '$product_type', $quantity)";
        if ($conn->query($sql) === TRUE) {
            echo "Submission successful. <a href='recycle.html'>Go back</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Missing required fields.";
    }
}

$conn->close();
?>










