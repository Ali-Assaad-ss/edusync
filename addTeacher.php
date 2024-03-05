<?php
include "connect.php";
// Check if the teacherName parameter is set
if (isset($_POST['teacherName'])) {
    // Retrieve the teacherName from the AJAX request
    $teacherName = $_POST['teacherName'];
    $teacherDegree = $_POST['teacherDegree'];
    $teacherMajor = $_POST['teacherMajor'];
    $teacherDescription = $_POST['teacherDescription'];
    $status = $_POST['status'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize the input (you should use prepared statements to prevent SQL injection)
    $sql = $conn->prepare("INSERT INTO `teacher` (`name`, `degree`, `major`, `description`, `status`) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $sql->bind_param("sssss", $teacherName, $teacherDegree, $teacherMajor, $teacherDescription, $status);
    
    // Execute the statement
    if ($sql->execute()) {
        echo "Teacher added successfully";
    } else {
        echo "Error: " . $sql->error;
    }
    
    // Close the statement
    $sql->close();}?>