<?php
// Include your database connection file (connect.php)
include "connect.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $number = mysqli_real_escape_string($conn, $_POST['PhoneNumber']);
    $teacherId = mysqli_real_escape_string($conn, $_POST['teacherId']);
    $courseId = mysqli_real_escape_string($conn, $_POST['courseId']);
    $Bundle = mysqli_real_escape_string($conn, $_POST['Bundle']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);
    $Status = mysqli_real_escape_string($conn, $_POST['Status']);

    // Update the record in the database using prepared statements to prevent SQL injection
    $sql = "UPDATE `request` SET `username`=?, `PhoneNumber`=?, `teacherId`=?, `courseId`=?, `Bundle`=?, `Price`=?, `Status`=? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssi", $name, $number, $teacherId, $courseId, $Bundle, $Price, $Status, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "order updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    // If the request is not a POST request, return an error
    echo "Invalid request method";
}

// Close the database connection
mysqli_close($conn);
?>