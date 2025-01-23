<?php
// Include the connection file
include "connect.php";

// Check if the courseId is set in the POST request
if (isset($_POST['courseId'])){
    // Assign the courseId from the POST request to a variable after sanitizing it
    $courseId = mysqli_real_escape_string($conn, $_POST['courseId']);

    // Create the SQL query to select the course with the given courseId using prepared statements
    $sql = "SELECT * from course WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Fetch the associative array of the result
    $row = mysqli_fetch_assoc($result);
    
    // Output the course details in an unordered list after escaping the output
    echo "<ul>";
    echo "<li> <strong>Course: </strong>".htmlspecialchars($row['name'])."</li>";
    echo "<li> <strong>Level:  </strong>".htmlspecialchars($row['level'])."</li>";
    echo "<li> <strong>Description: </strong>".htmlspecialchars($row['description'])."</li>";
    echo "</ul>";

    // Free the result and close the statement
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
}
?>