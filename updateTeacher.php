<?php

session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $teacherId = $_POST['teacherId'];
    $name = $_POST['name'];
    $degree = $_POST['degree'];
    $major = $_POST['major'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Validate input (example: $teacherId as a positive integer)
    if (!is_numeric($teacherId) || $teacherId <= 0) {
        echo "Invalid teacher ID";
        exit;
    }

    // Update the record in the database using prepared statements
    $sql = "UPDATE teacher SET name = ?, degree = ?, major = ?, description = ?, status = ? WHERE id = ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssi", $name, $degree, $major, $description, $status, $teacherId);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Teacher info updated successfully";
    } else {
        // Log the error to a file or database table
        error_log("Error updating teacher info: " . $stmt->error);

        // Provide a generic error message to the user
        echo "An error occurred while updating teacher info. Please try again later.";
    }

    // Close the statement
    $stmt->close();
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>
