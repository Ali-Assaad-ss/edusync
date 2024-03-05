<?php
include "connect.php";
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}

// Check if the necessary parameters are set
if (isset($_POST['courseId'], $_POST['courseName'], $_POST['courseDescription'], $_POST['courseLevel'])) {
    // Retrieve the parameters from the AJAX request
    $courseId = $_POST['courseId'];
    $courseName = $_POST['courseName'];
    $courseDescription = $_POST['courseDescription'];
    $courseLevel = $_POST['courseLevel'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("UPDATE `course` SET `name`=?, `description`=?, `level`=? WHERE `id`=?");

    // Bind parameters
    $stmt->bind_param("ssii", $courseName, $courseDescription, $courseLevel, $courseId);

    // Execute the update
    if ($stmt->execute()) {
        echo "Course updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    $conn->close();
}
?>
