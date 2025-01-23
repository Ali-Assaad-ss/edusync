<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Fetch data from the teacher table
$sql = "SELECT * FROM message order by id Desc";
$result = mysqli_query($conn, $sql);

// Check if the query was successful

echo '<input type="text" id="tsearch" placeholder="Search...">';
echo '<div class="table-container">';
echo '<table id="teacherTable" border="1">
            <tr>
                <th>Message ID</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th style="display:none" >Subject</th>
                <th style="display:none">Message</th>
                <th>Date</th>
                <th style="min-width:100px;">Action</th>
            </tr>';
if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="editable-row ';
        if ($row['status']==1) echo 'seen';
        echo'" data-id="'. $row['id'] . '">';
        echo '<td >'. $row['id'] . '</td>';
        echo '<td >'. $row['name'] . '</td>';
        echo '<td >'. $row['phone'] . '</td>';
        echo '<td >'. $row['email'] . '</td>';
        echo '<td >'. $row['date'] . '</td>';
        echo '<td>
                <button class="mgread">Read</button>
                <button class="mgdelete-btn">Delete</button>
              </td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
}
?>