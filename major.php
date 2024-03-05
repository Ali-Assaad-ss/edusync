    <h2>Edit And Add majors</h2>
    
    <?php
    // Fetch data from the teacher table
    $sql = "SELECT * FROM major";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        echo '<input type="text" id="msearch" placeholder="Search...">';
        echo '<div class="table-container">';
        echo '<table id="majorTable" border="1">
            <tr>
                <th>Name</th>
                <th style="min-width:100px;">Action</th>
            </tr>';

        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="editable-row" data-id="' . $row['id'] . '">';
            echo '<td contenteditable="true">' . $row['name'] . '</td>';
            echo '<td>
                <button class="msave-btn">Save</button>
                <button class="mdelete-btn">delete</button>
              </td>';
            echo '</tr>';
        }
        echo '<tr class="editable-row" id="newMajor">';
        echo '<td contenteditable="true"></td>';
        echo '<td>
            <button class="add-btn" onclick=addMajor()>Add Major</button>
          </td>';
        echo '</tr>';

        echo '</table>';
        echo '</div>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    ?>