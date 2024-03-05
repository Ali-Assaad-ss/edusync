<?php
include "connect.php";

// Check if the course ID is set in the POST request
if (isset($_POST['courseId'])) {
  $courseId = $_POST['courseId'];

  // Prepare and execute the query to fetch teacher IDs for the given course
  $stmt = $conn->prepare("SELECT teacherId FROM courseteacher WHERE courseId = ?");
  $stmt->bind_param("i", $courseId);
  $stmt->execute();
  $result = $stmt->get_result();

  // Display course teachers section heading
  echo "<h4>Course Teachers: </h4>";

  // Check if there are any teachers for this course
  echo "<div class='teachers'>";
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $teacherId = $row["teacherId"];

      // Prepare and execute the query to fetch details of each teacher
      $sql2 = "SELECT * FROM teacher WHERE id = ?";
      $stmt2 = mysqli_prepare($conn, $sql2);
      mysqli_stmt_bind_param($stmt2, "i", $teacherId);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
      $row2 = mysqli_fetch_array($result2);

      // Check if the teacher exists
      if ($row2) {
        // Display teacher details and action buttons
        echo '<div class= teacher>';
        echo '<label>' . $row2["name"] . '</label>';
        echo '<div class="button-container">';
        echo "<button class='teacherInfoButton' onclick='viewTeacherInfo($teacherId)'>View</button>";
        echo "<button class='teacherInfoButton' onclick='removeTeacher($teacherId, $courseId)'>Remove</button>";
        echo "</div>";
      } else {
        // Display message when no teacher exists for this course
        echo "No Teacher for this course";
      }
      echo '</div>';
    }
  } else {
    // Display message when no teacher exists for this course
    echo "No Teacher for this course";
  }
  echo "</div>";

  // Add the logic for adding a teacher to the course
  echo '<h4>Add teacher to course</h4>';
  echo '<select id="teacherSelect">';
  echo '<option value="default">Select a Teacher</option>';

  // Fetch all teachers and display them as options in a dropdown
  $sql3 = "SELECT * FROM `teacher`";
  $result3 = $conn->query($sql3);
  while ($row3 = $result3->fetch_assoc()) {
    echo '<option value="' . $row3['id'] . '">' . $row3['name'] . '</option>';
  }
  echo '</select>';
  echo '<button class="addTeacher-btn" onclick="addCourseTeacher()">Add Teacher</button>';
}