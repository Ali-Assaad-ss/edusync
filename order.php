<?php
// Fetch data from the teacher table
$sql = "SELECT * FROM request order by id Desc";
$result = mysqli_query($conn, $sql);

// Check if the query was successful

echo '<input type="text" id="tsearch" placeholder="Search...">';
echo '<div class="table-container">';
echo '<table id="teacherTable" border="1">
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Phone Number</th>
                <th>Course Teacher</th>
                <th>Course</th>
                <th>Bundle</th>
                <th>Price</th>
                <th>Promo</th>
                <th>Date</th>
                <th>Status</th>
                <th style="min-width:100px;">Action</th>
            </tr>';
if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="editable-row" data-id="' . $row['id'] . '">';
        echo '<td >' . $row['id'] . '</td>';
        echo '<td contenteditable="true">' . $row['username'] . '</td>';
        echo '<td contenteditable="true">' . $row['PhoneNumber'] . '</td>';
        echo '<td>';
        echo'<select id="oteacherSelect">';
        $sql2 = "SELECT * FROM `teacher` WHERE 1";
        $result2 = $conn->query($sql2);
        if ($result2) {
            // Process the result set
            while ($row2 = $result2->fetch_assoc()) {
                // Do something with each row
                echo '<option value="' . $row2['id'] . '" ' . ($row2['id'] == $row['teacherId'] ? 'selected' : '') . '>' . $row2['name'] . '</option>';
            }
            echo'</select>';}
            echo'</td>';
            echo '<td>';
            echo'<select id="ocourseSelect">';
            $sql2 = "SELECT * FROM `course` WHERE 1";
            $result2 = $conn->query($sql2);
            if ($result2) {
                // Process the result set
                while ($row2 = $result2->fetch_assoc()) {
                    // Do something with each row
                    echo '<option value="' . $row2['id'] . '" ' . ($row2['id'] == $row['courseId'] ? 'selected' : '') . '>' . $row2['name'] . '</option>';
                }
                echo'</select>';}
                echo'</td>';
                echo '<td contenteditable="true">' . $row['Bundle'] . '</td>';
                echo '<td contenteditable="true" >' . $row['Price'] . '</td>';
                echo '<td >' . $row['promo'] . '</td>';
                echo '<td >' . $row['Date'] . '</td>';
                echo '<td contenteditable="true">' . $row['Status'] . '</td>';
                echo '<td>
                <button class="osave-btn">Save</button>
                <button class="odelete-btn">Delete</button>
                </td>';
                echo '</tr>';
            }

    echo '</table>';
    echo '</div>';
}
?>
<script>
    // Add event listeners for the Save buttons
    document.querySelectorAll('.save-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the corresponding row
            var row = this.closest('.editable-row');

            // Get the data-id attribute to identify the record
            var teacherId = row.getAttribute('data-id');

            // Get the edited values from the contenteditable cells
            var name = row.cells[0].innerText.trim();
            var degree = row.cells[1].innerText.trim();
            var major = row.cells[2].innerText.trim();
            var description = row.cells[3].innerText.trim();

            // Send the data to the server using AJAX
            $.ajax({
                url: 'updateTeacher.php',
                method: 'POST',
                data: {
                    teacherId: teacherId,
                    name: name,
                    degree: degree,
                    major: major,
                    description: description
                },
                success: function(response) {
                    // Handle the response from the server
                    alert(response);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $("#tsearch").on("input", function() {
        var searchText = $(this).val().toLowerCase();


        // Iterate through each row in the table
        $("#teacherTable tbody tr").each(function() {
            var rowText = $(this).text().toLowerCase();
            console.log(rowText);

            // Show/hide rows based on the search input
            if (rowText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });





    //deleting teacher information
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function() {

            var userResponse = window.confirm("Are you sure you want to delete this teacher?");

            if (userResponse) {
                // User clicked "OK" (true)


                // Get the corresponding row
                var row = this.closest('.editable-row');

                // Get the data-id attribute to identify the record
                var teacherId = row.getAttribute('data-id');
                $.ajax({
                    url: 'deleteTeacher.php',
                    method: 'POST',
                    data: {
                        teacherId: teacherId,
                    },
                    success: function(response) {
                        // Handle the response from the server
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            }


        })
    });





    function addTeacher() {
        // Get the corresponding row
        var row = document.getElementById("newTeacher");

        // Get the edited values from the contenteditable cells
        var name = row.cells[0].innerText.trim();
        var degree = row.cells[1].innerText.trim();
        var major = row.cells[2].innerText.trim();
        var description = row.cells[3].innerText.trim();

        // Send the data to the server using AJAX
        $.ajax({
            url: 'addTeacher.php',
            method: 'POST',
            data: {
                teacherName: name,
                teacherDegree: degree,
                teacherMajor: major,
                teacherDescription: description
            },
            success: function(response) {
                // Handle the response from the server
                alert(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    }
</script>