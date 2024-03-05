<?php
include "connect.php";

// Check if the 'majorId' is set in the POST request
if (isset($_POST['majorId'])) {
    $majorId = $_POST['majorId'];

    // Check if the 'majorId' is equal to "default" and set the SQL query accordingly
    if ($majorId == "default") {
        $sql = "SELECT * from course";
    } else {
        $sql = "SELECT * from course WHERE id in (Select courseId from coursemajor where majorId = ?)";
    }

    // Prepare and execute the SQL query
    $stmt = $conn->prepare($sql);
    if ($majorId != "default") {
        $stmt->bind_param("i", $majorId);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    // Output the default option for the select dropdown
    echo '<option value="default">Select a course</option>';

    // Loop through the result set and output each course as an option in the select dropdown
    while ($row = $result->fetch_assoc()) {
        // Do something with each row
        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
}