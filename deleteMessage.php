<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $messageId = $_POST['messageId'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM `message` WHERE id = ?");
    $stmt->bind_param("i", $messageId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "message deleted successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
$conn->close();
?>