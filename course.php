<h2>Edit And Add Courses</h2>
<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Fetch data from the teacher table
$sql = "SELECT
            course.id as courseId,
            course.name as courseName,
            course.level,
            course.description
        FROM
            course";

$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo '<input type="text" id="csearch" placeholder="Search...">';
    echo '<div class="table-container">';
    echo '<table id="courseTable" border="1">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>level</th>
                <th style="min-width:100px;">action</th>
            </tr>';

    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="editable-row" data-id="' . $row['courseId'] . '">';
        echo '<td contenteditable="true">' . $row['courseName'] . '</td>';
        echo '<td contenteditable="true">' . $row['description'] . '</td>';
        echo '<td contenteditable="true">' . $row['level'] . '</td>';
        echo '<td>
                <button class="csave-btn">Save</button>
                <button class="cdelete-btn">delete</button>
              </td>';
        echo '</tr>';
    }
    echo '<tr class="editable-row" id="newCourse">';

    echo '<td contenteditable="true"></td>';
    echo '<td contenteditable="true"></td>';
    echo '<td contenteditable="true"></td>';
    echo '<td>
            <button class="add-btn" onclick=addCourse()>Add Course</button>
          </td>';
    echo '</tr>';

    echo '</table>';
    echo '</div>';
} else {
    echo "Error: " . mysqli_error($conn);
}

?>