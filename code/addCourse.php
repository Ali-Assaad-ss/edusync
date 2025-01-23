<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";

// Check if the courseName parameter is set
if (isset($_POST['courseName'])) {
    // Retrieve the courseName, courseMajor, courseDescription, and courseLevel from the AJAX request
    $courseName = $_POST['courseName'];
    $courseMajor = $_POST['courseMajor'];
    $courseDescription = $_POST['courseDescription'];
    $courseLevel = $_POST['courseLevel'];

    // Create a prepared statement
    $stmt = $conn->prepare("INSERT INTO `course` (`name`, `description`, `level`) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $courseName, $courseDescription, $courseLevel);
    $stmt->execute();
    $courseId = $stmt->insert_id;
    $stmt->close();

    // Create a prepared statement for inserting into coursemajor
    $stmt = $conn->prepare("INSERT INTO `coursemajor`(`courseId`, `majorId`) VALUES (?, ?)");
    $stmt->bind_param("ii", $courseId, $courseMajor);
    $stmt->execute();
    $stmt->close();

    echo "course added successfully";

    $conn->close();
}
?>
