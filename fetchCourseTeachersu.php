<?php
// Include the connection file
include "connect.php";

// Check if the courseId is set in the POST request
if (isset($_POST['courseId'])){
    // Store the courseId from the POST request
    $courseId=$_POST['courseId'];
    // Prepare the SQL query to select the teacherId from courseteacher for the given courseId
    $sql ="select teacherId from courseteacher where courseId = ?";
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);
    // Bind the courseId parameter to the SQL statement
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    // Execute the SQL statement
    mysqli_stmt_execute($stmt);
    // Get the result of the SQL statement
    $result = mysqli_stmt_get_result($stmt);
    // Check if there are rows in the result
    if (mysqli_num_rows($result)>0){
        // Echo a message to select a teacher to continue
        echo "<div> Select a teacher to continue: "."</div>";
        // Echo a container for the courseTeachers
        echo'<div id="courseTeachers">';
        // Loop through the result and fetch each row
        while ($row = mysqli_fetch_array($result)){
            // Store the teacherId from the fetched row
            $teacherId= $row["teacherId"];
            // Prepare the SQL query to select all fields from the teacher table for the given teacherId
            $sql2="select * from teacher where id=$teacherId";
            // Execute the SQL query
            $result2 = mysqli_query($conn, $sql2);
            // Fetch the result as an array
            $row2 = mysqli_fetch_array($result2);
            // Check if the row2 is not empty
            if ($row2){
                // Check if the teacher's status is not "Disabled"
                if($row2['status']!="Disabled"){
                    // Echo a container for the teacher with a radio input and the teacher's name
                    echo'<div class="teacher">';
                    echo ' <label>
                    <input type="radio" name="teacher" id="'.$teacherId.'">'.
                    $row2["name"].'
                    </label>';
                    // Echo a button to view the teacher's info
                    echo "<button class='teacherInfoButton' onclick=viewTeacherInfo($teacherId)>View</button>";
                    echo'</div>';
                }
            }
        }
    } else {
        // Echo a message if there are no teachers for this course
        echo "No Teacher for this course";
    }
    // Close the container for courseTeachers
    echo'</div>';
}
?>