<?php
// Include your database connection file (connect.php)
include "connect.php";
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $courseId = $_POST['courseId'];

    // Escape the input to prevent SQL injection
    $courseId = mysqli_real_escape_string($conn, $courseId);

    // Prepare the SQL statement using a parameterized query
    $sql = "DELETE FROM `course` WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Course deleted successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>