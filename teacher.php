<?php
// Fetch data from the teacher table
$sql = "SELECT * FROM teacher";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo '<h2 style="color:#fff;">Edit And Add Teachers</h2>';
    echo '<input type="text" id="tsearch" placeholder="Search...">';
    echo '<div class="table-container">';
    echo '<table id="teacherTable" border="1">
            <tr>
                <th>Name</th>
                <th>Degree</th>
                <th>Major</th>
                <th>Description</th>
                <th>Status</th>
                <th style="min-width:100px;">Action</th>
            </tr>';

    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="editable-row" data-id="' . $row['id'] . '">';
        echo '<td contenteditable="true">' . $row['name'] . '</td>';
        echo '<td>';
        echo'<select id="degreeSelect">';
        echo '<option value="none" ' . ($row['degree'] == "none" ? 'selected' : '') . '>No Degree</option>';
        echo '<option value="Bachelor" ' . ($row['degree'] == "Bachelor" ? 'selected' : '') . '>Bachelor</option>';
        echo '<option value="Master 1" '. ($row['degree'] == "Master 1" ? 'selected' : '') . '>Master 1</option>';
        echo '<option value="Master 2" ' . ($row['degree'] == "Master 2" ? 'selected' : '') . '>Master 2</option>';
        echo '<option value="PHD" ' . ($row['degree'] == "PHD" ? 'selected' : '') . '>PHD</option>';
        echo '</select>';
         '</td>';
        echo '<td contenteditable="true">' . $row['major'] . '</td>';
        echo '<td contenteditable="true">' . $row['Description'] . '</td>';
        echo '<td>';
        echo'<select id="statusSelect">';
        echo '<option value="All" ' . ($row['status'] == "All" ? 'selected' : '') . '>All</option>';
        echo '<option value="Online" '. ($row['status'] == "Online" ? 'selected' : '') . '>Online</option>';
        echo '<option value="Person" ' . ($row['status'] == "Person" ? 'selected' : '') . '>Person</option>';
        echo '<option value="Disabled" ' . ($row['status'] == "Disabled" ? 'selected' : '') . '>Disabled</option>';
        echo '</select>';
         '</td>';
        echo '<td>
                <button class="tsave-btn">Save</button>
                <button class="tdelete-btn">Delete</button>
              </td>';
        echo '</tr>';
    }

    echo '<tr class="editable-row" id="newTeacher">';
    echo '<td contenteditable="true"></td>';
    echo '<td>';
    echo'<select id="degreeSelect">';
    echo '<option value="none">No Degree</option>';
    echo '<option value="Bachelor">Bachelor</option>';
    echo '<option value="Master 1">Master 1</option>';
    echo '<option value="Master 2">Master 2</option>';
    echo '<option value="PHD">PHD</option>';
    echo '</select>';
     '</td>';
    echo '<td contenteditable="true"></td>';
    echo '<td contenteditable="true"></td>';
    echo '<td>';
    echo'<select id="statusSelect">';
    echo '<option value="All">All</option>';
    echo '<option value="Online">Online</option>';
    echo '<option value="Person">Person</option>';
    echo '<option value="Disabled">Disabled</option>';
    echo '</select>';
     '</td>';
    echo '<td>
            <button class="add-btn" onclick=addTeacher()>Add teacher</button>
          </td>';
    echo '</tr>';

    echo '</table>';
    echo '</div>';
} else {
    echo "Error: " . mysqli_error($conn);
}
?>