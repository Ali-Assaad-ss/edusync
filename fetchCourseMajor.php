<?php
include "connect.php";

// Check if the courseId is set in the POST request
if (isset($_POST['courseId'])) {
  $courseId = $_POST['courseId'];
  $sql = "SELECT majorId FROM coursemajor WHERE courseId = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $courseId);
  $stmt->execute();
  $result = $stmt->get_result();

  // Display the Course Majors
  echo "<h4>Course Majors : </h4>";
  echo '<div class= teachers>';
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $majorId = $row["majorId"];
      $sql2 = "SELECT * FROM major WHERE id = ?";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->bind_param("i", $majorId);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
      $row2 = $result2->fetch_assoc();
      echo '<div class= teacher>';

      // Check if the major exists for the course
      if ($row2) {
        echo '<label>'.$row2["name"].'
              </label>';
        echo '<div class="button-container">';
        echo "<button class='teacherInfoButton' onclick='removeMajor($majorId, $courseId)'>Remove</button>";
        echo '</div>';
      } else {
        echo "No major for this course";
      }
      echo '</div>';
    }
  } else {
    echo "No major for this course";
  }
  echo '</div>';

  // Display the option to add a major to the course
  echo '<h4>Add major to course</h4>';
  echo '<select id="majorSelect2">';
  echo '<option value="default">Select a major</option>';
  $sql3 = "SELECT * FROM `major`";
  $result3 = $conn->query($sql3);
  while ($row3 = $result3->fetch_assoc()) {
    echo '<option value="' . $row3['id'] . '">' . $row3['name'] . '</option>';
  }
  echo '</select>';
  echo '<button class="addTeacher-btn" onclick="addCourseMajor()">Add Major</button>';
}
?>